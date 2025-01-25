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

$sql = "SELECT * from visitor where token_no=$token";
$res = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($res);
$aadhar_old = $row['aadhar_no'];


?>

<!-- edit sec  -->

<?php
if (isset($_POST['update'])) {
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
     $to_see_whom = $_POST['to_see_whom'];
     $purpose_to_visit = $_POST['purpose_to_visit'];
     // $is_regular = $_POST['is_regular'];
     $is_regular = isset($_POST['is_regular']) ? $_POST['is_regular'] : 0;

     // Check if a new photo is captured
    $new_photo = $_POST['new_photo']; // This is the flag
    $photo_file = $row['photo']; // Default to the existing photo path

    if ($new_photo == '1') {
        $photo_data = $_POST['photo']; // Base64 encoded image data

        // Save new photo to a folder on the server
        $photo_dir = 'visitor_photos/';
        $photo_file = $photo_dir . uniqid('photo_') . '.png';
        file_put_contents($photo_file, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo_data)));
    }

 
          // sonal kiran bhirud 21-05-24 working on unique aadhar no
          $sqla = "SELECT * FROM uni_aadhar where aadhar_no= '$aadhar_no'";
          $resa = mysqli_query($connection, $sqla);

          if(mysqli_num_rows($resa) > 0){
               $rowa=mysqli_fetch_assoc($resa);
               $table=$rowa['role'];
               if ($table == 'VR') {
          
              $sqlo = "SELECT * FROM visitor where aadhar_no= '$aadhar_no'";
              $reso = mysqli_query($connection, $sqlo);
              if ( mysqli_num_rows($reso) > 0) {
               $rowo= mysqli_fetch_assoc($reso);
          
               $aadhar_number=$rowo['aadhar_no'];
               $token_number=$rowo['token_no'];
          
               if( $token_number == $token_no && $aadhar_number == $aadhar_no){
          
                    $sql = "UPDATE visitor SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',to_see_whom='$to_see_whom',purpose_to_visit='$purpose_to_visit',is_regular='$is_regular',photo=' $photo_file' WHERE token_no = '$token_no'";
                    $res = mysqli_query($connection, $sql);
               
                    $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
                    $res1 = mysqli_query($connection, $sql1);
               
                    if ($res && $res1) {
                         $_SESSION['flash_message']="Data Updated";
                         echo '<script>
                             window.location.href = "visitor.php";
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
          
               $sql = "UPDATE visitor SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',to_see_whom='$to_see_whom',purpose_to_visit='$purpose_to_visit',is_regular='$is_regular',photo=' $photo_file' WHERE token_no = '$token_no'";
               $res = mysqli_query($connection, $sql);
          
               $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
               $res1 = mysqli_query($connection, $sql1);
          
               if ($res && $res1) {
                    $_SESSION['flash_message']="Data Updated";
                    echo '<script>
                        window.location.href = "visitor.php";
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
     
          $sql = "UPDATE visitor SET aadhar_no='$aadhar_no',full_name='$full_name',mobile_no='$mobile_no',address='$address',to_see_whom='$to_see_whom',purpose_to_visit='$purpose_to_visit',is_regular='$is_regular',photo=' $photo_file' WHERE token_no = '$token_no'";
               $res = mysqli_query($connection, $sql);
          
               $sql1 = "UPDATE uni_aadhar SET aadhar_no='$aadhar_no' WHERE aadhar_no='$aadhar_old'";
               $res1 = mysqli_query($connection, $sql1);
          
               if ($res && $res1) {
                    $_SESSION['flash_message']="Data Updated";
                    echo '<script>
                        window.location.href = "visitor.php";
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
     $sql2 = "UPDATE `visitor` SET `srno`=NULL,`aadhar_no`=NULL,`full_name`=NULL,`mobile_no`=NULL,`address`=NULL,`to_see_whom`=NULL,`purpose_to_visit`=NULL,`is_regular`='0',`date`=NULL,`working_as`=NULL,`photo`=NULL,`qr_code`=NULL,`qrpath`=NULL,`time_in`=NULL,`time_out`=NULL ,`restricted` = '0' WHERE `token_no`='$token'";

     // $sql = "DELETE FROM doctor WHERE id = '$id'";
     $res2 = mysqli_query($connection, $sql2);

     $sqlzi = "UPDATE `uni_aadhar` SET `aadhar_no`=NULL,`role`=NULL WHERE `aadhar_no`='$aadhar_old'";
    $reszi = mysqli_query($connection, $sqlzi);


    if ($reszi && $res2) {        
     $_SESSION['flash_message']="Data Deleted";
     echo '<script>
         window.location.href = "visitor.php";
 </script>';
      } else {
          echo "Failed to update data";
      }
      
}
$sql3="SELECT * FROM officer WHERE `full_name` != ''";
$res3=mysqli_query($connection, $sql3);
?>



<!-- php code for icard generation -->
<?php

// function to detect qr_code is genertated or not
function isQrGenerated($token_no)
{

     $sql = "SELECT qr_code FROM visitor WHERE token_no = $token_no";
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
     $sql = "SELECT id, token_no, working_as FROM visitor WHERE token_no = '$token_no'";
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
     // $submodule = trim(substr($input_string, $dash_position + 1));
     $submodule = "V";
     $module = "";
   
     // if ($submodule == 'TAT' || $submodule == 'tat') {
     //      $submodule = "Tat";
     // }

     $finalQr = $submodule . "/HPNSK/" . $token_no;
     //     pw/hpnsk/1

     include "../phpqrcode/qrlib.php";
     // directory generation for qr_codes
     $qr_img_dir = 'qr_code/';
     // including files for qrgeneration
     if (!file_exists($qr_img_dir)) {
          mkdir($qr_img_dir);
     }

     // qr image generation
     $filename = $qr_img_dir . 'qr-' . md5($finalQr) . '.png';
     qr_code::png(@$finalQr, $filename);


     $sqlUpdate = "UPDATE visitor SET qr_code='$finalQr' ,qrpath='$filename'  WHERE token_no = '$token_no'";
     $resupdate = mysqli_query($connection, $sqlUpdate);

}

// function to show IdCard
function showIdCard($token_no)
{
     header("Location: visitorEntryPass.php?token=$token_no");
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
                         <div class="card-body m-4">

                              <form method="post" id="visitorForm"
                                   action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                                   enctype="multipart/form-data" >
                                   <div class="row mt-2">
                                        <div class="col-md-12 mb-2">
                                             <input type="hidden" name="id" value="<?php echo $row['id']; ?> "
                                                  class="form-control">

                                             <label for="token_no">Token Number:</label>
                                             <input type="text" name="token_no" value="<?php echo $token; ?> "
                                                  class="form-control" placeholder="Token Number" readonly>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <label for="aadhar_no">Aadhar Number:</label>
                                             <input type="text" name="aadhar_no" id="aadhar_no" class="form-control"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'');" size="12"
                                                  minlength="12" maxlength="12" value="<?php echo $row['aadhar_no']; ?>"
                                                  placeholder="Aadhar Number">
                                             <span id="aadharerror" style="color: red;"></span>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <label for="full_name">Full Name:</label>
                                             <input type="text" name="full_name" id="full_name" class="form-control"
                                                  value="<?php echo $row['full_name']; ?>"
                                                  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id)"
                                                  placeholder="Full Name">
                                             <span id="nameerror" style="color: red;"></span>

                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <label for="mobile_no">Mobile Number:</label>
                                             <input type="text" name="mobile_no" class="form-control"
                                                  value="<?php echo $row['mobile_no']; ?>" id="mobile_no"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="10"
                                                  minlength="10" maxlength="10" placeholder="Mobile Number">
                                             <span id="contacterror" class="error text-danger"></span>
                                        </div>
                                   </div>


                                   <div class="row">
                                        <div class="col-md-12 mb-2">
                                             <label for="address">Address:</label>
                                             <textarea name="address" id="address" class="form-control"
                                                  oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);"
                                                  rows="3"><?php echo $row['address']; ?></textarea>
                                             <span id="addrerror" style="color: red;"></span>


                                        </div>
                                        <div class="col-md-12 mb-2">
                                             <label for="to_see_whom">To See Whom:</label>
                                             <select name="to_see_whom" id="to_see_whom" class="form-control">
                                                  <option value="">Select</option>

                                                  <?php
                                                  $name=$row['to_see_whom'];
                                                    $cn =1;
                                                    while($row3 = mysqli_fetch_assoc($res3)){
                                                 ?>

                                                  <option value="<?php echo $row3['full_name'] ?>" <?php
                                                       if($row3['full_name']==$name){ echo 'selected' ;}?>>
                                                       <?php echo $row3['full_name'] ?>
                                                  </option>

                                                  <?php } ?>
                                             </select>
                                             <small id="seewhomerror" class="error text-danger" ></small>


                                        </div>
                                        <div class="col-md-12 mb-2">
                                             <label for="purpose_to_visit">Purpose To Visit:</label>
                                             <textarea name="purpose_to_visit" class="form-control"
                                                  placeholder="Enter the Purpose To Visit" id="purpose_to_visit"
                                                  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);"
                                                  ><?php echo $row['purpose_to_visit'] ?></textarea>
                                             <span id="purposeerror" class="error text-danger"></span>

                                        </div>
                                        <div class="row mb-4 ps-4">
                                             <label for="photo" class="ps-4">Capture Photo:</label>
                                             <div class="col-md-6">
                                                  <div id="camera-feed">
                                                       <video id="video" width="320" height="240" autoplay></video>
                                                       <small id="photoValidation" class="error text-danger"></small>

                                                  </div>
                                                  <button type="button" class="btn btn-primary" id="capture-btn"
                                                       onclick="capturePhoto()">Capture</button>
                                                  <input type="hidden" id="photo" name="photo" value="<?php echo $row['photo'] ?>">
                                                  <input type="hidden" id="new_photo" name="new_photo" value="">

                                             </div>
                                             <div class="col-md-6">
                                                  <canvas id="canvas" width="320" height="240"
                                                       style="display:none;"></canvas>
                                                  <div id="pic">
                                                       <img src="<?php echo $row['photo'] ?>" alt="" width="320"
                                                            height="240">
                                                  </div>
                                                  <br><br>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="form-check ms-3 mb-4">
                                                       <input class="form-check-input" type="checkbox" name="is_regular"
                                                            id="is_regular" value="1" <?php echo
                                                            ($row['is_regular']=='1' ) ? "checked" : "" ; ?>>
                                                       <label class="form-check-label" for="is_regular">Is Regular
                                                            ?</label>
                                                  </div>
                                             </div>
                                        </div>

                                   </div>
                                   <div class="d-grid gap-2 d-sm-block">
                                        <div class="d-flex gap-2">
                                             <button class="btn btn-primary" name="update"><i
                                                       class="fa-solid fa-floppy-disk"></i>
                                                  Update</button>
                                             <button class="btn btn-success" name="idcard-btn" id="idcard-btn"><i
                                                       class="fa-solid fa-ticket"></i> Generate Gate Pass</button>
                                                       <a href="visitor.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>Back</a><div>
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

     <!-- capture photo -->
     <script>
          navigator.mediaDevices.getUserMedia({ video: true })
               .then(function (stream) {
                    var video = document.getElementById('video');
                    video.srcObject = stream;
                    video.play();
               })
               .catch(function (err) {
                    console.log("An error occurred: " + err);
               });

          function capturePhoto() {
               var video = document.getElementById('video');
               var canvas = document.getElementById('canvas');
               var context = canvas.getContext('2d');
               canvas.width = 320;
               canvas.height = 240;

               context.drawImage(video, 0, 0, 320, 240);
               var photo = canvas.toDataURL('image/png');

               document.getElementById('photo').value = photo;
               document.getElementById('new_photo').value = '1'; // Set flag indicating new photo captured
               document.getElementById('pic').style.display = "none";
               canvas.style.display = 'block';
               photoValidation.style.display = 'none'; // Hide the error message 

          }
     </script>
     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Visitor";
          document.getElementById('navbar-title').innerHTML = "Edit Visitor Form <i class='fa-solid fa-users'></i>";
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

         <!-- photo Validation -->
    <script>
    document.getElementById("visitorForm").addEventListener("submit", function (event) {
        var photoInput = document.getElementById("photo").value;
        var picInput = document.getElementById("pic").src;
        var photoValidation = document.getElementById("photoValidation");

        if(photoInput == ""){
            photoValidation.textContent = "Please capture the photo of the visitor.";
            photoValidation.style.display = 'block'; // Ensure the error message is visible
            event.preventDefault();  
        } else {
            photoValidation.textContent = "";
            photoValidation.style.display = 'none'; // Hide the error message if no error
        }
    });
</script>

     <script>


          function ws(name) {
               var name = document.getElementById(name);
               name.value = name.value.replace(/^\s+/, '');
          }




          var aadharnoField = document.getElementById("aadhar_no");
var contactField = document.getElementById("mobile_no");
var nameField = document.getElementById("full_name");
var addrField = document.getElementById("address");
var purposeField = document.getElementById("purpose_to_visit");
var seewhomField = document.getElementById("to_see_whom");






aadharnoField.addEventListener("input", validateAadharNo);
contactField.addEventListener("input", validateContact);
nameField.addEventListener("input", validateName);
addrField.addEventListener("input", validateAddr);
purposeField.addEventListener("input", validatePurpose);
seewhomField.addEventListener("change", validateSeeWhom);






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

// function validatePhoto() {
//     var aadharno = aadharnoField.value;
//     var errorElement = document.getElementById("aadharerror");

//     var photoInput = document.getElementById("photo").value;
//         var picInput = document.getElementById("pic").src;
//         var photoValidation = document.getElementById("photoValidation");

//         if (photoInput == "" ) {
//             photoValidation.textContent = "Please capture the photo of the visitor.";
//             photoValidation.style.display = 'block'; // Ensure the error message is visible
//             event.preventDefault();  // Prevent form submission if the photo is not captured
//         } else {
//             photoValidation.textContent = "";
//             photoValidation.style.display = 'none'; // Hide the error message if no error
//         }

// }



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
function validatePurpose() {
    var purpose = purposeField.value;
    var errorElement = document.getElementById("purposeerror");

    if (purpose.trim() == "") {
        errorElement.textContent = "Fill Out This Field";
        purposeField.classList.add("invalid");
        return false;
    }
    else {
        errorElement.textContent = "";
        purposeField.classList.remove("invalid");
        return true;

    }
}
function validateSeeWhom() {
    var see = seewhomField.value;
    var errorElement = document.getElementById("seewhomerror");

    if (see == "") {
        errorElement.textContent = "Please Select The Person To Visit";
        seewhomField.classList.add("invalid");
        return false;
    }
    else {
        errorElement.textContent = "";
        seewhomField.classList.remove("invalid");
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
const form = document.getElementById('visitorForm');
//console.log("sahil");


form.addEventListener('submit', (event) => {
    // handle the form data            event.preventDefault();
    // event.preventDefault();        
    if (!validateAadharNo() && !validateName() && !validateContact() && !validateAddr() && !validatePurpose() &&  !validateSeeWhom()) {
        event.preventDefault();
    } else if(!validateAadharNo() || !validateName() || !validateContact() || !validateAddr() || !validatePurpose() ||  !validateSeeWhom()) {
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

     <script>
          function confirmDelete(event) {
               if (confirm("Are you sure you want to delete?")) {
                    // alert("Data Deleted Succesfully");

                    window.location.href = "visitor.php";
               } else {

                    event.preventDefault();
               }
          }
     </script>

</body>

</html>