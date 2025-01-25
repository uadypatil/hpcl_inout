<!-- name: Shubham Shinde || date: 11-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php"); 
if (!isset($_SESSION['username'])) {
     header("Location: ../login.php");
     exit();
}
?>





 

<!-- if file is in any folder use ../root.php -->
<!-- including config file to use database -->
<?php include($config_loc); ?>

<?php
// include('connection.php');
$token = "";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}else{
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";die;
}

$sql = "SELECT * from employee where token_no=$token";
$res = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($res);
$aadhar_old=$row['aadhar_no'];

?>

<!-- edit employee  -->

<?php
if (isset($_POST['update'])) {
     $token_no = $_GET['token'];
     $aadhar_no = $_POST['aadhar_no'];
     $full_name = $_POST['full_name'];
     $mobile_no = $_POST['mobile_no'];
     $address = $_POST['address'];

     $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
     $resa = mysqli_query($connection, $sqla);
 
     if(mysqli_num_rows($resa) > 0){
          $rowa=mysqli_fetch_assoc($resa);
          $table=$rowa['role'];
          if ($table == 'EMP') {
     
         $sqlo = "SELECT * FROM employee where aadhar_no= '$aadhar_no'";
         $reso = mysqli_query($connection, $sqlo);
        
         if ( mysqli_num_rows($reso) > 0) {
          $rowo= mysqli_fetch_assoc($reso);
     
          $aadhar_number=$rowo['aadhar_no'];
          $token_number=$rowo['token_no'];
     
          if( $token_number == $token_no && $aadhar_number == $aadhar_no){
     
               $sql = "UPDATE employee SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address' WHERE token_no='$token_no'";
               $res = mysqli_query($connection, $sql);
          
               $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
               $res1 = mysqli_query($connection, $sql1);
          
               if ($res && $res1) {
                    $_SESSION['flash_message']="Data Updated";
            echo '<script>
                window.location.href = "employee.php";
        </script>';
               } else {
                    echo "fail to update data";
               }
              } elseif (  $token_number != $token_no && $aadhar_number == $aadhar_no) {
               echo '<script>
               document.addEventListener("DOMContentLoaded", function() { 
              document.getElementById("error-box").style.display = "block"; 
               });
               </script>';
              }
         } else {
     
          $sql = "UPDATE employee SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address' WHERE token_no='$token_no'";
          $res = mysqli_query($connection, $sql);
     
          $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
          $res1 = mysqli_query($connection, $sql1);
     
          if ($res && $res1) {
               $_SESSION['flash_message']="Data Updated";
            echo '<script>
                window.location.href = "employee.php";
        </script>';
          } else {
               echo "fail to update data";
          }
     
         }
     } else {
          echo '<script>
               document.addEventListener("DOMContentLoaded", function () {
                    document.getElementById("error-box").style.display = "block";
               });
          </script>';
   
     }
} else {

     $sql = "UPDATE employee SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address' WHERE token_no='$token_no'";
     $res = mysqli_query($connection, $sql);

     $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
     $res1 = mysqli_query($connection, $sql1);

     if ($res && $res1) {
          $_SESSION['flash_message']="Data Updated";
          echo '<script>
              window.location.href = "employee.php";
      </script>';
     } else {
          echo "fail to update data";
     }
}
}
?>

<!-- delete employee  -->
<?php
if (isset($_POST['drop'])) {
     $token = $_GET['token'];
     // echo $id;

     $sql = "UPDATE employee SET aadhar_no=NULL,full_name=NULL,mobile_no=NULL,address=NULL,`qr_code`=NULL, `qr_path`=NULL,`restricted` = '0' WHERE id='$token'";
     $res = mysqli_query($connection, $sql);
     
     $sql2 = "UPDATE `uni_aadhar` SET `aadhar_no`=NULL,`role`=NULL WHERE `aadhar_no`='$aadhar_old'";
     $res2 = mysqli_query($connection, $sql2);


     if ($res && $res2) {
          $_SESSION['flash_message']="Data Deleted";
            echo '<script>
                window.location.href = "employee.php";
        </script>';
     } else {
          echo "fail";
     }
}
?>








<!-- php code for icard generation -->
<?php

