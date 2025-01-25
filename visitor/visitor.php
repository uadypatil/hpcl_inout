<!-- Shubham Shinde 13 May 2024 -->


<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php
include("../root.php");
if (!isset($_SESSION['username'])) {
     header("Location: ../login.php");
     exit();
}




include($config_loc);

// Fetch current number of officers
$sql1 = "SELECT * FROM `visitor`";
$res1 = mysqli_query($connection, $sql1);
$token_no = mysqli_num_rows($res1);

$lastsrno = "";
$srno = "SELECT MAX(srno) AS last_srno FROM srno";
$resultsrno = mysqli_query($connection, $srno);
if ($resultsrno) {
     $show = mysqli_fetch_assoc($resultsrno);
     $lastsrno = $show['last_srno'];
}

if (isset($_POST['submit'])) {
     // Process form submission
     $token = $_POST['addtoken'];
     $total = $token + $token_no;

     for ($x = $token_no + 1; $x <= $total; $x++) {
          $sql2 = "INSERT INTO `visitor`(`token_no`) VALUES ('$x')";
          $res2 = mysqli_query($connection, $sql2);
     }
     header("Location: " . $_SERVER['PHP_SELF']);
     exit;
}
?>

<?php
// Check if flash message exists and display it
if (isset($_SESSION['flash_message'])) {
     if($_SESSION['flash_message'] =='Data Submitted'){
     echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
         alert("Data Submitted");
          });
          </script>';
     } elseif($_SESSION['flash_message'] =='Data Deleted'){
          echo '<script>
               document.addEventListener("DOMContentLoaded", function () {
                    alert("Data Deleted");
               });
          </script>';
     } elseif($_SESSION['flash_message'] =='Data Updated'){
          echo '<script>
               document.addEventListener("DOMContentLoaded", function () {
                    alert("Data Updated");
               });
          </script>';
     }
     // Clear the flash message to ensure it's only displayed once
     unset($_SESSION['flash_message']);
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
     <link rel="icon" href="../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
     <!-- <link rel="icon" href="https://manasvi.tech/demo/assest/img/logos/hp.png" type="image/gif" sizes="16x16"> -->

     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      -->
     <!-- including external links -->
     <?php include($external_links_loc); ?>
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

     <!-- including config file to use database -->

     <style>
          .model {
               display: none;
               /* Hidden by default */
               position: fixed;
               /* Stay in place */
               z-index: 1;
               /* Sit on top */
               left: 0;
               top: 0;
               width: 100%;
               /* Full width */
               height: 100%;
               /* Full height */
               overflow: auto;
               /* Enable scroll if needed */
               background-color: rgb(0, 0, 0);
               /* Fallback color */
               background-color: rgba(0, 0, 0, 0.4);
               /* Black w/ opacity */
               padding-top: 60px;
          }

          /* model content */
          .model-content-1 {
               background-color: #fefefe;
               margin: 1% auto;
               /* 15% from the top and centered */
               /* padding: 20px; */
               border: 1px solid #888;
               width: 40%;
               /* Could be more or less, depending on screen size */
               box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
               animation: animatetop 0.4s;
          }

          /* Add animation */
          @keyframes animatetop {
               from {
                    top: -300px;
                    opacity: 0
               }

               to {
                    top: 0;
                    opacity: 1
               }
          }

          /* Close button */
          .close {
               color: #aaa;
               float: right;
               font-size: 28px;
               font-weight: bold;
          }

          .close:hover,
          .close:focus {
               color: black;
               text-decoration: none;
               cursor: pointer;
          }

          /* model footer */
          .model-foter {
               display: flex;
               justify-content: flex-end;
               padding-top: 20px;
          }

          /* model buttons */
          .model-button {
               padding: 10px 20px;
               margin: 5px;
               border: none;
               cursor: pointer;
               font-size: 16px;
          }

          /* Responsive styles */
          @media screen and (max-width: 768px) {
               .model-content-1 {
                    width: 90%;
                    /* Make the model content take more width on smaller screens */
               }

               .model-button {
                    width: 48%;
                    /* Make buttons full width on smaller screens */
                    margin: 10px 0;
                    /* Add margin for spacing between buttons */
               }

               .model-footer {
                    flex-direction: column;
                    /* Stack buttons vertically on smaller screens */
                    align-items: stretch;
                    /* Ensure buttons take full width */
               }
          }

          @media screen and (max-width: 480px) {
               .model-content-1 {
                    width: 95%;
                    /* Further adjust the width for very small screens */
               }

               .model-footer {
                    padding-top: 10px;
                    /* Adjust padding for small screens */
               }
          }
     </style>
