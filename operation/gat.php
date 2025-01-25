<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php"); 
if (!isset($_SESSION['username'])) {
     header("Location: ../login.php");
     exit();
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

<!-- including config file to use database -->
<?php include($config_loc); ?>
<?php
// Fetch current number of officers
$sql1 = "SELECT * FROM gat";
$res1 = mysqli_query($connection, $sql1);
$token_no = mysqli_num_rows($res1); 

if (isset($_POST['submit'])) {
     // Process form submission
     $token = $_POST['addtoken'];
     $total = $token + $token_no;

     for ($x = $token_no + 1; $x <= $total; $x++) {
          $sql2 = "INSERT INTO gat(token_no) VALUES ('$x')";
          $res2 = mysqli_query($connection, $sql2);
     }
     header("Location: " . $_SERVER['PHP_SELF']);
     exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <link rel="icon" href="https://manasvi.tech/demo/assest/img/logos/hp.png" type="image/gif" sizes="16x16">
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
                    <!-- container-fluid -->


                    <!-- Page Content -->
                    <div class="container-fluid">
                         <!-- container-fluid -->

                         <!-- counter div code starts here -->
                         <div class="counter-div">

                              <form action="<?php // htmlspecialchars($_Server['PHP_SELF']); ?>" id="gatForm" method="post">
                                   <div class="row">
                                        <div class="col-lg-5">
                                             <label for="" class="fs-3">GAT Cylinder Count</label>       
                                        </div>
                                        <div class="col-lg-7">
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
                                             <input type="text" name="addtoken" id="gatInput" oninput="this.value=this.value.replace(/[^0-9]/g,'')" size="2" minlength="2"
                                             maxlength="2" class="form-control">
                                             <!-- addcard -->
                                        </div>
                                        <!-- change button -->
                                        <div class="col-lg-7">
                                             <button type="submit" name="submit" id="submit" class="btn btn-primary">
                                             <i class="fa-solid fa-plus"></i>
                                                  <span>Add GAT</span>
                                             </button>
                                        </div>
                                   </div>
                              </form>
                         </div><!-- counter div code starts here -->

                         <!-- cylinder div starts here -->
                         <div class="cylender-div">
                              <!-- cylinder div starts here -->
                              <div class="cylender-div">
                                   <div class="row mt-4" id="cardContainer">

                                        <?php while ($row1 = mysqli_fetch_assoc($res1)) {
                                             $uniqueCardId = "card-" . $row1['token_no'];


                                             ?>
                                             <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-5">
                                                  <div class="card text-center" id="<?php echo $uniqueCardId ?>">
                                                       <div class="error-box w-100 d-block text-start">
                                                            <p class="align-center mb-0 ps-1 pe-1 fs-5 text-center">
                                                                 &nbsp;
                                                                 <span class="bg-danger text-light">
                                                                      <?php
                                                                      // $sqla = "SELECT `id` FROM `maingate` WHERE `qr_code` = '" . $row1['qr_code'] . "' AND `status` = '2'";
                                                                      $sqla = "SELECT `id` FROM `maingate` WHERE `qr_code` = '" . $row1['qr_code'] . "' AND `status` = '1' AND `date` = CURDATE()";
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
                                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQrAfNAjMWDejP0YqvXWZLsIBWWwKn0IJv1AgXVEa7bw&s"
                                                                 class="card-img-top" alt="...">
                                                       </div>
                                                       <div class="card-body">
                                                            <h5 class="card-title" style="height: 30px; overflow: hidden;">
                                                                 <?php echo $row1['full_name']; ?>
                                                            </h5>
                                                            <?php
                                                            $name = $row1['full_name'];
                                                            if ($name) { // If name exists in the database
                                                                 ?>
                                                                 <a href="editgat.php?token=<?php echo $row1['token_no'] ?>"
                                                                      class="btn btn-primary form-control">
                                                                      <i class="fa-solid fa-edit"></i>Edit</a>
                                                            <?php } else { // If name doesn't exist in the database ?>
                                                                 <a href="addgat.php?token=<?php echo $row1['token_no'] ?>"
                                                                      class="btn btn-primary form-control">
                                                                      <i class="fa-solid fa-plus"></i>Add</a>
                                                            <?php } ?>
                                                       </div>
                                                       <!-- <a href="editofficer.php" class="btn btn-primary form-control"><i class="fa-solid fa-plus"></i>Edit</a> -->
                                                  </div>
                                             </div>
                                        <?php } ?>

                                   </div>
                              </div><!-- cylinder div starts here -->
                         </div><!-- cylinder div starts here -->



                    </div><!-- cylinder div starts here -->


               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>

     <!-- Start writing content here -->
     <main>

     </main>

     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | GAT";
          document.getElementById('navbar-title').innerHTML = "GAT <i class='fa-solid fa-users'></i>";
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

                  <!-- input field for add token -->
     <script>
        document.getElementById('gatForm').addEventListener('submit', function (e) {
            var inputField = document.getElementById('gatInput');
            if (!inputField.value.trim()) { // Check if the input field is empty
                e.preventDefault(); // Prevent the form from submitting
               //  alert('Please enter a value before submitting.'); // Show an alert message
            }
        });
    </script>
</body>

</html>