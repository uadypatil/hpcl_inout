<?php include "../root.php"; ?>
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

     <?php

     $fromdate = "";
     $todate = "";
     $dept = "";
     $sub_dept = "";
     $gate = "";

     if (isset($_POST['generate'])) {
          $fromdate = $_POST['fromdate'];
          $todate = $_POST['todate'];
          $dept = $_POST['dept'];
          $sub_dept = $_POST['sub_dept'];
          $gate = $_POST['gate'];
          $s_by_name = $_POST['s_by_name'];

          $sql = "INSERT INTO `report`(`report_gen_dt`, `from_date`, `to_date`, `department`, `sub_department`, `name`, `gate`) 
          VALUES (CURDATE(), '$fromdate', '$todate', '$dept', '$sub_dept', '$s_by_name', '$gate')";
          $res = mysqli_query($connection, $sql);
          if ($res) {
               $query = "SELECT `report_id` FROM `report` ORDER BY `report_id` DESC LIMIT 1";
               $result = mysqli_query($connection, $query);

               if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['report_id'];
                    $a = "?id=$id&dept=$dept&sub_dept=$sub_dept&gate=$gate&fd=$fromdate&td=$todate&nm=$s_by_name";
                    header("Location: " . $a);
               } else {
                    echo "No results found";
               }

          }
     }

     ?>

     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <!-- container-fluid -->
                    <div class="backbtndiv">
                         <button onclick="window.history.back()" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    </div>
                    <div class="table-content table-responsive">
                         <table class="table">
                              <thead>
                                   <tr>
                                        <?php $count = 1; ?>
                                        <th>sr no</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Sub department</th>
                                        <th>Check in date</th>
                                        <th>Check in time</th>
                                        <th>Check out time</th>
                                        <th>Check out date</th>
                                        <th>Gate</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   $repo_id = $_GET['id'];
                                   $selectquery = "SELECT `data_id`, `report_id`, `name`, `department`, `sub_department`, `time_in`, `time_out`, `check_in_dt`, `check_out_dt`, `gate_name` FROM `report_data` WHERE `report_id` = '$repo_id'";
                                   $result = mysqli_query($connection, $selectquery);
                                   if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                             ?>
                                             <tr>
                                                  <!-- report id -->
                                                  <td>
                                                       <?php echo $count; ?>
                                                  </td>

                                                  <!-- report from date -->
                                                  <td>
                                                       <?php echo $row['name'] ?>
                                                  </td>

                                                  <!-- report to date -->
                                                  <td>
                                                       <?php echo $row['department'] ?>
                                                  </td>

                                                  <!-- department -->
                                                  <td>
                                                       <?php echo $row['sub_department'] ?>
                                                  </td>

                                                  <!-- sub department -->
                                                  <td>
                                                       <?php echo $row['check_in_dt'] ?>
                                                  </td>

                                                  <!-- name -->
                                                  <td>
                                                       <?php echo $row['time_in'] ?>
                                                  </td>

                                                  <!-- Gate name -->
                                                  <td>
                                                       <?php echo $row['time_out'] ?>
                                                  </td>
                                                  
                                                  <!-- Report generation date -->
                                                  <td>
                                                       <?php echo $row['check_out_dt'] ?>
                                                  </td>

                                                  <!-- View button -->
                                                  <td>
                                                       <?php echo $row['gate_name']; ?>
                                                  </td>
                                             </tr>
                                             <?php
                                             $count++;
                                        }
                                   }

                                   ?>
                              </tbody>

                         </table>
                    </div>


               </div><!-- container fluid -->
          </div>

          <!-- Start writing content here -->
          <main>

          </main>


          <!-- javascript p function -->
          <script>
               function p(s1, s2) {

                    var s1 = document.getElementById(s1);
                    var s2 = document.getElementById(s2);
                    // console.log(s1.value);
                    s2.innerHTML = "";
                    if (s1.value == "operation") {
                         var optionArray = ['all|all', 'officer|officer', 'employee|employee', 'contractor|contractor', 'contractor workman|contractor workman', 'gat|gat', 'tat|tat', 'sec|sec', 'feg|feg'];
                         // console.log(s1.value+"Operation");


                    }
                    else if (s1.value == "driver") {
                         var optionArray = ['all|all', 'packed|packed', 'bulk|bulk', 'transporter|transporter'];
                         // console.log(s1.value+"Driver");

                    }
                    else if (s1.value == "project") {
                         var optionArray = ['all|all', 'workman|workman', 'amc|amc'];
                         // console.log(s1.value+"Project");

                    }
                    else if (s1.value == "visitor") {
                         var optionArray = ['all|all', 'visitor|visitor'];
                         // console.log(s1.value+"Visitor");

                    }
                    else {
                         var optionArray = ['all|all',];
                         // console.log(s1.value+"All");
                    }

                    for (var option in optionArray) {
                         var pair = optionArray[option].split("|");
                         var newoption = document.createElement("option");
                         newoption.value = pair[0];
                         newoption.innerHTML = pair[1];
                         s2.options.add(newoption);
                    }
               }
          </script>
          <!-- javascript p function ends here -->

          <!-- javascript print content function -->
          <script>
               function printContent() {

                    var visitorContent = document.getElementById("content").innerHTML;
                    var originalDocument = document.body.innerHTML;

                    document.body.innerHTML = visitorContent;

                    window.print();
                    document.body.innerHTML = originalDocument;
               }
          </script>
          <!-- javascript print content function ends here -->

          <!-- javascript show function -->
          <script>
               function show() {
                    let f = document.getElementById('fromdate').value;
                    let t = document.getElementById('todate').value;
                    let d = document.getElementById('dept').value;
                    let s = document.getElementById('sub_dept').value;

                    document.getElementById('fromdate1').innerText = f;
                    document.getElementById('todate1').innerText = t;
                    document.getElementById('dept1').innerText = d;
                    document.getElementById('sub_dept1').innerText = s;

                    // console.log(f);
                    // console.log(t);

                    // console.log(d);

                    // console.log(s);

               }
          </script>
          <!-- show function ends here -->

          <!-- export to excel file js code -->
          <script>
               function exportToExcel() {
                    var location = 'data:application/vnd.ms-excel;base64,';
                    var excelTemplate = '<html> ' +
                         '<head> ' +
                         '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
                         '</head> ' +
                         '<body> ' +
                         document.getElementById("content").innerHTML +
                         '</body> ' +
                         '</html>'
                    window.location.href = location + window.btoa(excelTemplate);
               }
          </script>
          <!-- export to excel file js code ends here -->

          <!-- giving title to document and navbar -->
          <script>
               document.getElementById('page-title').innerHTML = "HPCL INOUT | Recent reports";
               document.getElementById('navbar-title').innerHTML = "Recent reports";
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
          <?php
          if (isset($_POST['export_excel'])) {
               echo "<script>alert('Executed')</script>";
               header('Content-Type: application/xls');
               header('Content-Disposition: attachment; filename="report.xls"');
          }
          ?>
</body>

</html>