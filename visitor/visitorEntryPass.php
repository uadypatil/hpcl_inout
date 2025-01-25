<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- name: Shubham Shinde || date: 22-05-2024  Backend-->
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

<!-- php code here -->
<?php
date_default_timezone_set('Asia/Kolkata'); // Set the time zone to Indian Standard Time


$token = $_GET['token'];
$sql = "SELECT * FROM `visitor` WHERE `token_no` = '$token'";
// $sql = "SELECT `id`, `token_no`, `aadhar_no`, `full_name`, `mobile_no`, `address`, `to_see_whom`, `purpose_to_visit`, `is_regular`, `date`, `working_as`, `qr_code`, `qrpath` FROM `visitor` WHERE `token_no` = '$token'";
$res = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($res);
$aadhar = $row['aadhar_no'];
if ($res) {
     // while ($row = mysqli_fetch_assoc($res)) {

     ?>
     <!-- php code ends here -->

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

                         <div class="content border p-3 mb-3" id="content">
                              <header>

                                   <table class="table table-responsive">
                                        <tr>
                                             <td style="width: 100px;">
                                                  <img src="<?php echo $row['photo']; ?>" alt="" class="image-fluid"
                                                       height="120" width="120">
                                             </td>
                                             <td>
                                                  <p class="fs-2 text-center fw-bold">Hindustan Pertoleum
                                                       Corporation
                                                       Limited Sinnar
                                                       LPG Bottling Plant, G-8, M.I.D.C.,
                                                       Malegaon, Sinnar, Nashik - 422113</p>
                                                  <p class="text-uppercase text-center fs-1 fw-bolder">Visitor Slip</p>
                                             </td>
                                             <td style="width: 100px;">
                                                  <img src="<?php echo $row['qrpath']; ?>" alt="" class="image-fluid"
                                                       height="120" width="120">
                                             </td>
                                        </tr>
                                   </table>

                              </header>
                              <main>
                                   <div>
                                        <table
                                             class="table table-responsive table-bordered border-dark border-3 fs-4 text-black fw-bolder">
                                             <tbody>
                                                  <!-- first table row -->
                                                  <tr>
                                                       <td colspan="2">SrNo: <span class="text-danger" id="srNo">Auto
                                                                 Generated Sr
                                                                 No</span></td>
                                                       <td>Time In:<span id="intime">
                                                                 <?php echo date('H:i:s'); ?>
                                                            </span></td>
                                                  </tr>

                                                  <!-- second table row -->
                                                  <tr>
                                                       <td>Date: <span>
                                                                 <?php echo date("d-m-Y"); ?>
                                                            </span></td>
                                                       <td>Token No: <span>
                                                                 <?php echo $token; ?>
                                                            </span></td>
                                                       <td>Time Out: <span></span></td>
                                                  </tr>

                                                  <!-- third table row -->
                                                  <tr>
                                                       <td colspan="2">Aadhar Number Of Visitor: <span>
                                                                 <?php echo $row['aadhar_no'] ?>
                                                            </span>
                                                       </td>
                                                       <td>Mobile Number: <span>
                                                                 <?php echo $row['mobile_no']; ?>
                                                            </span></td>
                                                  </tr>

                                                  <!-- forth table row -->
                                                  <tr>
                                                       <td colspan="3">Name Of The Visitor:
                                                            <span class="text-uppercase">
                                                                 <?php echo $row['full_name']; ?>
                                                            </span>
                                                       </td>
                                                  </tr>

                                                  <!-- fifth table row -->
                                                  <tr>
                                                       <td colspan="3">Company / Resclassential Address: <span
                                                                 class="text-uppercase">
                                                                 <?php echo $row['address']; ?>
                                                            </span></td>
                                                  </tr>

                                                  <!-- sixth table row -->
                                                  <tr>
                                                       <td colspan="2">To See Whom: <span class="text-uppercase">
                                                                 <?php echo $row['to_see_whom']; ?>
                                                            </span></td>
                                                       <td>Purpose: <span class="text-uppercase">
                                                                 <?php echo $row['purpose_to_visit']; ?>
                                                            </span></td>
                                                  </tr>

                                                  <!-- seventh table row -->
                                                  <tr>
                                                       <td colspan="3">Description Of Material If Carried: <span
                                                                 class="text-uppercase"></span></td>
                                                  </tr>

                                                  <!-- eigth table row -->
                                                  <!-- <tr rowspan="2">

                                                  </tr> -->

                                                  <tr style="height: 80px;">
                                                       <td class="align-bottom"><span>Signature Of Visitor</span></td>
                                                       <td class="align-bottom"><span>Signature Of Security</span></td>
                                                  </tr>

                                                  <!-- nineth table row -->
                                                  <tr>
                                                       <td colspan="3">
                                                            <p class="text-uppercase text-center">for entry in Licensed area
                                                            </p>
                                                       </td>
                                                  </tr>

                                                  <!-- tenth table row -->
                                                  <tr>
                                                       <td colspan="2">Permitted To Go To:</td>
                                                       <td>Authorised By:  </td>
                                                  </tr>

                                                  <!-- eleventh table row -->
                                                  <tr>
                                                       <td colspan="3">
                                                            <ol>
                                                                 <li>
                                                                      <p>Visitors are requested not to carry matchboxes, lighters, cameras, torches, or any other flammable articles inside the main gate. If any, the same may be deposited with the security.
                                                                      </p>
                                                                 </li>
                                                                 <li>
                                                                      <p>Please park your vehicles outside only at your own risk. The company is not responsible.</p>
                                                                 </li>
                                                            </ol>
                                                       </td>
                                                  </tr>

                                                  <!-- 12th table row -->
                                                  <tr style="height: 80px;">
                                                       <td class="align-bottom"><span>Signature Of Person met</span></td>
                                                       <td><span></span></td>
                                                       <td class="align-bottom"><span>Relieving Time</span></td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                              </main>

                         </div>
                         <footer>
                              <div class="d-flex m-auto justify-content-center">
                                   <button class="btn btn-success me-1" onclick="printContent()">PRINT</button>

                                   <button class="btn btn-primary ms-1" onclick="window.history.back()">BACK</button>
                              </div>
                         </footer>

                    </div> <!-- container-fluid ends here -->
                    <!-- End Page Content -->
               </div>
          </div>

          <!-- Start writing content here -->
          <main>

          </main>
          <?php
          // Perform database query to get the last SR number from the visitor table
          $sql5 = "SELECT MAX(srno) AS last_srno FROM srno";
          $result5 = mysqli_query($connection, $sql5);

          // Check if the query was successful
          if ($result5) {
               // Fetch the result row
               $row = mysqli_fetch_assoc($result5);

               // Get the last SR number from the result
               $lastSrNo = $row['last_srno'];

               // Print the last SR number (for testing purposes)
               echo "Last SR No: " . $lastSrNo;
          } else {
               // Print an error message if the query fails
               echo "Error: " . mysqli_error($connection);
          }
          ?>

<!-- printing code -->
          <script>

               function printContent() {
                    // Get the new SrNo value
                    var newSrNo = "<?php echo $lastSrNo + 1 ?>"; // Assuming $lastSrNo and $aadhar are defined

                    // Updating the SrNo element
                    document.getElementById('srNo').innerText = newSrNo;

                    // Get the token value
                    const token = '<?php echo $token ?>'; // Assuming $token is defined

                    // Construct the URL with token and newSrNo
                    var url = `insertupdate.php?token=${encodeURIComponent(token)}&srno=${encodeURIComponent(newSrNo)}`;

                    // Fetch data from the server
                    fetch(url)
                         .then(response => {
                              if (!response.ok) {
                                   throw new Error('Network response was not ok');
                              }
                              return response.json();
                         })
                         .then(data => {
                              console.log(data);
                              // Handle the response data here
                              if (data.success) {
                                   console.log('Data sent successfully');
                                   // Do something with the data
                              } else {
                                   console.log('Failed to send data');
                                   // Handle failure scenario
                              }
                         })
                         .catch(error => {
                              console.error('There was a problem with the fetch operation:', error);
                         });

                    // Save the current content and then print
                    var visitorContent = document.getElementById("content").innerHTML;
                    var originalDocument = document.body.innerHTML;

                    // Set the document content to the visitor's content and then print
                    document.body.innerHTML = visitorContent;
                    window.print();

                    // Restore the original content
                    document.body.innerHTML = originalDocument;
               }
          </script>




          <!-- giving title to document and navbar -->
          <script>
               document.getElementById('page-title').innerHTML = "HPCL INOUT | Visitor Gate Pass";
               document.getElementById('navbar-title').innerHTML = "Visitor Gate Pass <i class='fa-solid fa-ticket'></i>";
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
     // }
}
?>

</html>