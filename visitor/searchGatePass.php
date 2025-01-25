
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

                    <div class="card" id="card">
                         
                         <div class="card-body p-4">
                         <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                         <div class="row">
                                   <h3 class="card-title">Search By Sr No</h3>
                                   <hr>
                                        <div class="row mb-2">
                                             <div class="col-md-6">
                                                  <label for="inputsrno" class="form-label">Enter Sr No.</label>
                                                  <input type="text" class="form-control" placeholder="Enter Sr No" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="inputsrno" id="inputsrno">
                                             </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-1">
                                            <button class="btn btn-primary" onclick="searchGatePass()"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                            </div>&nbsp;&nbsp;&nbsp;
                                            <div class="col-sm-1">
                                            <button class="btn btn-secondary" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
                                            </div>
                                            
                                        </div>
                                        <span id="nodata" style="color:red;"></span>
                                             
                                   
                              
                         </div>
                    </div>
               </div>
               </div>
               <div class="content border p-3 mb-3" id="content" style="display: none;">
                                   <header>

                                        <table class="table table-responsive">
                                             <tr>
                                                  <td style="width: 100px;">
                                                       <img src="" alt="" class="image-fluid" id="photo" height="120"
                                                            width="120">
                                                  </td>
                                                  <td>
                                                       <p class="fs-2 text-center fw-bold text-secondary">Hindustan Pertoleum Corporation
                                                            Limited Sinnar
                                                            LPG Bottling Plant, G-8, M.I.D.C.,
                                                            Malegaon, Sinnar, Nashik - 422113</p>
                                                       <p class="text-uppercase text-center fs-1 fw-bolder">Visitor Slip</p>
                                                  </td>
                                                  <td style="width: 100px;">
                                                       <img src="" alt="" class="image-fluid" id="qr_code" height="120"
                                                            width="120">
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
                                                            <td colspan="2">SrNo: <span class="text-danger" id="srNo"></span></td>
                                                            <td>Time In:<span id="time_in"></span></td>
                                                       </tr>

                                                       <!-- second table row -->
                                                       <tr>
                                                            <td>Date: <span id="date"></span></td>
                                                            <td>Token No: <span id="token"></span></td>
                                                            <td>Time Out: <span id="time_out"></span></td>
                                                       </tr>

                                                       <!-- third table row -->
                                                       <tr>
                                                            <td colspan="2">Aadhar Number Of Visitor: <span id="aadhar_no"></span>
                                                            </td>
                                                            <td>Mobile Number: <span id="mobile_no"></span></td>
                                                       </tr>

                                                       <!-- forth table row -->
                                                       <tr> 
                                                            <td colspan="3">Name Of the Visitor: 
                                                                 <span class="text-uppercase" id="full_name">
                                                                 </span>
                                                                 </td>
                                                       </tr>

                                                       <!-- fifth table row -->
                                                       <tr>
                                                            <td colspan="3">Company / Resclassential Address: <span
                                                                      class="text-uppercase" id="address"></span></td>
                                                       </tr>

                                                       <!-- sixth table row -->
                                                       <tr>
                                                            <td colspan="2">To See Whom: <span
                                                                      class="text-uppercase" id="to_see_whom"></span></td>
                                                            <td>Purpose: <span class="text-uppercase" id="purpose"></span></td>
                                                       </tr>

                                                       <!-- seventh table row -->
                                                       <tr>
                                                            <td colspan="3">Description Of Material If Carried: <span
                                                                      class="text-uppercase"></span></td>
                                                       </tr>

                                                       <!-- eigth table row -->
                                                       <tr rowspan="2">

                                                       </tr>

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
                                                            <td colspan="2">Permitted to go to</td>
                                                            <td>Authorized by</td>
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
                                                            <td class="align-bottom"><span>Signature Of Person Met</span></td>
                                                            <td><span></span></td>
                                                            <td class="align-bottom"><span>Relieving Time</span></td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </main>
                                   
                                  
                              </div>
                              <footer id="footer" style="display: none;">
                                        <div class="d-flex m-auto justify-content-center">
                                             <button class="btn btn-success me-1" onclick="printContent()">PRINT</button>

                                             <button class="btn btn-primary ms-1" onclick="window.history.back()">BACK</button>
                                        </div>
                                   </footer>

               </div>
               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>

     <!-- Start writing content here -->
     <main>

     </main>



     <script>
   function searchGatePass() {
    var srno = document.getElementById('inputsrno').value.trim();
    if (srno.trim() === '') {
        alert("Enter the Sr No");
        return;
    }

    // Make a fetch request to check if visitor details are available
    fetch('search_visitor.php?srno='+srno)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if(data.message=="data found"){
        //var visitor = data.visitor;
        console.log(true);
        document.getElementById('content').style.display = "block";
        document.getElementById('footer').style.display = "block";
        document.getElementById('card').style.display = "none";

        document.getElementById('srNo').innerHTML = data.srno;
        document.getElementById('time_in').innerHTML = data.time_in;
        document.getElementById('time_out').innerHTML = data.time_out ;
        document.getElementById('date').innerHTML = data.date ;
        document.getElementById('token').innerHTML = data.token_no ;
        document.getElementById('aadhar_no').innerHTML = data.aadhar_no ;
        document.getElementById('mobile_no').innerHTML = data.mobile_no ;
        document.getElementById('full_name').innerHTML = data.full_name ;
        document.getElementById('address').innerHTML = data.address ;
        document.getElementById('to_see_whom').innerHTML = data.to_see_whom ;
        document.getElementById('purpose').innerHTML = data.purpose_to_visit ;
        document.getElementById('photo').src =data.photo;
        document.getElementById('qr_code').src =data.qrpath;




        

        // Add more details as needed
    } else {
        document.getElementById('nodata').textContent = "No data found";
    }
})
    .catch(error => {
        console.error('There was an error with the fetch request:', error);
        document.getElementById('result').textContent = "An error occurred while processing your request.";
    });
}


     </script>
     <script>
                        function printContent() {

          

                            var visitorContent = document.getElementById("content").innerHTML;
                            var originalDocument = document.body.innerHTML;

                            document.body.innerHTML = visitorContent;

                            window.print();
                            document.body.innerHTML = originalDocument;
                        }
                        </script>
     <script>
     <!-- giving title to document and navbar -->
     document.getElementById('page-title').innerHTML = "HPCAL INOUT | Search Gate Pass";
     document.getElementById('navbar-title').innerHTML = "Search Gate Pass <i class='fa-solid fa-ticket'></i>";
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

