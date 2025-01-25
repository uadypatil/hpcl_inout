<!-- name: Shubham shinde || date: 13-05-2024 -->
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

</head>
     <!-- including config file to use database -->
     <?php
include($config_loc);

$token = 0;
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "Invalid page! <a id='backbtn' href='../login.php'>go to login page</a>";
    die;
}
if(isset($_POST['submit'])){
    $aadhar_no = $_POST['aadhar_no'];
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    $to_see_whom = $_POST['to_see_whom'];
    $purpose_to_visit = $_POST['purpose_to_visit'];
    // $is_regular = $_POST['is_regular'];
    $is_regular = isset($_POST['is_regular']) ? 1 : 0;
        $date =  date('Y-m-d');

    $photo_data = $_POST['photo']; // Base64 encoded image data

    // Save photo to a folder on the server
    $photo_dir = 'visitor_photos/';
    $photo_file = $photo_dir . uniqid('photo_') . '.png';
    file_put_contents($photo_file, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo_data)));

    // sonal kiran bhirud 21-05-24 working on unique aadhar no
    $sqla = "SELECT * FROM `uni_aadhar` where `aadhar_no`= '$aadhar_no'";
    $resa = mysqli_query($connection,$sqla);

    if(mysqli_num_rows($resa) > 0) {
        
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() { 
            document.getElementById("error-box").style.display = "block"; 
        });
      </script>';
    }else{
        $sqlof = "INSERT INTO `uni_aadhar` (`aadhar_no`, `role`) VALUES ('$aadhar_no', 'VR')";
        $resof = mysqli_query($connection, $sqlof); 

        $sql = "UPDATE `visitor` SET `aadhar_no`='$aadhar_no',`full_name`='$full_name',`mobile_no`='$mobile_no',`address`='$address',`to_see_whom`='$to_see_whom',`purpose_to_visit`='$purpose_to_visit',`photo`='$photo_file',`is_regular`='$is_regular',`date`='$date' WHERE `token_no` = '$token'";

   $a = mysqli_query($connection, $sql); 
   // $row = mysqli_fetch_assoc($res);

   if($a){
    $_SESSION['flash_message']="Data Submitted";
    echo '<script>
        window.location.href = "visitor.php";
</script>';

       
   }

}
}
$sql1="SELECT * FROM officer WHERE `full_name` != ''";
$res1=mysqli_query($connection, $sql1);

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
    <form method="post" action="#" id="visitorForm" enctype="multipart/form-data">
                <div class="row mt-2">
                    <div class="col-md-12 mb-4">
                        <label for="token" >Token Number:</label>
                        <input type="text" name="token_no" id="token_no" class="form-control" placeholder="Token Number" value="<?php echo $token; ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="aadhar_no">Aadhar Number:</label>
                        <input type="text" name="aadhar_no" id="aadhar_no"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');checkadhar();" size="12"
                                        minlength="12" maxlength="12" class="form-control"
                                        placeholder="Enter Aadhar Number" >
                        <!-- <input type="text" name="aadhar_no" id="aadhar_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');checkadhar();" size="12" minlength="12" maxlength="12" class="form-control" placeholder="Enter Aadhar Number" required> -->
                        <small id="aadharerror" class="error text-danger"></small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="name">Full Name:</label>
                        <input type="text" name="full_name" id="full_name"
                        oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);" class="form-control" placeholder="Enter Full Name" >
                        <small id="nameerror" class="error text-danger"></small>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="number">Mobile Number:</label>
                        <input type="text" name="mobile_no" id="mobile_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');" size="10" minlength="10" maxlength="10"  class="form-control" placeholder="Enter Mobile Number" >
                        <small id="contacterror" class="error text-danger" ></small>
                    </div>
                </div>

                    
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" class="form-control" rows="3" oninput="this.value=this.value.replace(/[^a-z\sA-Z0-9,.-]/g,'');ws(this.id);" placeholder="Enter Address" ></textarea>
                        <small id="addrerror" class="error text-danger"></small>

                    </div>
                  
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="to_see_whom">To See Whom:</label>
                        <!-- <input type="text" name="to_see_whom" id="to_see_whom" class="form-control"> -->
                        <select name="to_see_whom" id="to_see_whom" class="form-control" >
                        <option value="">Select</option>

                            <?php
                                $cn =1;
                                while($row1 = mysqli_fetch_assoc($res1)){
                             ?>

                                <option value="<?php echo $row1['full_name'] ?>"><?php echo $row1['full_name'] ?></option>
                            <?php } ?>
                        </select>
                        <small id="seewhomerror" class="error text-danger" ></small>

                    </div>
                  
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="purpose_to_visit">Purpose To Visit:</label>
                        <textarea name="purpose_to_visit" id="purpose_to_visit"
                        oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id);" placeholder="Enter the Purpose To Visit" class="form-control" rows="3" ></textarea>
                        <small id="purposeerror" class="error text-danger"></small>

                    </div>
                  
                </div>
                <div class="row mb-4">  
                <label for="photo">Capture Photo:</label>
                    <div class="col-md-6">
                        <div id="camera-feed">
                            <video id="video" width="320" height="240" autoplay></video><br>
                            <small id="photoValidation" class="error text-danger"></small>
                        </div>
                        <button type="button" class="btn btn-primary" id="capture-btn" onclick="showCanvas()">Capture</button>
                        <input type="hidden" id="photo" name="photo" value="">
                    </div>
                    <div class="col-md-6">
                        <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                        <img src="" alt="" id="pic" width="320" height="240" style="display:none;"><br><br>
                    </div>
                </div>
                <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_regular" value="1" id="is_regular">
                      <label class="form-check-label" for="is_regular">
                        Is Regular ?
                      </label>
                </div>
                <div class="d-grid gap-2 d-sm-block mt-4">
                
                <button type="submit" class="btn btn-primary" id="submit" name="submit">
                    <i class="fa-solid fa-floppy-disk"></i> Save</button>
                <!-- <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>  Save</button>  -->
                <!-- <button class="btn btn-secondary" name="submit"><i class="fa-solid fa-id-card"></i>  Id Card</button> -->
                <a href="visitor.php"  class="btn btn-danger" ><i class="fa-solid fa-arrow-left"></i>Back</a><div>
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
    <!-- capture photo -->
     <script>
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(function(stream) {
          var video = document.getElementById('video');
          video.srcObject = stream;
          video.play();
      })
      .catch(function(err) {
          console.log("An error occurred: " + err);
      });

      function showCanvas() {
      document.getElementById('canvas').style.display = 'block';
    }

    document.getElementById('capture-btn').addEventListener('click', function() {
      var video = document.getElementById('video');
      var canvas = document.getElementById('canvas');
      var context = canvas.getContext('2d');
      canvas.width = 320;
      canvas.height = 240;

      context.drawImage(video, 0, 0, 320, 240);
      var photo = canvas.toDataURL('image/png');

      document.getElementById('photo').value = photo;
    });
  </script>



     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Visitor Form";
          document.getElementById("navbar-title").innerHTML = "Add Visitor Form <i class='fa-solid fa-users'></i>";
     </script>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     
            <!-- script for autofill -->
            <script>

