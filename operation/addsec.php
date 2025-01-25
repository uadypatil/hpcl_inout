<!-- name: uday anil patil || date: 08-05-2024 
sonal kiran bhirud ||  11-05-2024 crud operations of gat tat feg sec-->
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

     <!-- including config file to use database -->
     <?php include($config_loc); ?>
</head>
<?php
//include('connection.php');
$token = "";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}else{
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";die;
}
if (isset($_POST['submit'])) {

     $token_no = $_POST['token_no'];
     $aadhar_no = $_POST['aadhar_no'];
     $full_name = $_POST['full_name'];
     $mobile_no = $_POST['mobile_no'];
     $address = $_POST['address'];
     $firm_name = $_POST['firm_name'];
     // Warning: Undefined array key "firm_name" in C:\xampp\htdocs\hpcl_in_out\operation\addsec.php on line 47

     // $status = $_POST['status'];


 // sonal kiran bhirud 21-05-24 working on unique aadhar no
 $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
 $resa = mysqli_query($connection,$sqla);

 if(mysqli_num_rows($resa) > 0) {
     //echo "already exist";
     // echo '<script>document.addEventListener("DOMContentLoaded", function() {
     //      swal("sorry!", "...already exist!");});
     //   </script>';
     echo '<script>
     document.addEventListener("DOMContentLoaded", function() { 
         document.getElementById("error-box").style.display = "block"; 
     });
   </script>';





     // $sqli="SELECT * FROM officer where aadhar_no= '$aadhar_no'";
     // $resi = mysqli_query($conn,$sqli);
     // $row = mysqli_fetch_assoc($resi);
 



 }else{
     $sqlof = "INSERT INTO `uni_aadhar` (`aadhar_no`, `role`) VALUES ('$aadhar_no', 'SEC')";
     $resof = mysqli_query($connection, $sqlof); 





     // $sql = "INSERT INTO `sec`(`token_no`, `aadhar_no`,`full_name`,`mobile_no`,`address`) values('$token_no', '$aadhar_no','$full_name','$mobile_no','$address')";
     $sql = "UPDATE `sec` SET `aadhar_no`='$aadhar_no' ,`full_name`='$full_name' ,`mobile_no`='$mobile_no' ,`address`='$address',`firm_name`='$firm_name' WHERE `token_no` = '$token_no'";

     $a = mysqli_query($connection, $sql);
     // $row = mysqli_fetch_assoc($res);

     if ($a) {
          $_SESSION['flash_message']="Data Submitted";
            echo '<script>
                window.location.href = "sec.php";
        </script>';

     } else {
          echo "fail";
     }
}
}
?>

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
                <h1 class="text" style="text-align: center; color:black; font-family: Arial, Helvetica, sans-serif;">
                    <strong>Gat Form </strong><i class="fa-solid fa-users"></i></h1>
            </div> -->
                    </div>

                    <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>

                    <div class="card border-0 shadow mt-4">
                         <div class="card-body">

                              <form method="post" id="myform" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
                                   <div class="row mt-2">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="token_no">Token Number :</label>
                                                  <input type="text" name="token_no" class="form-control" id="token_no"
                                                       placeholder="Enter Token Number" value="<?php echo $token; ?>" readonly>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="aadhar_no">Aadhar Number :</label>
                                                  <input type="text" name="aadhar_no" id="aadhar_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');checkadhar();" size="12" minlength="12" maxlength="12" class="form-control"
                                                       placeholder="Enter Aadhar Number" required>
                                                       <span id="aadharerror" style="color: red;"></span>


                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="full_name">Full Name :</label>
                                                  <input type="text" name="full_name" id="full_name" class="form-control" oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                                       placeholder="Enter Full Name" required>
                                                       <span id="nameerror" style="color: red;"></span>

                                             </div>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="mobile_no">Mobile Number :</label>
                                                  <input type="text" name="mobile_no" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'')" id="mobile_no" size="10" minlength="10" maxlength="10"
                                                       placeholder="Enter Mobile Number" required>
                                                       <span id="contacterror" style="color: red;"></span>

                                             </div>
                                        </div>
                                   </div>

 
                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <div class="form-group">
                                                  <label for="address">Address :</label>
                                                  <textarea name="address" class="form-control" id="address" rows="3" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                                       placeholder="Enter Address" required></textarea>
                                                       <span id="addrerror" style="color: red;"></span>

                                             </div>
                                        </div>

                                   </div>

                                   <div class="row"> 
                                        <div class="col-md-12 mb-4">
                                             <label for="firm_name">Firm Name :</label>
                                             <input type="text" name="firm_name"  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);checkfirm();"  id="firm_name" class="form-control" placeholder="Enter Firm Name" required>
                                             <span id="firmerror" style="color: red;"></span>

                                        </div>
                                   </div>

                                   <div class="d-grid gap-2 d-sm-block">
                <div>
                <button class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>  Save</button> 
                <!-- <button class="btn btn-secondary" name="submit"><i class="fa-solid fa-id-card"></i>  Id Card</button> -->
                <!-- <button class="btn btn-danger" onclick="window.history.back()" name="back"><i class="fa-solid fa-arrow-left"></i>  Back</button> -->
                <a href="sec.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>
                Back</a>
            </div>
            </div>
                              </form>
                         </div>
                    </div>
               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>


 <!-- script for autofill -->
 <script>
     function ws(name) { 
        var name=document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

        }