// function to detect qr_code is genertated or not
function isQrGenerated($token_no)
{

     $sql = "SELECT `qr_code` FROM `employee` WHERE `token_no` = $token_no";
     global $connection;
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['qr_code'] == "" || $row['qr_code'] == NULL) {
                    return false;
               } else {
                    return true;
               }
          }
     }
}

// function to generate IdCard
function generateIdCard($token_no)
{
     global $connection;
     $sql = "SELECT `id`, `token_no`, `working_as` FROM `employee` WHERE `token_no` = '$token_no'";
     $res = mysqli_query($connection, $sql);
     $working_as = "";

     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $working_as = $row['working_as'];
          }
     }

     $input_string = $working_as;

     // Finding the position of the dash
     $dash_position = strpos($input_string, '-');

     // Extracting the substrings
     $dem = trim(substr($input_string, 0, $dash_position));
     $submodule = trim(substr($input_string, $dash_position + 1));
     $module = "";
     if ($dem == 'Operation') {
          $module = "Opr";
     }
     if ($submodule == 'employee') {
          $submodule = "EMP";
     }
     $finalQr = $submodule . "/HPNSK/" . $token_no; //$module . " - " . 

     // including files for qrgeneration
     include "../phpqrcode/qrlib.php";
     // directory generation for qr_codes
     $qr_img_dir = 'qr_code/';
     if (!file_exists($qr_img_dir)) {
          mkdir($qr_img_dir);
     }

     // qr image generation
     $filename = $qr_img_dir . 'qr-' . md5($finalQr) . '.png';
     qr_code::png(@$finalQr, $filename);


     $sqlUpdate = "UPDATE `employee` SET `qr_code`='$finalQr' ,`qr_path`='$filename'  WHERE `token_no` = '$token_no'";
     $resupdate = mysqli_query($connection, $sqlUpdate);

}

// function to show IdCard
function showIdCard($token_no)
{
    header("Location: employeeicard.php?token=$token_no");
}

if (isset($_POST['idcard-btn'])) {
    $token = "";
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
    } else {
        echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";
        die;
    }
    if (isQrGenerated($token)) {
        showIdCard($token);
    } else {
        generateIdCard($token);
        showIdCard($token);
    }
}
?>
<!-- php code for icard generation ends here -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title">Theme file</title>
     <!-- including external links -->
     <?php include($external_links_loc); ?>
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

</head>

<body>


     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <div class="card  border-0 shadow mt-4">
                         <!-- <div class="card-body">
                              <h1 class="text"
                                   style="text-align: center; color:black; font-family: Arial, Helvetica, sans-serif;">
                                   <strong>Gat Form </strong><i class="fa-solid fa-users"></i>
                              </h1>
                         </div> -->
                    </div>

                    <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                    <div class="card border-0 shadow mt-4">
                         <div class="card-body">

                              <form method="post" id="myform" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                                   enctype="multipart/form-data">
                                   <div class="row mt-2">
                                        <div class="col-md-12 mb-4">
                                             <input type="hidden" name="id" value="<?php echo $row['id']; ?> "
                                                  class="form-control">

                                             <label for="token_no">Token Number :</label>
                                             <input type="text" name="token_no" id="token_no"
                                                  value="<?php echo $token; ?> " class="form-control"
                                                  placeholder="Token Number" readonly>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="aadhar_no">Aadhar Number :</label>
                                             <input type="text" name="aadhar_no" id="aadhar_no" class="form-control"
                                                  value="<?php echo $row['aadhar_no']; ?>"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="12"
                                                  minlength="12" maxlength="12" placeholder="Enter Aadhar Number">
                                             <span id="aadharerror" style="color: red;"></span>

                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="full_name">Full Name :</label>
                                             <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Full Name"
                                                  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                                  value="<?php echo $row['full_name']; ?>" >
                                             <span id="nameerror" style="color: red;"></span>

                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="mobile_no">Mobile Number :</label>
                                             <input type="text" name="mobile_no" id="mobile_no" class="form-control"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10"
                                                  minlength="10" maxlength="10" value="<?php echo $row['mobile_no']; ?>"
                                                  placeholder="Enter Mobile Number">
                                             <span id="contacterror" style="color: red;"></span>

                                        </div>
                                   </div>


                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="address">Address :</label>
                                             <textarea name="address" class="form-control" id="address" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);" placeholder="Enter Address"
                                                  rows="3"><?php echo $row['address']; ?></textarea>
                                             <span id="addrerror" style="color: red;"></span>


                                        </div>

                                   </div>
                                   <div class="d-grid gap-2 d-sm-block">
                                        <div>
                                             <button class="btn btn-primary" name="update"><i
                                                       class="fa-solid fa-floppy-disk"></i>
                                                  Update</button>
                                             <button class="btn btn-secondary" name="idcard-btn"><i
                                                       class="fa-solid fa-id-card"></i> Id
                                                  Card</button>
                                                  <a href="employee.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>
                                                  Back</a>
                                             <button class="btn btn-danger" name="drop" onclick="confirmDelete(event);"><i
                                                       class="fa-solid fa-user-xmark"></i>
                                                  Drop</button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>

               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- giving title to document and navbar -->
     <script>

