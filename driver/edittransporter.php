<!-- name: Shubham Shinde|| date: 13-05-2024  -->
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
//$token_no=$GET_['token_no'];
$token = 0;
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";
    die;
}

$sql = "SELECT * from transporter where token_no=$token";
$res = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($res);

$aadhar_old=$row['aadhar_no'];


?>

<!-- edit sec  -->

<?php
if (isset($_POST['submit'])) {
     $token_no = 0;
     if (isset($_GET['token'])) {
          $token_no = $_GET['token'];
      } else {
          echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";
          die;
      }
     $aadhar_no = $_POST['aadhar_no'];
     $full_name = $_POST['full_name'];
     $mobile_no = $_POST['mobile_no'];
     $address = $_POST['address'];
     $firm_name = $_POST['firm_name'];
     $truck_no = $_POST['truck_no'];

     $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
     $resa = mysqli_query($connection, $sqla);

     if(mysqli_num_rows($resa) > 0){
          $rowa=mysqli_fetch_assoc($resa);
          $table=$rowa['role'];
          if ($table == 'TR') {

         $sqlo = "SELECT * FROM transporter where aadhar_no= '$aadhar_no'";
         $reso = mysqli_query($connection, $sqlo);
         if ( mysqli_num_rows($reso) > 0) {
          $rowo= mysqli_fetch_assoc($reso);
     
          $aadhar_number=$rowo['aadhar_no'];
          $token_number=$rowo['token_no'];
     
          if( $token_number == $token_no && $aadhar_number == $aadhar_no){
     
               $sql = "UPDATE transporter SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',firm_name='$firm_name',truck_no='$truck_no' WHERE token_no = '$token_no'";
               $res = mysqli_query($connection, $sql);
          
               $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
               $res1 = mysqli_query($connection, $sql1);
          
               if ($res && $res1) {
                    $_SESSION['flash_message']="Data Updated";
            echo '<script>
                window.location.href = "transporter.php";
        </script>';
               } else {
                    echo "fail to update data";
               }
              } elseif (  $token_number != $token_no && $aadhar_number == $aadhar_no) {
               echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                         document.getElementById("error-box").style.display = "block";
                    });
               </script>';
              }
         } else {
     
          $sql = "UPDATE transporter SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',firm_name='$firm_name',truck_no='$truck_no' WHERE token_no = '$token_no'";
          $res = mysqli_query($connection, $sql);
     
          $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
          $res1 = mysqli_query($connection, $sql1);
     
          if ($res && $res1) {
               $_SESSION['flash_message']="Data Updated";
            echo '<script>
                window.location.href = "transporter.php";
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

     $sql = "UPDATE transporter SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',firm_name='$firm_name',truck_no='$truck_no' WHERE token_no = '$token_no'";
          $res = mysqli_query($connection, $sql);
     
          $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
          $res1 = mysqli_query($connection, $sql1);
     
          if ($res && $res1) {
               $_SESSION['flash_message']="Data Updated";
            echo '<script>
                window.location.href = "transporter.php";
        </script>';
          } else {
               echo "fail to update data";
          }
}
}
?>

<!-- delete sec  -->
<?php
if (isset($_POST['drop'])) {
     $token = $_GET['token'];
     // echo $id;

     //$sql = "DELETE FROM staff WHERE id = '$id'";
     $sql2 = "UPDATE transporter SET `aadhar_no`=NULL,`full_name`=NULL,`mobile_no`=NULL,`address`=NULL,`firm_name`=NULL,`truck_no`=NULL ,`qr_code`=NULL, `qr_path`=NULL,`restricted` = '0' WHERE `token_no`='$token'";

     // $sql = "DELETE FROM doctor WHERE id = '$id'";
     $res2 = mysqli_query($connection, $sql2);
   
     $sqlzi = "UPDATE `uni_aadhar` SET `aadhar_no`=NULL,`role`=NULL WHERE `aadhar_no`='$aadhar_old'";
     $reszi = mysqli_query($connection, $sqlzi);
     if ($res2 && $reszi) {
          // If $res2 is true, redirect to transporter.php
          $_SESSION['flash_message']="Data Deleted";
            echo '<script>
                window.location.href = "transporter.php";
        </script>';
          // header("Location: transporter.php");
          // exit(); // Make sure to call exit after header redirection to stop further script execution
     } else {
          // If $res2 is false, output "fail"
          echo "fail";
     }
}
?>
<!-- php code for icard generation -->
<?php

// function to detect qr_code is genertated or not
function isQrGenerated($token_no)
{

     $sql = "SELECT `qr_code` FROM `transporter` WHERE `token_no` = $token_no";
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
     $sql = "SELECT `id`, `token_no`, `working_as` FROM `transporter` WHERE `token_no` = '$token_no'";
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
     if ($dem == 'Driver') {
          $module = "OPR";
     }
     if ($submodule == 'Transporter') {
          $submodule = "TR";
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


     $sqlUpdate = "UPDATE `transporter` SET `qr_code`='$finalQr' ,`qr_path`='$filename'  WHERE `token_no` = '$token_no'";
     $resupdate = mysqli_query($connection, $sqlUpdate);

}

// function to show IdCard
function showIdCard($token_no)
{
     header("Location: transporteridcard.php?token=$token_no");
}

if (isset($_POST['idcard-btn'])) {
     $token = $_POST['token_no'];
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
     <title id="page-title"></title>
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
               <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                    <div class="card border-0 shadow mt-4">
                         <div class="card-body">

                              <form method="post" id="myform"
                                   action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                                   enctype="multipart/form-data" novalidate>
                                   <div class="row mt-2">
                                        <div class="col-md-12 mb-4">
                                             <input type="hidden" name="id" value="<?php echo $row['id']; ?> "
                                                  class="form-control">

                                             <label for="token_no">Token Number :</label>
                                             <input type="text" name="token_no" value="<?php echo $token; ?> "
                                                  class="form-control" placeholder="Token Number" readonly>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="aadhar_no">Aadhar Number :</label>
                                             <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');validateAadharNo();" size="12" minlength="12" maxlength="12" value="<?php echo $row['aadhar_no']; ?>" placeholder="Enter Aadhar Number">
                                             <span id="aadharerror" style="color: red;"></span>
                                        </div>

                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="full_name">Full Name :</label>
                                             <input type="text" name="full_name" class="form-control" id="full_name"
                                             oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"

                                                  value="<?php echo $row['full_name']; ?>" placeholder="Enter Full Name"
                                                  required>
                                                  <span id="nameerror" style="color: red;"></span>

                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="mobile_no">Mobile Number :</label>
                                             <input type="text" name="mobile_no" id="mobile_no"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10"
                                                  minlength="10" maxlength="10" class="form-control"
                                                  value="<?php echo $row['mobile_no']; ?>" placeholder="Enter Mobile Number">
                                                  <span id="contacterror" style="color: red;"></span>
                                        </div>
                                   </div>


                                   <div class="row">
                                        <div class="col-md-12 mb-4">
                                             <label for="address">Address :</label>
                                             <textarea name="address" class="form-control" rows="3" id="address" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                                  required placeholder="Enter Address"><?php echo $row['address']; ?></textarea>
                                                  <span id="addrerror" style="color: red;"></span>


                                        </div>
                                        <div class="col-md-12 mb-4">
                                             <label for="firm_name">Firm Name :</label>
                                             <input type="text" name="firm_name" class="form-control"
                                                  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')"
                                                  value="<?php echo $row['firm_name']; ?>" required placeholder="Enter Firm Name">
                                                  <span id="firmerror" style="color: red;"></span>

                                        </div>
                                        <div class="col-md-12 mb-4">
                                             <label for="truck_no">Truck No :</label>
                                             <input type="text" name="truck_no" id="truck_no" 
                                                  oninput="this.value=this.value.replace(/[^a-zA-Z0-9\s]/g, '');ws(this.id);"
                                                  class="form-control" value="<?php echo $row['truck_no']; ?>" required placeholder="Enter Truck No">
                                                  <span id="truckerror" style="color: red;"></span>

                                        </div>

                                   </div>
                                   <div class="d-grid gap-2 d-sm-block">
                                        <div>
                                             <button class="btn btn-primary" id="submit" name="submit"><i
                                                       class="fa-solid fa-floppy-disk"></i>
                                                  Update</button>
                                             <button class="btn btn-secondary" name="idcard-btn" id="idcard-btn"><i
                                                       class="fa-solid fa-id-card"></i> Id
                                                  Card</button>
                                                  <a href="transporter.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>
                                                  Back</a>
                                             <button class="btn btn-danger" name="drop"
                                                  onclick="confirmDelete(event);"><i class="fa-solid fa-user-xmark"></i>
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

     <!-- script for idcard generation button -->
     <script>
          let token_no = document.getElementById('token_no').readOnly = true;
          let aadhar_no = document.getElementById('aadhar_no');
          let full_name = document.getElementById('full_name');
          let mobile_no = document.getElementById('mobile_no');
          let address = document.getElementById('address');
          if (aadhar_no.value != "") {
               if (full_name.value != "") {
                    if (mobile_no.value != "") {
                         if (address.value != "") {
                              document.getElementById('idcard-btn').disabled = false;
                         } else {
                              document.getElementById('idcard-btn').disabled = true;
                         }
                    } else {
                         document.getElementById('idcard-btn').disabled = true;
                    }
               } else {
                    document.getElementById('idcard-btn').disabled = true;
               }
          } else {
               document.getElementById('idcard-btn').disabled = true;
          }
          function validateIdcard() {
               if (aadhar_no.value != "") {
                    if (full_name.value != "") {
                         if (mobile_no.value != "") {
                              if (address.value != "") {
                                   document.getElementById('idcard-btn').disabled = false;
                                   document.getElementById('idcard-btn').innerHTML = x;
                              } else {
                                   document.getElementById('idcard-btn').disabled = true;
                              }
                         } else {
                              document.getElementById('idcard-btn').disabled = true;
                         }
                    } else {
                         document.getElementById('idcard-btn').disabled = true;
                    }
               } else {
                    document.getElementById('idcard-btn').disabled = true;
               }
          }
     </script>
     <!-- script for idcard generation button ends -->
     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Transporter";
          document.getElementById('navbar-title').innerHTML = "Edit Transporter Form <i class='fa-solid fa-users'></i>";
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

<script>
          //validation by sonal 25/06/2024

       // Validation functions
       function ws(name) {
               var name = document.getElementById(name);
               name.value = name.value.replace(/^\s+/, '');
          }

          function validateAadharNo() {
               var aadharnoField = document.getElementById("aadhar_no");
               var errorElement = document.getElementById("aadharerror");
               if (aadharnoField.value.length < 12) {
                    errorElement.textContent = "Aadhar number should be 12 digits.";
                    return false;
               } else {
                    errorElement.textContent = "";
                    return true;
               }
          }

          function validateContact() {
               var contactField = document.getElementById("mobile_no");
               var errorElement = document.getElementById("contacterror");
               if (contactField.value.length < 10) {
                    errorElement.textContent = "Mobile Number should be at least 10 digits.";
                    return false;
               } else {
                    errorElement.textContent = "";
                    return true;
               }
          }

          function validateName() {
               var nameField = document.getElementById("full_name");
               var errorElement = document.getElementById("nameerror");
               if (nameField.value.trim() === "") {
                    errorElement.textContent = "Fill Out This Field";
                    return false;
               } else {
                    errorElement.textContent = "";
                    return true;
               }
          }

          function validateAddr() {
               var addrField = document.getElementById("address");
               var errorElement = document.getElementById("addrerror");
               if (addrField.value.trim() === "") {
                    errorElement.textContent = "Fill Out This Field";
                    return false;
               } else {
                    errorElement.textContent = "";
                    return true;
               }
          }

          function validateFirm() {
               var firmField = document.getElementById("firm_name");
               var errorElement = document.getElementById("firmerror");
               if (firmField.value.trim() === "") {
                    errorElement.textContent = "Fill Out This Field";
                    return false;
               } else {
                    errorElement.textContent = "";
                    return true;
               }
          }

          function validateTruck() {
               var truckField = document.getElementById("truck_no");
               var errorElement = document.getElementById("truckerror");

            if (truck.trim()=="") {
                errorElement.textContent = "Fill Out This Field";
                return false;
            } 
            else{
                errorElement.textContent = "";
            return true;

            }
         }

          // Form submission validation
          const form = document.getElementById('myform');
          form.addEventListener('submit', (event) => {
               if (!validateAadharNo() || !validateContact() || !validateName() || !validateAddr() || !validateFirm() || !validateTruck()) {
                    event.preventDefault();
               }
          });
     </script>

    

     <!-- JS for delete confirmation -->
     <script>
          function confirmDelete(event) {
               if (confirm("Are you sure you want to delete?")) {

                    window.location.href = "transporter.php";
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