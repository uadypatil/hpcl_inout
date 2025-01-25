<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php"); ?>
<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <link rel="icon" href="../../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
     <!-- including external links -->
     <?php include($external_links_loc); ?>
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

     <!-- including config file to use database -->
     <?php include($config_loc); ?>
  
</head>
<!-- php connectivity code here -->
<?php
if (isset($_GET['token'])) {
     $token = $_GET['token'];
     $name = "";
     $mobile_no = "";
     $address = "";
     $working_as = "";
     $filename = "";
     $qr_code = "";
     $sql_icard = "SELECT `full_name`, `mobile_no`, `address`,`working_as` ,`qr_code`, `qr_path` FROM `amc` WHERE `token_no` = '$token'";
     $res_icard = mysqli_query($connection, $sql_icard);

     if ($res_icard) {
          while ($row = mysqli_fetch_assoc($res_icard)) {
               $name = $row['full_name'];
               $mobile_no = $row['mobile_no'];
               $address = $row['address'];
               $working_as = $row['working_as'];
               $qr_code = $row['qr_code'];
               $filename = $row['qr_path'];
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
                         <div class="container-fluid mb-5">
                              <!-- container-fluid -->
                              <!-- Icard code here -->
                              <div class="content">
                                   <header class="mb-2">
                                        <div class="row">
                                             <!-- logo div -->
                                             <div class="col-lg-1">
                                                  <img src="https://manasvi.tech/demo/assest/img/logos/hp.png" alt="hpcl logo"
                                                       class="img-fluid" height="80" width="50">
                                             </div>
                                             <!-- header text div -->
                                             <div class="col-lg-11 text-body-tertiary text-center">
                                                  <p class="fw-medium fs-3"><span>Hindustan Petrolium Corporation
                                                            Limited</span><br>
                                                       <span>Sinner LPG Bottling plant, G-6, M.I.D.C, Malegaon, Sinner, Nashik-
                                                            422113</span>
                                                  </p>
                                             </div>
                                        </div>

                                        
                                   </header>
                                   <main>
                                        <div class="qr-text-div row text-center mb-4" style="background-color: red;">
                                             <p class="fs-1 fw-bold text-light text-uppercase"><span id="qr-text">
                                                       <?php echo "opr-".$qr_code; ?>
                                                  </span></p> <!-- OPR-GAT/HPNSK/2 -->
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-8">
                                                  <ul class="fs-3 fw-bold text-start text-body-tertiary"
                                                       style="list-style-type: none;">
                                                       <li><span>Name: </span><span>
                                                                 <?php echo $name; ?>
                                                            </span></li>
                                                       <li><span>Phone: </span><span>
                                                                 <?php echo $mobile_no; ?>
                                                            </span></li>
                                                       <li><span>Address: </span><span>
                                                                 <?php echo $address; ?>
                                                            </span></li>
                                                       <li><span>Working as : </span><span>
                                                                 <?php echo $working_as; ?>
                                                            </span></li>
                                                  </ul>
                                             </div>
                                             <div class="col-lg-4">
                                                  <img src="<?php echo $filename; ?>" alt="qr_code"
                                                       height="200" width="200">
                                                  <!-- qr_code image -->
                                             </div>
                                        </div>
                                        <div class="row fs-1 fw-medium text-dark"> 
                                             <div class="col-lg-4">
                                                  <p class="text-center">Sign and seal of <br> Contractor</p>
                                             </div>
                                             <div class="col-lg-4">
                                                  <p class="text-center">Sign./ Thumb <br> impression of the <br> pass holder</p>
                                             </div>
                                             <div class="col-lg-4">
                                                  <p class="text-center">Attestation of HPCL <br> plant In charge</p>
                                             </div>
                                        </div>

                                        <div class="qr-text-div row text-center mb-4" style="background-color: red;">
                                             <p class="fs-1 fw-bold text-light"><span id="qr-text">
                                                       <?php echo $working_as; ?>
                                                  </span></p>
                                        </div>
                                   </main>
                              </div>
                              <footer>
                                   <div class="row">
                                        <div class="col-lg-1">
                                             <button class="btn btn-success" name="submit">
                                                  <i class="fa-solid fa-print"></i>
                                                  <span>Print</span></button>
                                        </div>
                                        <div class="col-lg-1">
                                             <button class="btn btn-danger" onclick="history.back(); return false;" name="back"><i
                                                       class="fa-solid fa-arrow-left"></i>
                                                  Back</button>
                                        </div>
                                   </div>
                              </footer>
                         </div> <!-- container-fluid ends here -->
                         <!-- End Page Content -->
                    </div>
               </div>

               <!-- Start writing content here -->
               <main>

               </main>



               <!-- giving title to document and navbar -->
               <script>
                    document.getElementById('page-title').innerHTML = "edit amc";
                    document.getElementById("navbar-title").innerHTML = "Amc Form";               
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
          <?php
     }

}
?>

</html>