</head>
<?php
// change-sr-no
if(isset($_POST['change-sr-no'])){
     $sr_no = $_POST['sr_no'];
     $sql = "INSERT INTO `srno`(`srno`) VALUES ($sr_no);";
     // echo $sql;die;
     $res = mysqli_query($connection, $sql);
     
     if($res){
          true;
          echo '<script>document.addEventListener("DOMContentLoaded", function() {
               window.location.href = "visitor.php";
           });
            </script>';

     }else{
          echo "<script>alert('Failed to set sr no');</script>";
     }
}
?>

<body>

     <div class="wrapper d-flex overall-body">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <!-- container-fluid -->

                    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                         rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                         rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

                    <!-- Officer dinamic cards here -->
                    <form action="#" method="post" id="officerForm">
                         <div class="row fs-4">
                              <div class="col-lg-3">
                                   <label class="fs-3">Visitor Cylinder Count</label>
                              </div>
                              <div class="col-lg-9">
                                   <div class="error-box w-100 d-block text-start">
                                        <p class="align-center ps-1 pe-1 d-inline fs-4">&nbsp;
                                             <span class="bg-danger text-light"></span>
                                        </p>
                                   </div>
                              </div>
                         </div>

                         <div id="officerForm" class="row">
                              <!-- input field -->
                              <div class="col-lg-5">
                                   <input type="text" name="addtoken" id="officerInput" oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="2" minlength="2" maxlength="2" class="form-control">
                                   <!-- addcard -->
                              </div>
                              <!-- change button -->
                              <div class="col-lg-7">
                                   <button type="submit" name="submit" id="submit" class="btn btn-primary fs-4">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>Add Visitor</span>
                                   </button>
                              </div>
                    </form>
               </div>
               <div class="container-fluid mt-4">
                    <div class="row">
                         <div class="col-md-4 me-2">
                              <div class="row">
                                   <div class="col-5">
                                        <a class="btn btn-danger form-control fs-4 mb-0">
                                             Sr_no :
                                             <span>
                                                  <?php echo $lastsrno ?>
                                             </span>
                                        </a>
                                   </div>
                                   <div class="col-5">
                                        <!-- <a class="btn btn-primary form-control fs-4" data-bs-toggle="model"
                                        data-bs-target="#mymodel">
                                        <span>Manage</span>
                                        <i class="fa-solid fa-gear"></i>
                                   </a> -->
                                        <button id="openmodelBtn" class="btn btn-primary form-control fs-4">
                                             <span>Manage</span>
                                             <i class="fa-solid fa-gear"></i>
                                        </button>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="row">
                                   <a href="searchGatePass.php" class="btn btn-primary form-control fs-4"
                                        height="50px">Search
                                        Gate Pass</a>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="row mt-4" id="cardContainer">
                    <?php while ($row1 = mysqli_fetch_assoc($res1)) {
                         $uniqueCardId = "card-" . $row1['token_no'];

                         ?>
                         <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
                              <div class="card text-center" id="<?php echo $uniqueCardId ?>">
                                   <div class="error-box w-100 d-block text-start">
                                        <p class="align-center mb-0 ps-1 pe-1 fs-4 text-center mb-0">
                                             &nbsp;
                                             <span class="bg-danger text-light">
                                                  <?php
                                                  $sqla = "SELECT id FROM maingate WHERE qr_code = '" . $row1['qr_code'] . "' AND status = '1' AND date = CURDATE()";
                                                  $resa = mysqli_query($connection, $sqla);


                                                  if (!$resa) {
                                                       // Query failed, print error message
                                                       echo "Query failed: " . mysqli_error($connection);
                                                  } else {
                                                       if (mysqli_num_rows($resa) > 0) {
                                                            echo "Already In Plant";
                                                            
                                                                 echo "<script>
                                                                 document.addEventListener('DOMContentLoaded', function() {
                                                                 var card = document.getElementById('$uniqueCardId');
                                                                 // card.style.backgroundColor = '#abbbd6'; // Change background color
                                                                 var button = card.querySelector('a.btn');
                                                                 button.classList.add('disabled'); // Add 'disabled' class
                                                                 button.onclick = function(event) {
                                                                      event.preventDefault(); // Prevent default action
                                                                      };
                                                                      });
                                                                      </script>";
                                                            
                                                            
                                                       } else {
                                                            echo "";
                                                       }
                                                  }
                                                  ?>
                                             </span>
                                        </p>
                                   </div>
                                   <div style="position: relative;">
                                        <p class="h4"
                                             style="color:white;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                                             <?php echo $row1['token_no']; ?>
                                        </p>
                                        <img src="<?php echo $images_dir . 'greencylinder.png'; ?>" class="card-img-top"
                                             alt="...">
                                   </div>
                                   <div class="card-body pt-0 p-3">
                                        <h6 style="height: 40px; overflow: hidden;" class="card-title fs-4">
                                             <?php echo $row1['full_name']; ?>
                                        </h6>
                                        <?php
                                        $name = $row1['full_name'];
                                        if ($name) { // If name exists in the database
                                             ?>
                                             <a href="editvisitor.php?token=<?php echo $row1['token_no'] ?>"
                                                  class="btn btn-primary form-control fs-4 "><i
                                                       class="fa-solid fa-edit"></i>Edit</a>
                                        <?php } else { // If name doesn't exist in the database ?>
                                             <a href="addvisitor.php?token=<?php echo $row1['token_no'] ?>"
                                                  class="btn btn-primary form-control fs-4 "><i
                                                       class="fa-solid fa-plus"></i>Add</a>
                                        <?php } ?>
                                   </div>
                                   <!-- <a href="editofficer.php" class="btn btn-primary form-control"><i class="fa-solid fa-plus"></i>Edit</a> -->
                              </div>
                         </div>
                    <?php } ?>

               </div>





          </div> <!-- container-fluid ends here -->
          <!-- End Page Content -->
     </div>
     </div>

     <!-- Start writing content here -->
     <main>

     </main>


     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Visitor";
          document.getElementById("navbar-title").innerHTML = "Visitor <i class='fa-solid fa-users'></i>";
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

     <!-- The model -->
     <div class="model" id="mymodel">
          <div class="model-content-1">
               <!-- model Header -->
               <div class="bg-primary pt-2 pb-2">
                    <div class="header-content">
                         <p class="model-title fs-3 ms-3 fw-bold" id="examplemodelLabel">Manage Sr No</p>
                    </div>

                    <button type="button" class="btn-close close" data-bs-dismiss="model" aria-label="Close"></button>
               </div>
               <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <!-- model Body -->
                    <div class="model-body mx-3">
                         <p class="text-secondary fs-3">Current Sr No: <span class="text-danger fs-3">
                                   <?php echo $lastsrno ?>
                              </span></p>
                         <hr>
                         <div class="mb-3">
                              <label for="sr_no" class="form-label">Set Sr No:</label>
                              <input type="text" class="form-control" id="sr_no" name="sr_no">
                         </div>
                    </div>
                    <!-- model Footer -->
                    <!-- <div class="model-footer">
                    <button type="button" class="btn btn-danger">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
               </div>
                -->
                    <div class="model-foter mx-3">
                         <button id="modelCloseBtn" class="model-button btn btn-secondary">Close</button>
                         <button type="submit" id="modelSaveBtn" class="model-button btn btn-primary"
                              name="change-sr-no">Save Changes</button>
                    </div>

               </form>
          </div>
     </div>

     <!-- <div id="mymodel" class="model">
          <div class="model-content-1">
               <span class="close">&times;</span>
               <h2>model Header</h2>
               <p>This is a simple model without Bootstrap.</p>
          </div>
     </div> -->


     <script>
          // Get the model
          var model = document.getElementById("mymodel");

          // Get the button that opens the model
          var btn = document.getElementById("openmodelBtn");

          // Get the <span> element that closes the model
          var span = document.getElementsByClassName("close")[0];

          // Get the close button inside the model
          var closemodelBtn = document.getElementById("modelCloseBtn");

          // When the user clicks the button, open the model 
          btn.onclick = function () {
               model.style.display = "block";
          }

          // When the user clicks on <span> (x), close the model
          span.onclick = function () {
               model.style.display = "none";
          }

          // When the user clicks the close button inside the model, close the model
          closemodelBtn.onclick = function () {
               model.style.display = "none";
          }

          // When the user clicks anywhere outside of the model, close it
          window.onclick = function (event) {
               if (event.target == model) {
                    model.style.display = "none";
               }
          }

          // Add functionality for the save button
          // var savemodelBtn = document.getElementById("modelSaveBtn");

          // savemodelBtn.onclick = function () {
          //      alert("Save button clicked!");
          //      // Add your save functionality here
          //      model.style.display = "none";
          // }

     </script>

          <!-- input field for add token -->
          <script>
          document.getElementById('officerForm').addEventListener('submit', function (e) {
               var inputField = document.getElementById('officerInput');
               if (!inputField.value.trim()) { // Check if the input field is empty
                    e.preventDefault(); // Prevent the form from submitting
                    //  alert('Please enter a value before submitting.'); // Show an alert message
               }
          });
     </script>
</body>

</html>