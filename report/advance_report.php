<?php include "../root.php";
if (!isset($_SESSION['username'])) {
     header("Location: ../login.php");
     exit();
}
?>

<!-- including config file to use database -->
<?php include($config_loc); ?>
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

     // Truncate the report table to delete all existing data
     $truncate_sql = "TRUNCATE TABLE `report`";
     $truncate_res = mysqli_query($connection, $truncate_sql);

     if ($truncate_res) {
          // Insert new data into the report table
          $sql = "INSERT INTO `report`(`report_gen_time`, `from_date`, `to_date`, `department`, `sub_department`, `name`, `gate`) 
   VALUES (CURRENT_TIMESTAMP, '$fromdate', '$todate', '$dept', '$sub_dept', '$s_by_name', '$gate')"; //(replaced `report_gen_dt` as `report_gen_time` & replaced CURDATE() as CURRENT_TIMESTAMP)
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
          
          // used for error detecting
          //  else {
          //      echo "done";
          //      echo mysqli_error($connection);
          //      die;
          // }
     }
}


//  if (isset($_POST['generate'])) {
//       $fromdate = $_POST['fromdate'];
//       $todate = $_POST['todate'];
//       $dept = $_POST['dept'];
//       $sub_dept = $_POST['sub_dept'];
//       $gate = $_POST['gate'];
//       $s_by_name = $_POST['s_by_name'];

//       $sql = "INSERT INTO `report`(`report_gen_dt`, `from_date`, `to_date`, `department`, `sub_department`, `name`, `gate`) 
//       VALUES (CURDATE(), '$fromdate', '$todate', '$dept', '$sub_dept', '$s_by_name', '$gate')";
//       $res = mysqli_query($connection, $sql);
//       if ($res) {
//           $query = "SELECT `report_id` FROM `report` ORDER BY `report_id` DESC LIMIT 1";
//           $result = mysqli_query($connection, $query);

//           if ($result && mysqli_num_rows($result) > 0) {
//                 $row = mysqli_fetch_assoc($result);
//                 $id = $row['report_id'];
//                 $a = "?id=$id&dept=$dept&sub_dept=$sub_dept&gate=$gate&fd=$fromdate&td=$todate&nm=$s_by_name";
//                 header("Location: " . $a);
//           } else {
//                 echo "No results found";
//           }

//       }
//  }