function ws(name) { 
        var name=document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

        }


          document.getElementById('page-title').innerHTML = "HPCL INOUT | Employee";
          document.getElementById('navbar-title').innerHTML = "Edit Employee Form <i class='fa-solid fa-users'></i>";





          var aadharnoField = document.getElementById("aadhar_no");
          var contactField = document.getElementById("mobile_no");
          var nameField = document.getElementById("full_name");
          var addrField = document.getElementById("address");




          aadharnoField.addEventListener("input", validateAadharNo);
          contactField.addEventListener("input", validateContact);
          nameField.addEventListener("input", validateName);
          addrField.addEventListener("input", validateAddr);




          function validateAadharNo() {
               var aadharno = aadharnoField.value;
               var errorElement = document.getElementById("aadharerror");

               if (aadharno.length < 12) {
                    errorElement.textContent = "Aadhar number should be at least 12 digits.";
                    aadharnoField.classList.add("invalid");
                    return false;
               } else {
                    errorElement.textContent = "";
                    aadharnoField.classList.remove("invalid");
                    return true;
               }
          }



          function validateContact() {
               var contact = contactField.value;
               var errorElement = document.getElementById("contacterror");

               if (contact.length < 10) {
                    errorElement.textContent = "Mobile Number should be at least 10 digits.";
                    nameField.classList.add("invalid");
                    return false;
               } else {
                    errorElement.textContent = "";
                    contactField.classList.remove("invalid");
                    return true;
               }
          }

          function validateName() {
               var fullname = nameField.value;
               var errorElement = document.getElementById("nameerror");

               if (fullname.trim() == "") {
                    errorElement.textContent = "Fill Out This Field";
                    nameField.classList.add("invalid");
                    return false;
               }
               else {
                    errorElement.textContent = "";
                    nameField.classList.remove("invalid");
                    return true;

               }
          }




          function validateAddr() {
               var address = addrField.value;
               var errorElement = document.getElementById("addrerror");

               if (address.trim() == "") {
                    errorElement.textContent = "Fill Out This Field";
                    addrField.classList.add("invalid");
                    return false;
               }
               else {
                    errorElement.textContent = "";
                    addrField.classList.remove("invalid");
                    return true;

               }
          }
          const form = document.getElementById('myform');
          //console.log("sahil");


          form.addEventListener('submit', (event) => {
               // handle the form data            event.preventDefault();
               // event.preventDefault();        
               if (!validateContact() || !validateAadharNo() || !validateName() || !validateAddr()) {
                    event.preventDefault();
               }


          });


     </script>

     <!-- Custom JavaScript -->
     <script>
          // JavaScript to toggle sidebar
          // document.getElementById('sidebar-toggle').addEventListener('click', function () {
          //      document.querySelector('.wrapper').classList.toggle('sidebar-open');
          //      document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          // });
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>

      <!-- JS for delete confirmation -->
      <script>
          function confirmDelete(event) {
               if (confirm("Are you sure you want to delete?")) {

                    window.location.href = "employee.php";
               } else {

                    event.preventDefault();
               }
          }
     </script>

     
         <!-- <-----------Aadhar exist Timeout msg-------------->
<script>
        const myTimeout = setTimeout(myGreeting, 3000);

        function myGreeting() {
            document.getElementById("error-box").style.display = "none";
            // document.getElementById("success-box").style.display = "none";
            // window.location.href = "mainGate.php";
        }
    </script>
</body>

</html>