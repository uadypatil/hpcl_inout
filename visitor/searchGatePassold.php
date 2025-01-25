<!-- name: Shubham Shinde|| date: 15-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php 
include("../root.php"); 

include($config_loc);

// Fetch current number of officers
// $sql1 = "SELECT * FROM `visitor`";
// $res1 = mysqli_query($connection, $sql1);
// $token_no = mysqli_num_rows($res1);

// if (isset($_POST['submit'])) {
//     // Process form submission
//     $token = $_POST['addtoken'];
//     $total = $token + $token_no;

//     for ($x = $token_no + 1; $x <= $total; $x++) {
//         $sql2 = "INSERT INTO `visitor`(`token_no`) VALUES ('$x')";
//         $res2 = mysqli_query($connection, $sql2);
//     }
//     header("Location: ".$_SERVER['PHP_SELF']);
//     exit;
// }
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
</head>

<body>


     <div class="wrapper d-flex overall-body">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid ">
                    <!-- container-fluid -->
                    <div class="card">
                         
                         <div class="card-body p-4">
                         <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                         <div class="row">
                                   <h1 class="card-title">Search By Sr No</h1>
                                   <hr>
                                   <form action="#">
                                        <div class="row mb-2">
                                             <div class="col-md-6">
                                                  <label for="sr_no" class="form-label">Enter Sr No.</label>
                                                  <input type="text" name="sr_no" class="form-control" placeholder="Enter Sr No">
                                             </div>
                                        </div>
                                             <button class="btn btn-primary" name="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                             <button class="btn btn-secondary" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
                                   
                              </form>                           
                              
                         </div>
                    </div>
               </div>
               </div>
                




               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>

     <main>

     </main>

          <!-- Start writing content here -->

     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Search Gate Pass";
          document.getElementById("navbar-title").innerHTML = "Search Gate Pass <i class='fa-solid fa-ticket'></i>";
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
</body>

</html>