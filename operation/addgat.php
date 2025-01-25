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
    <?php // include($apppath . "generateQr.php"); ?>
    <?php // include($qr_code_lib . "qrlib.php"); ?>
</head>
<?php
$token = "";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}else{
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";die;
}
//include('connection.php');
if (isset($_POST['submit'])) {

    $token_no = $_POST['token_no'];
    $aadhar_no = $_POST['aadhar_no'];
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    $working_as = "Operation - Gat";
    // if all values are setted
        // // qr_code generation and qr image saving
        // $qr_code = generateQr($token, $working_as);
        // if (!file_exists($qr_code_dir)) {
        //     mkdir($qr_code_dir);
        // }
        // $filename = $qr_code_dir . 'qr' . md5($qr_code) . '.png';
        // qr_code::png(@$qr_code, $filename);



         // sonal kiran bhirud 21-05-24 working on unique aadhar no
    $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
    $resa = mysqli_query($connection,$sqla);

    if(mysqli_num_rows($resa) > 0) {

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() { 
            document.getElementById("error-box").style.display = "block"; 
        });
      </script>';
        //echo "already exist";
        // echo '<script>document.addEventListener("DOMContentLoaded", function() {
        //     swal("sorry!", "...already exist!");});
        //  </script>';

        //  echo '<script>
         
        //  alert("sorry!, ...already exist!");


        // </script>';
         
 




        // $sqli="SELECT * FROM officer where aadhar_no= '$aadhar_no'";
        // $resi = mysqli_query($conn,$sqli);
        // $row = mysqli_fetch_assoc($resi);
    



    }else{
        $sqlof = "INSERT INTO `uni_aadhar` (`aadhar_no`, `role`) VALUES ('$aadhar_no', 'GAT')";
        $resof = mysqli_query($connection, $sqlof); 





        //    $sql = "INSERT INTO `gat`(`token_no`, `aadhar_no`,`full_name`,`mobile_no`,`address`) values('$token_no', '$aadhar_no','$full_name','$mobile_no','$address')";
        $sql = "UPDATE `gat` SET `aadhar_no`='$aadhar_no' ,`full_name`='$full_name' ,`mobile_no`='$mobile_no' ,`address`='$address' WHERE `token_no` = '$token'";
        $result = mysqli_query($connection, $sql);
        // $row = mysqli_fetch_assoc($res);

        if ($result) {
            $_SESSION['flash_message']="Data Submitted";
            echo '<script>
                window.location.href = "gat.php";
        </script>';
        } 
    

}
}
?>
<?php

$token_no = $_GET['token'];
//include('connection.php');
if (isset($_POST['idcard'])) {

    // qr_code generation and qr image saving
    // $qr_code = generateQr($token, $working_as);
    // if (!file_exists($qr_code_dir)) {
    //     mkdir($qr_code_dir);
    // }
    // $filename = $qr_code_dir . 'qr' . md5($qr_code) . '.png';
    // qr_code::png(@$qr_code, $filename);
    // $sql_update_qr = "UPDATE `gat` SET `qr_code`='$qr_code',`qrpath`='$filename' WHERE `token_no` = '$token'";
    // $res_update_qr = mysqli_query($connection, $sql_update_qr);
    // $row = mysqli_fetch_assoc($res);

    if ($res_update_qr) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            alert("Data Submitted");
            window.location.href = "gat.php";
        });
    </script>';


    } else {
        echo "fail";
    }
}

?>

<!--  -->
<?php

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

                        <form method="post" action="#" id="myform" enctype="multipart/form-data">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="token_no">Token Number :</label>
                                        <input type="text" name="token_no" class="form-control"
                                            placeholder="Enter Token Number" id="token_no" value="<?php echo $token_no; ?>" readonly>
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
                                        <input type="text" name="full_name" id="full_name" oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);" class="form-control"
                                            placeholder="Enter Full Name" required>
                                            <span id="nameerror" style="color: red;"></span>

                                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="mobile_no"><b>Mobile Number :</b></label>
                                        <input type="text" name="mobile_no" id="mobile_no" oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10" minlength="10" maxlength="10" class="form-control"
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
                            <div class="btn">
                                <button class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                                <!-- <button class="btn btn-secondary" name="icard" id="idcard"><i
                                        class="fa-solid fa-id-card"></i> Id
                                    Card</button> -->
                                    <a href="gat.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- container-fluid ends here -->
            <!-- End Page Content -->
        </div>
    </div>

    <!-- Start writing content here -->
    <main>

    </main>



<!-- script for autofill -->
<script>
    function ws(name) { 
        var name=document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

        }


        const token =document.getElementById('token_no').value.trim();

          function checkadhar(){
            const aadhar_no=document.getElementById('aadhar_no').value.trim();
            // if(aadhar_no.length==12){




            fetch('../autofill.php?aadhar_no='+aadhar_no)
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if(data.message=="data found"){
                     // echo $row1['token_no'];
            // echo $row1['full_name'];
            // echo $row1['mobile_no'];
            // echo $row1['address'];
                    document.getElementById('token_no').value=data.token_no;
                    document.getElementById('full_name').value=data.full_name;
                    document.getElementById('mobile_no').value=data.mobile_no;
                    document.getElementById('address').value=data.address;
              
                    document.getElementById('aadhar_no').setAttribute('readonly', true);
                                document.getElementById('full_name').setAttribute('readonly', true);
                                document.getElementById('mobile_no').setAttribute('readonly', true);
                                document.getElementById('address').setAttribute('readonly', true);

                            }
                            else{
                                document.getElementById('aadhar_no').removeAttribute('readonly');


                                document.getElementById('full_name').removeAttribute('readonly');
                                document.getElementById('mobile_no').removeAttribute('readonly');
                                document.getElementById('address').removeAttribute('readonly');

                               

                    // document.getElementById('full_name').value="";
                    // document.getElementById('mobile_no').value="";
                    // document.getElementById('address').value="";

                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });

        }
        
    //     else{
    //         return;
    //     }
    // }
        </script>
            <!-- giving title to document and navbar -->
    <script>
        // document.getElementById('idcard').style.display = "none";
        document.getElementById('page-title').innerHTML = "HPCL INOUT | GAT";
        document.getElementById('navbar-title').innerHTML = "Add GAT Form";
    </script>

    <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
    <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
   
   

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
         const form  = document.getElementById('myform');
    //console.log("sahil");


    form.addEventListener('submit', (event) => {
        // handle the form data            event.preventDefault();
        // event.preventDefault();        
          if(!validateContact() || !validateAadharNo() || !validateName() || !validateAddr()){
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