function ws(name) { 
        var name=document.getElementById(name);
        name.value = name.value.replace(/^\s+/, '');

        }

        const token =document.getElementById('token_no').value.trim();

          function checkadhar(){
            const aadhar_no=document.getElementById('aadhar_no').value.trim();
            if(aadhar_no.length==12){


            fetch('autofillvr.php?aadhar_no='+aadhar_no)
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
                    document.getElementById('to_see_whom').value=data.to_see_whom;
                    document.getElementById('purpose_to_visit').value=data.purpose_to_visit;
                    document.getElementById('is_regular').checked=true;
                    document.getElementById('pic').style.display="block";
                    document.getElementById('pic').src=data.photo;
                    document.getElementById('photo').value=data.photo;



                    document.getElementById('aadhar_no').setAttribute('readonly', true);
                    document.getElementById('full_name').setAttribute('readonly', true);
                    document.getElementById('mobile_no').setAttribute('readonly', true);
                    document.getElementById('address').setAttribute('readonly', true);
                    document.getElementById('to_see_whom').setAttribute('readonly', true);
                    document.getElementById('purpose_to_visit').setAttribute('readonly', true);
                    document.getElementById('is_regular').setAttribute('disabled', true);
                    document.getElementById('photo').setAttribute('readonly', true);
                    document.getElementById('capture-btn').setAttribute('disabled', true);



                }
                else{

                    document.getElementById('aadhar_no').removeAttribute('readonly', true);
                    document.getElementById('full_name').removeAttribute('readonly', true);
                    document.getElementById('mobile_no').removeAttribute('readonly', true);
                    document.getElementById('address').removeAttribute('readonly', true);
                    document.getElementById('to_see_whom').removeAttribute('readonly', true);
                    document.getElementById('purpose_to_visit').removeAttribute('readonly', true);
                    document.getElementById('is_regular').removeAttribute('disabled', true);
                    document.getElementById('photo').removeAttribute('readonly', true);
                    document.getElementById('capture-btn').removeAttribute('disabled', true);

                    document.getElementById('token_no').value=token;
                    


                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });

          } else {
            return;
          }
        }
        </script>


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
     <script>

document.getElementById("visitorForm").addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if any validation fails
        }
    });

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
            aadharnoField.focus();
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
            contactField.focus();
            contactField.classList.add("invalid");
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
            nameField.focus();

            return false;
        } else {
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
            purposeField.focus();
            purposeField.classList.add("invalid");
            return false;
        } else {
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
            seewhomField.focus();
            seewhomField.classList.add("invalid");
            return false;
        } else {
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
            addrField.focus();
            addrField.classList.add("invalid");
            return false;
        } else {
            errorElement.textContent = "";
            addrField.classList.remove("invalid");
            return true;
        }
    }

    function validatePhoto() {
        var photoInput = document.getElementById("photo").value;
        var photoValidation = document.getElementById("photoValidation");

        if (photoInput == "") {
            photoValidation.textContent = "Please capture the photo of the visitor.";
            photoValidation.style.display = 'block';
            return false;
        } else {
            photoValidation.textContent = "";
            photoValidation.style.display = 'none';
            return true;
        }
    }

    function validateForm() {
        return validateAadharNo() && validateName() && validateContact() && validateAddr() && validateSeeWhom() &&validatePurpose() &&  validatePhoto();
    }
</script>
</body>

</html> 