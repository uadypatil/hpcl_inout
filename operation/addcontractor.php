<!-- name: Shubham Chhanwal || date: 14-05-2024 -->
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
    <title id="page-title"></title>
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
$token = "";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}else{
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";die;
}
if (isset($_POST['submit'])) {
    $aadhar_no = $_POST['aadhar_no'];
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    $firm_name = $_POST['firm_name'];


    // sonal kiran bhirud 21-05-24 working on unique aadhar no
    $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
    $resa = mysqli_query($connection, $sqla);

    if (mysqli_num_rows($resa) > 0) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() { 
            document.getElementById("error-box").style.display = "block"; 
        });
      </script>';
        //echo "already exist";
        // echo '<script>
         
        //       alert("sorry!", "...already exist!");


        //  </script>';




        // $sqli="SELECT * FROM officer where aadhar_no= '$aadhar_no'";
        // $resi = mysqli_query($conn,$sqli);
        // $row = mysqli_fetch_assoc($resi);


    } else {
        $sqlof = "INSERT INTO `uni_aadhar` (`aadhar_no`, `role`) VALUES ('$aadhar_no', 'CON')";
        $resof = mysqli_query($connection, $sqlof);


        $sql = "UPDATE `contractor` SET `aadhar_no`='$aadhar_no',`full_name`='$full_name',`mobile_no`='$mobile_no',`address`='$address',`firm_name`='$firm_name' WHERE `token_no` = '$token'";


        //   print_r($sql);die;
        $res = mysqli_query($connection, $sql);

        // print_r($res);die;




        if ($res) {
            $_SESSION['flash_message']="Data Submitted";
            echo '<script>
                window.location.href = "contractor.php";
        </script>';

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
                <!-- container-fluid -->

                <div id="error-box" class="alert alert-danger" style="display: none;">Aadhar no already exist</div>


                <div class="card border-0 shadow mt-4">
                    <div class="card-body m-4">

                        <form method="post" id="myform" action="#" enctype="multipart/form-data">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-4">
                                    <label for="token_no">Token Number :</label>
                                    <input type="text" name="token_no" id="token_no" value="<?php echo $token ?>"
                                        class="form-control" placeholder="Token Number" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="aadhar_no">Aadhar Number :</label>
                                    <input type="text" name="aadhar_no" id="aadhar_no"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');checkadhar();" size="12"
                                        minlength="12" maxlength="12" class="form-control" placeholder="Enter Aadhar Number" required>
                                        <span id="aadharerror" style="color: red;"></span>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="full_name">Full Name :</label>
                                    <input type="text" name="full_name" id="full_name"
                                        oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);" class="form-control"
                                        placeholder="Enter Full Name" required>
                                        <span id="nameerror" style="color: red;"></span>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="mobile_no">Mobile Number :</label>
                                    <input type="text" name="mobile_no" id="mobile_no"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10" minlength="10"
                                        maxlength="10" class="form-control" placeholder="Enter Mobile Number" required>
                                        <span id="contacterror" style="color: red;"></span>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="address">Address :</label>
                                    <textarea name="address" class="form-control" id="address" rows="3"
                                                       placeholder="Enter Address" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);" required></textarea>
                                                       <span id="addrerror" style="color: red;"></span>


                                </div>

                            </div>

                            


                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="firm_name">Firm Name:</label>
                                    <input type="text" name="firm_name" id="firm_name" class="form-control" required
                                        placeholder="Enter Firm Name" oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);">
                                        <span id="firmerror" style="color: red;"></span>

                                </div>
                            </div>

                            <div class="d-grid gap-2 d-sm-block">
                                <div>
                                    <button class="btn btn-primary" id="submit" name="submit"><i
                                            class="fa-solid fa-floppy-disk"></i> Save</button>
                                    <!-- <button class="btn btn-secondary" name="id_card" id="submit"><i class="fa-solid fa-id-card"></i>  Id Card</button> -->
                                    <a href="contractor.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>
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



    <!-- giving title to document and navbar -->
    <script>
        document.getElementById('page-title').innerHTML = "HPCL INOUT | Contractor";
        document.getElementById("navbar-title").innerHTML = "Add Contractor Form <i class='fa-solid fa-users'></i>";
    </script>

    <!-- script for autofill -->
    <script>
        function ws(name) { 
        var name=document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

        }



        const token = document.getElementById('token_no').value.trim();

        function checkadhar() {
            const aadhar_no = document.getElementById('aadhar_no').value.trim();
            // if(aadhar_no.length==12){



            fetch('../autofill.php?aadhar_no=' + aadhar_no)
                .then(response => {
                    console.log(response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    //console.log(data);
                    if (data.message == "data found") {

                        document.getElementById('token_no').value = data.token_no;
                        document.getElementById('full_name').value = data.full_name;
                        document.getElementById('mobile_no').value = data.mobile_no;
                        document.getElementById('address').value = data.address;
                        document.getElementById('firm_name').value = data.firm_name;
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
                        // document.getElementById('full_name').value = "";
                        // document.getElementById('mobile_no').value = "";
                        // document.getElementById('address').value = "";
                        // document.getElementById('firm_name').value = "";
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
    <script>
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