const token =document.getElementById('token_no').value.trim();

          function checkadhar(){
            const aadhar_no=document.getElementById('aadhar_no').value.trim();
          //   if(aadhar_no.length==12){



            fetch('../autofill.php?aadhar_no='+aadhar_no)
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                //console.log(data);
                if(data.message=="data found"){
                    
                    document.getElementById('token_no').value=data.token_no;
                    document.getElementById('full_name').value=data.full_name;
                    document.getElementById('mobile_no').value=data.mobile_no;
                    document.getElementById('address').value=data.address;
                    document.getElementById('firm_name').value=data.firm_name;

                    document.getElementById('aadhar_no').setAttribute('readonly', true);
                    document.getElementById('full_name').setAttribute('readonly', true);
                    document.getElementById('mobile_no').setAttribute('readonly', true);
                    document.getElementById('address').setAttribute('readonly', true);
                    document.getElementById('firm_name').setAttribute('readonly', true);
               }
               else{
                    document.getElementById('aadhar_no').removeAttribute('readonly');


                    document.getElementById('full_name').removeAttribute('readonly');
                    document.getElementById('mobile_no').removeAttribute('readonly');
                    document.getElementById('address').removeAttribute('readonly');
                    document.getElementById('firm_name').removeAttribute('readonly');

                    document.getElementById('token_no').value = token;
                               


                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
          }
        
//         else{
//             return;
//         }
//     }
        </script>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | SEC";
          document.getElementById('navbar-title').innerHTML = "Add SEC Form";
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








          
          var aadharnoField = document.getElementById("aadhar_no");
          var contactField = document.getElementById("mobile_no");
          var nameField = document.getElementById("full_name");
          var addrField = document.getElementById("address");
          var firmField = document.getElementById("firm_name");





          aadharnoField.addEventListener("input", validateAadharNo);
          contactField.addEventListener("input", validateContact);
          nameField.addEventListener("input", validateName);
          addrField.addEventListener("input", validateAddr);
          firmField.addEventListener("input", validateFirm);





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

            if (fullname.trim()=="") {
                errorElement.textContent = "Fill Out This Field";
                nameField.classList.add("invalid");
                return false;
            } 
            else{
                errorElement.textContent = "";
                nameField.classList.remove("invalid");
            return true;

            }
         }




         function validateAddr() {
            var address = addrField.value;
            var errorElement = document.getElementById("addrerror");

            if (address.trim()=="") {
                errorElement.textContent = "Fill Out This Field";
                addrField.classList.add("invalid");
                return false;
            } 
            else{
                errorElement.textContent = "";
                addrField.classList.remove("invalid");
            return true;

            }
         }

         function validateFirm() {
            var firm = addrField.value;
            var errorElement = document.getElementById("firmerror");

            if (firm.trim()=="") {
                errorElement.textContent = "Fill Out This Field";
                firmField.classList.add("invalid");
                return false;
            } 
            else{
                errorElement.textContent = "";
                firmField.classList.remove("invalid");
            return true;

            }
         }





         const form  = document.getElementById('myform');
    //console.log("sahil");


    form.addEventListener('submit', (event) => {
        // handle the form data            event.preventDefault();
        // event.preventDefault();        
          if(!validateContact() || !validateAadharNo() || !validateName() || !validateAddr() || !validateFirm()){
          event.preventDefault();
          }
          
      
    });
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