function getSection($sub_depart)
{
     switch ($sub_depart) {
          // operation
          case 'officer':
               return "OFC";
          case 'employee':
               return "EMP";
          case 'contractor':
               return "CON";
          case 'contractor workman':
               return "CONW";
          case 'gat':
               return "GAT";
          case 'tat':
               return "TAT";
          case 'feg':
               return "FEG";
          case 'sec':
               return "SEC";

          // driver 
          case 'packed':
               return "PT";
          case 'bulk':
               return "BK";
          case 'transporter':
               return "TR";

          // project
          case 'amc':
               return "AMC";
          case 'workman':
               return "PW";

          // visitor
          case 'visitor':
               return "V";

          // all departments
          case 'all':
               return "all";
          case 'All':
               return "all";
     }
}
function getSubDepartment($section)
{
     switch ($section) {
          // operation
          case 'OFC':
               return "Officer";
          case 'EMP':
               return "Employee";
          case 'CON':
               return "Contractor";
          case 'CONW':
               return "Contractor Workman";
          case 'GAT':
               return "GAT";
          case 'TAT':
               return "TAT";
          case 'FEG':
               return "FEG";
          case 'SEC':
               return "SEC";

          // driver 
          case 'PT':
               return "Packed";
          case 'BK':
               return "Bulk";
          case 'TR':
               return "Transporter";

          // project
          case 'AMC':
               return "AMC";
          case 'PW':
               return "Workman";

          // visitor
          case 'V':
               return "Visitor";

          // all departments
          // case 'all':
          //      return "all";
          // case 'All':
          //      return "all";
     }
}
?>
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
                    <?php
                    if (isset($_GET['dept']) && isset($_GET['sub_dept']) && isset($_GET['gate']) && isset($_GET['fd']) && isset($_GET['td']) && isset($_GET['nm'])) { //dept=$dept&sub_dept=$sub_dept&gate=$gate&fd=$fromdate&td=$todate
                         ?>
                         <div class="card  border-0 shadow mt-4" id="two">

                              <div class="row mb-2">
                                   <div class="col-md-12 mt-2 ms-2">
                                        <button type="button" name="print" id="print" onclick="printContent();"
                                             class="btn btn-success mx-1">Print</button>

                                        <button type="submit" name="" onclick="exportToExcel()"
                                             class="btn btn-primary mx-1">Export To
                                             Excel</button>

                                        <!-- <button type="button" name="modal" onclick="" data-bs-toggle="modal"
                                        data-bs-target="#myModal" name="export_excel" class="btn btn-primary mx-1">Export To
                                        Excel</button> -->

                                        <button type="button" name="back" onclick="window.location.href = 'advance_report.php';"
                                             class="btn btn-secondary mx-1">Back</button>
                                             <!-- onclick="history.back(); location.reload(); return false;" -->
                                   </div>

                              </div>

                              <div id="content">
                                   <div class="table-responsive">
                                        <table class="table">
                                             <tbody>

                                                  <tr>
                                                       <th colspan="7">IN-OUT Report of HPCL</th>
                                                  </tr>

                                                  <tr>
                                                       <th>Department :<span id="dept1" style="text-transform: capitalize ">
                                                                 <?php echo $_GET['dept']; ?>
                                                                 <!-- <script>document.write(document.getElementById('dept').value);</script> -->
                                                            </span></th>
                                                       <th colspan="2">Sub-Department :<span id="sub_dept1" style="text-transform: capitalize ">
                                                                 <?php echo $_GET['sub_dept']; ?>
                                                                 <!-- <script>document.getElementById('sub_dept1').innerHTML = document.getElementById('sub_dept').value</script> -->
                                                            </span></th>
                                                       <th colspan="2">From Date :<span id="fromdate1">
                                                                 <?php echo $_GET['fd']; ?>
                                                                 <!-- <script>document.getElementById('fromdate1').innerHTML = document.getElementById('fromdate').value</script> -->
                                                            </span></th>
                                                       <th colspan="2">To Date :<span id="todate1">
                                                                 <?php echo $_GET['td']; ?>
                                                                 <!-- <script>document.getElementById('todate1').innerHTML = document.getElementById('todate').value</script> -->
                                                            </span></th>
                                                  </tr>

                                                  <tr>
                                                       <!-- <th>sr</th> -->
                                                       <th>Department</th>
                                                       <th>Name</th>
                                                       <th>Sub-Department</th>
                                                       <th>CheckIn Date</th>
                                                       <th>Time In</th>
                                                       <th>Time Out</th>
                                                       <th>CheckOut Date</th>
                                                       <th>Gate Name</th>
                                                  </tr>

                                                  <?php
                                                  $report_id = $_GET['id'];
                                                  $tablename = $_GET['gate'];
                                                  $name = $_GET['nm'];
                                                  $fromdate = $_GET['fd'];
                                                  $todate = $_GET['td'];
                                                  $dept = $_GET['dept'];
                                                  $section = getSection($_GET['sub_dept']);
                                                  $sql = "";

                                                  if ($tablename == "all") {
                                                       if ($dept == 'operation') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";

                                                                      // `id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted`

                                                                        
// SELECT `source_table`,* FROM( SELECT 'maingate' AS `source_table`,* FROM `maingate` WHERE (`date` BETWEEN '2024-06-01' AND '2024-06-27') AND `section`='OFC' AND (`name`='uday patil' ) UNION SELECT 'maingate' AS `source_table`,* FROM `licensegate` WHERE (`date` BETWEEN '2024-06-01' AND '2024-06-27') AND `section`='OFC' AND (`name`='uday patil' ) )AS combined_results;     
                                                                 }


                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'FEG', 'SEC') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'FEG', 'SEC')
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'FEG', 'SEC') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'FEG', 'SEC')
                                                                      )AS combined_results;";                                                                      
                                                                 }
                                                                 
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       } else if ($dept == 'driver') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) UNION
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) UNION
                                                                 }

                                                                 
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";                                        
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR')
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate')  AND (`name` is not null) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR') UNION
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR')
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate')  AND (`name`='$name' ) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR') UNION
                                                                 }
                                                                 
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       } else if ($dept == 'project') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'AMC' OR `section` = 'PW') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`is not null) AND (`section` = 'AMC' OR `section` = 'PW')
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'AMC' OR `section` = 'PW') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'AMC' OR `section` = 'PW')
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       } else if ($dept == 'visitor') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted`  FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'V') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'V')
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'V') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'V')
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       }
                                                       if ($dept == 'all' || $dept == 'All') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) AND (`department` != 'driver') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) AND (`department` != 'driver') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`department` != 'driver') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Main Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`department` != 'driver') UNION
                                                                      SELECT 'License Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                 }
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                             
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       }
                                                  } else if ($tablename == "drivergate") {
                                                       if ($dept == 'driver') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null)
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null) UNION
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' )
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' ) UNION
                                                                 }

                                                                 
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";                                        
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR')
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate')  AND (`name` is not null) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR') UNION
                                                                 }else{
                                                                      $sql = "
                                                                      SELECT `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM(
                                                                      SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `licensegate` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR')
                                                                      )AS combined_results;";
                                                                      
                                                                      // SELECT 'Driver Gate' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `maingate` WHERE (`date` BETWEEN '$fromdate' AND '$todate')  AND (`name`='$name' ) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR') UNION
                                                                 }
                                                                 
                                                                 // SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                                 // $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                            }
                                                       }
                                                  }else {

                                                       if ($dept == "operation") {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";    
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` ='$name');";
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`  is not null  ) AND (`section` = 'OPR' OR `section` = 'EMP' OR `section` = 'CON' OR `section` = 'CONW' OR `section` = 'GAT' OR `section` = 'TAT' OR `section` = 'FEG' OR `section` = 'SEC');";                                                                      
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'OPR' OR `section` = 'EMP' OR `section` = 'CON' OR `section` = 'CONW' OR `section` = 'GAT' OR `section` = 'TAT' OR `section` = 'FEG' OR `section` = 'SEC');";
                                                                 }
                                                            }
                                                       } else if ($dept == "driver") {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR');";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'PT' OR `section` = 'BK' OR `section` = 'TR');";
                                                                 }
                                                            }
                                                       } else if ($dept == "project") {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";    
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'AMC' OR `section` = 'PW');";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'AMC' OR `section` = 'PW');";
                                                                 }
                                                            }
                                                       } else if ($dept == "visitor") {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";     
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null) AND (`section` = 'V');";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' ) AND (`section` = 'V');";
                                                                 }
                                                            }
                                                       } else if ($dept == 'all' || $dept == 'All') {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";    
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                                 }
                                                            }
                                                       } else {
                                                            if ($section != "all") {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                                 }
                                                            } else {
                                                                 if($name == "all" || $name == "All"){
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name` is not null);";
                                                                 }else{
                                                                      $sql = "SELECT '$tablename' AS `source_table`,`id`, `qr_code`, `intime`, `outtime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`, `status`, `restricted` FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                                 }
                                                            }
                                                       }

                                                       // if ($section != "all") {
                                                       //      $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' );";
                                                       // } else {
                                                       //      $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' );";
                                                       // }
                                                  }

                                                 // echo $sql;
                                                  // die;
                                                  if (mysqli_multi_query($connection, $sql)) {
                                                       do {
                                                            // Store the first result set
                                                            if ($result = mysqli_store_result($connection)) {
                                                                 // Truncate the report_data table to delete all existing data
                                                                 $truncate_sql = "TRUNCATE TABLE `report_data`";
                                                                 $truncate_res = mysqli_query($connection, $truncate_sql);

                                                                 if ($truncate_res) {
                                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                                           // Insert new data into the report_data table
                                                                           $sql = "INSERT INTO `report_data`(`report_id`, `name`, `department`, `sub_department`, `time_in`, `time_out`, `check_in_dt`, `check_out_dt`, `gate_name`) 
                                                                                VALUES ('$report_id', '" . $row['name'] . "', '" . $row['department'] . "', '" . $row['section'] . "', '" . $row['intime'] . "', '" .
                                                                                $row['outtime'] . "', '" . $row['date'] . "', '" . $row['date'] . "', '$tablename')";
                                                                           $resu = mysqli_query($connection, $sql);

                                                                           ?>
                                                                           <tr>
                                                                                <td class="text-capitalize">
                                                                                     <!-- department -->
                                                                                     <?php echo $row['department']; ?>
                                                                                </td>
                                                                                <td class="text-capitalize">
                                                                                     <!-- name -->
                                                                                     <?php echo $row['name']; ?>
                                                                                </td>
                                                                                <td>
                                                                                     <!-- sub department -->
                                                                                     <?php echo getSubDepartment($row['section']); ?>
                                                                                </td>
                                                                                <td>
                                                                                     <!-- check in date -->
                                                                                     <?php echo $row['date']; ?>
                                                                                </td>
                                                                                <td>
                                                                                     <!-- check in time -->
                                                                                     <?php echo $row['intime']; ?>
                                                                                </td>
                                                                                <td>
                                                                                     <!-- check out time -->
                                                                                     <?php echo $row['outtime']; ?>
                                                                                </td>
                                                                                <td>
                                                                                     <!-- check out date -->
                                                                                     <?php echo $row['date']; ?>
                                                                                </td>
                                                                                <td class="text-capitalize">
                                                                                     <!-- gate name -->
                                                                                      <?php 

                                                                                          if($row['department'] == "driver"){
                                                                                               echo "Driver Gate";
                                                                                          }else if($row["source_table"] == "maingate"){
                                                                                                    echo "Main Gate";
                                                                                               }else if($row["source_table"] == "licensegate"){
                                                                                                    echo "License Gate";
                                                                                               }else{
                                                                                                    echo $row["source_table"];
                                                                                               }


                                                                                      ?>
                                                                                     <?php // echo $row["source_table"]; //$tablename; ?>
                                                                                </td>
                                                                           </tr>
                                                                           <?php
                                                                      }
                                                                 }
                                                                 mysqli_free_result($result);
                                                            }

                                                            // Check if there are more result sets
                                                       } while (mysqli_next_result($connection));
                                                  } else {
                                                       ?>
                                                       <tr>
                                                            <td colspan="8">
                                                                 <span class="text-danger">
                                                                      <?php echo "Record Not Found"; ?>
                                                                 </span>
                                                            </td>
                                                       </tr>
                                                       <?php
                                                  }
                                                  ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                              <?php
                    } else {
                         ?>
                              <div class="card border-0 shadow mt-4" id="one" style="display:block;">

                                   <div class="card-body">
                                        <div class="one">
                                             <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                  <div class="row">
                                                       <div class="col-md-3">
                                                            <div class="form-group">
                                                                 <label for="fromdate" class="col-form-label ">From Date
                                                                      :</label>
                                                                 <input type="date" class="form-control" name="fromdate" 
                                                                 value="<?= date("Y-m-d"); ?>" id="fromdate" max="">

                                                            </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <div class="form-group">
                                                                 <label for="todate" class="col-form-label ">To Date
                                                                      :</label>
                                                                 <input type="date" class="form-control" name="todate"
                                                                      value="<?= date("Y-m-d"); ?>" id="todate" min="" max="">

                                                            </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <div class="form-group">
                                                                 <label for="dept"
                                                                      class="col-form-label ">Department :</label>
                                                                 <select class="form-control" name="dept" id="dept"
                                                                      onchange="p(this.id,'sub_dept'); gatefun(this.id, 'gate');">
                                                                      <!-- <option value="">Select gate</option> -->
                                                                      <option class="dropdown-toggle" value="All">All
                                                                      </option>
                                                                      <option value="operation">Operation</option>
                                                                      <option value="driver">Driver</option>
                                                                      <option value="project">Project</option>
                                                                      <option value="visitor">Visitor</option>

                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                            <div class="form-group">
                                                                 <label for="sub_dept"
                                                                      class="col-form-label ">Sub-Department :</label>
                                                                 <select class="form-control form-control" name="sub_dept"
                                                                      id="sub_dept" onchange="setNames()">
                                                                      <!-- <option value="">Select gate</option> -->
                                                                      <option value="All">All</option>
                                                                 </select>
                                                            </div>

                                                       </div>
                                                  </div>

                                                  <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <label for="s_by_name" class="col-form-label ">Search by
                                                                      Name :</label>
                                                                 <select class="form-control" name="s_by_name"
                                                                      oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')"
                                                                      placeholder="Select Name" id="s_by_name">
                                                                      <!-- <option value="">Select gate</option> -->
                                                                      <option value="All">All</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <label for="gate" class="col-form-label ">Gate :</label>
                                                                 <select class="form-control form-control" name="gate"
                                                                      id="gate">
                                                                      <!-- <option value="">Select gate</option> -->
                                                                      <option value="all">All</option>
                                                                      <option value="maingate">Main Gate</option>
                                                                      <option value="licensegate">Liscence Gate</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="row">
                                                       <div class="form-group col-md-3">
                                                            <button type="submit" name="generate" onclick="show()"
                                                                 class="btn btn-lg btn-primary">Generate Report</button>
                                                            <!-- <input type="submit" onclick="display();" name="generate"> -->
                                                       </div>
                                                       <div class="col-md-9"></div>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                              <?php
                    }
                    ?>
