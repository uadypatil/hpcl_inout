<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("root.php"); ?>
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

<body>
<script>
        window.addEventListener('pageshow', function(event) {
            var historyTraversal = event.persisted || 
                                   (typeof window.performance != 'undefined' && 
                                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Page is loaded from the cache, reload it
                location.reload();
            }
        });
    </script>




     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <!-- container-fluid -->

                    <!-- content here -->
                    <div class="content">
                         <!-- buttons div for sorting -->
                         <div class="d-flex border-bottom border-secondary">

                              <?php include "dashsortbtns.php"; ?>    
                         </div>
                         <div class="table-div">
                              <!-- data table starts here -->
                              <table class="table table-responsive fs-3 fw-normal table-striped" id="mytable">
                                   <thead>
                                        <tr>
                                             <th class="col-lg-4">Name</th>
                                             <th>Department</th>
                                             <th>Sub Department</th>
                                             <th>Time In</th>
                                             <th>Restrict</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        if ($res) {
                                             while ($row = mysqli_fetch_assoc($res)) {
                                                  // Finding the position of the dash
                                                  $dash_position = strpos($row['working_as'], '-');

                                                  // Extracting the substrings
                                                  $depart = trim(substr($row['working_as'], 0, $dash_position));
                                                  $subdepart = trim(substr($row['working_as'], $dash_position + 1));
                                                  ?>
                                                  <tr>
                                                       <td>
                                                            <?php echo $row['full_name'] ?>
                                                       </td>
                                                       <td>
                                                            <?php echo $depart; ?>
                                                       </td>
                                                       <td>
                                                            <?php echo $subdepart; ?>
                                                       </td>
                                                       <td>
                                                            <?php echo $row['intime'] ?>
                                                       </td>
                                                       <td>
                                                        <?php
                                                        $qr_code=$row['qr_code'];
                                                         ?>
                                                        <form action="restricted.php?dept=<?php echo $subdepart ?>&qr=<?php echo $qr_code ?>" method="post">


                                        
                                                        <?php
                                                        $restrictedsql="SELECT * FROM `$subdepart` WHERE `qr_code`='$qr_code'";
                                                        $rest_result=mysqli_query($connection, $restrictedsql);
                                                        $rest_row=mysqli_fetch_assoc($rest_result);
                                                        $restricted_status= $rest_row['restricted'];
                                                        


                                                        if($restricted_status == '0'){ ?>
                                                            <button class="btn btn-danger" name="restricted" value="1"><span>Restrict</span></button>
                                                        <?php } elseif ($restricted_status == '1'){ ?>
                                                            <button class="btn btn-secondary" name="restricted" value="0"><span>Unrestrict</span></button>
                                                        <?php } ?>
                                                        </form>
                                                       </td>
                                                  </tr>
                                                  <?php
                                             }
                                        }else{
                                             echo mysqli_error($connection);
                                        }
                                        ?>

                                   </tbody>
                              </table>
                         </div>
                    </div>
                    <div class="back-button">
                         <button class="btn btn-primary fs-4 fw-normal" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Go
                              Back</button>
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
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Dashboard";
          document.getElementById('navbar-title').innerHTML = "Infomore <i class='fas fa-info-circle'></i>";// <i class='fas fa-info'></i>
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
  <script>
   function searchfun(filter) {
    filter = filter.toUpperCase(); // Convert filter value to uppercase
    let mytab = document.getElementById('mytable');
    let tr = mytab.getElementsByTagName('tr');

    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[2]; // Targeting the third column (index 2)

        if (td) {
            let textvalue = td.textContent || td.innerHTML;

            // Convert text value to uppercase for comparison
            let textUpper = textvalue.toUpperCase();

            // Check if the filter is 'ALL' or matches in uppercase or lowercase
            if (filter === 'ALL' || textUpper.includes(filter)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

</script>


</body>

</html>



<!-- SELECT 
     `contractor`.`full_name`,
     `contractor`.`working_as`,

     `contractor_workman`.`full_name`,
     `contractor_workman`.`working_as`,
     
     `officer`.`full_name`,
     `officer`.`working_as`,
     
     `employee`.`full_name`,
     `employee`.`working_as`,
     
     `gat`.`full_name`,
     `gat`.`working_as`,
     
     `tat`.`full_name`,
     `tat`.`working_as`,
     
     `feg`.`full_name`,
     `feg`.`working_as`,
     
     `sec`.`full_name`,
     `sec`.`working_as`,
     
     `maingate`.`intime`
FROM `contractor`,
     `contractor_workman`,
     `officer`,
     `employee`,
     `gat`,
     `tat`,
     `feg`,
     `sec`
     INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code`,
     `contractor_workman`.`qr_code` = `maingate`.`qr_code`,
     `officer`.`qr_code` = `maingate`.`qr_code`,
     `employee`.`qr_code` = `maingate`.`qr_code`,
     `gat`.`qr_code` = `maingate`.`qr_code`,
     `tat`.`qr_code` = `maingate`.`qr_code`,
     `feg`.`qr_code` = `maingate`.`qr_code`,
     `sec`.`qr_code` = `maingate`.`qr_code` -->