<!-- <iframe title="sinnar_report" style="width: 100%" height="auto" src="https://app.powerbi.com/reportEmbed?reportId=496d268d-2967-4387-aec7-f6f09a969a91&autoAuth=true&ctid=74d78a88-5c14-44bb-b3c8-41b4fdeac6d1" frameborder="0" allowFullScreen="true"></iframe> -->
                    </div> <!-- container-fluid ends here -->
                    <!-- End Page Content -->
               </div>
          </div>

          <!-- Start writing content here -->
          <main>

          </main>

          <!-- script for date validation -->
          <script>
               document.getElementById('fromdate').addEventListener('change', function() {
                    var fromDate = this.value;
                    document.getElementById('todate').min = fromDate;
               });
               // Set the max attribute to today's date
               const today = new Date().toISOString().split('T')[0];
               document.getElementById('fromdate').setAttribute('max', today);
               document.getElementById('todate').setAttribute('max', today);
          </script>
          <script>
               function setToDateMin() {
                    let fromDate = document.getElementById('fromDate').value;
                    document.getElementById('todate').min = fromDate;
               }
          </script>
                    <!-- script for autofill -->
          <script>
               // query: SELECT `full_name` FROM `$subdepart` WHERE `full_name` IS NOT NULL

               // const token = document.getElementById('token_no').value.trim();

               function setNames() {
                    // const aadhar_no = document.getElementById('aadhar_no').value.trim();
                    const sub_dept = document.getElementById('sub_dept').value.trim();
                    const namefield = document.getElementById('s_by_name');
                    if(sub_dept == "all"){
                         
                         document.getElementById("s_by_name").innerHTML = "";
                         var newoption = document.createElement("option");
                         newoption.value = "all";
                         newoption.innerHTML = "All";
                         namefield.options.add(newoption);
                    }else{
                         fetch('autofillnm.php?sub_dept=' + sub_dept)
                              .then(response => {
                                   console.log(response);
                                   if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                   }
                                   return response.json();
                              })
                              .then(data => {
                                   //console.log(data);
                                   // if (data./message == "data found") {
                                   // s_by_name
                                   console.log(data);
                                   document.getElementById("s_by_name").innerHTML = "";

                                   var newoption = document.createElement("option");
                                   // newoption.value = "";
                                   // newoption.innerHTML = "Select Name";
                                   // namefield.options.add(newoption);
                                   
                                   document.getElementById("s_by_name").innerHTML = "";

                                   newoption.value = "all";
                                   newoption.innerHTML = "All";
                                   namefield.options.add(newoption);
                                   for (var i = 0; i < data.length; i++) {
                                        var newoption = document.createElement("option");
                                        newoption.value = data[i];
                                        newoption.innerHTML = data[i];
                                        namefield.options.add(newoption);
                                   }
                                   // document.getElementById('s_by_name').value = data.token_no;
                                   // }
                                   // else {
                                   //      document.getElementById('s_by_name').value = "";
                                   // }
                              })
                              .catch(error => {
                                   console.error('There was a problem with the fetch operation:', error);
                              });
                         }


               }
          </script>
          <!-- javascript p function -->
          <script>
               function p(s1, s2) {

                    var s1 = document.getElementById(s1);
                    var s2 = document.getElementById(s2);
                    // console.log(s1.value);
                    s2.innerHTML = "";
                    if (s1.value == "operation") {
                         var optionArray = ['all|All', 'officer|Officer', 'employee|Employee', 'contractor|Contractor', 'contractor workman|Contractor Workman', 'gat|GAT', 'tat|TAT', 'sec|SEC', 'feg|FEG'];
                         // console.log(s1.value+"Operation");


                    }
                    else if (s1.value == "driver") {
                         var optionArray = ['all|All', 'packed|Packed', 'bulk|Bulk', 'transporter|Transporter'];
                         var gateoption = ['driver gate|Driver Gate'];
                         // console.log(s1.value+"Driver");

                    }
                    else if (s1.value == "project") {
                         var optionArray = ['all|All', 'workman|Workman', 'amc|AMC'];
                         // console.log(s1.value+"Project");

                    }
                    else if (s1.value == "visitor") {
                         var optionArray = ['all|All', 'visitor|Visitor'];
                         // console.log(s1.value+"Visitor");

                    }
                    else if (s1.value == "all") {
                         var optionArray = ['all|All'];
                         // console.log(s1.value+"All");
                    }
                    else {
                         var optionArray = ['all|All'];
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

               function gatefun(dept, gates){
                    var dept = document.getElementById(dept);
                    var gates = document.getElementById(gates);

                    gates.innerHTML="";
                    
                    if (dept.value == "driver") {
                         var optionArray = ['drivergate|Driver Gate'];
                    }else {
                         var optionArray = ['all|All', 'maingate|Main Gate', 'licensegate|License Gate'];
                    }

                    for (var option in optionArray) {
                         var pair = optionArray[option].split("|");
                         var newoption = document.createElement("option");
                         newoption.value = pair[0];
                         newoption.innerHTML = pair[1];
                         gates.options.add(newoption);
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
               document.getElementById('page-title').innerHTML = "HPCL INOUT | ADVANCE REPORT";
               document.getElementById('navbar-title').innerHTML = "Advance Report";
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