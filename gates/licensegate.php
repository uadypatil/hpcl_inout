<!-- including root file -->
<?php include("../root.php"); ?>
<!-- if file is in any folder use ../root.php -->

<!-- including config file to use database -->
<?php include($config_loc); ?>

<?php

// setting default time zone for india (IST) koltata
date_default_timezone_set('Asia/Kolkata');

$success_msg = "";
$error_msg = "";


// code for qr validation and database entries
if ($_SERVER['REQUEST_METHOD'] == "POST") {
     $qr = $_POST['qr-field'];
     if (isValidQR($qr)) {
          $delimiter = '/';

          $parts = explode($delimiter, $qr);
          $id = intval($parts[2]);
          if ($parts['1'] == "HPNSK") {
               $sub_dept = $parts[0];
               switch ($sub_dept) {
                    case 'OFC':
                         setValue("officer", "operation", "OFC", $id, $qr);
                         break;
                    case 'EMP':
                         setValue("employee", "operation", "EMP", $id, $qr);
                         break;
                    case 'CON':
                         setValue("contractor", "operation", "CON", $id, $qr);
                         break;
                    case 'CONW':
                         setValue("contractor_workman", "operation", "CONW", $id, $qr);
                         break;
                    case 'GAT':
                         setValue("gat", "operation", "GAT", $id, $qr);
                         break;
                    case 'TAT':
                         setValue("tat", "operation", "TAT", $id, $qr);
                         break;
                    case 'FEG':
                         setValue("feg", "operation", "FEG", $id, $qr);
                         break;
                    case 'SEC':
                         setValue("sec", "operation", "SEC", $id, $qr);
                         break;

                    // project section
                    case 'AMC':
                         setValue("amc", "project", "AMC", $id, $qr);
                         break;
                    case 'PW':
                         setValue("workman", "project", "PW", $id, $qr);
                         break;

                    //  visitor section
                    case 'V':
                         setValue("visitor", "visitor", "V", $id, $qr);
                         break;

                    // driver section
                    case 'PT':
                         // setValue("packed", "driver", "PT", $id);
                         $error_msg = "Enter in driver gate";
                         break;
                    case 'BK':
                         // setValue("bulk", "driver", "BK", $id);
                         $error_msg = "Enter in driver gate";
                         break;
                    case 'TR':
                         // setValue("transporter", "driver", "TR", $id);
                         $error_msg = "Enter in driver gate";
                         break;

                    // default condition
                    default:
                         $error_msg = "";
                         // echo "Invalid QR";
                         break;
               }

          }
     } else {
          $error_msg = "Invalid QR";
          // echo "Invalid QR";
     }

}

function getFullName($table, $id)
{
     global $connection;
     $sql = "SELECT `full_name` FROM $table WHERE `token_no` = '$id'";
     $res = mysqli_query($connection, $sql);
     $row = mysqli_fetch_assoc($res);
     $name = $row['full_name'];
     return $name;
}

function setValue($table, $dept, $sub_dept, $id, $qr)
{
     global $connection;
     global $success_msg;
     global $error_msg;


     // if person is in plant then set outtime
     if(qrintable($table, $qr)){
       if (isQrExist($id, $sub_dept)) {
          if (isInMainGate($id, $sub_dept)) {

               $sql = "SELECT * FROM $table WHERE `token_no` = '$id' AND `restricted` = '0'";
               $res = mysqli_query($connection, $sql);

               if($res){
                    $row = mysqli_fetch_assoc($res);

                    if($row){

                         $sql2 = "UPDATE `licensegate` SET `outtime`='" . date('H:i:s') . "', `status`= 0 WHERE `token_no` = '$id' AND `qr_code` = '$qr' AND `date` = CURDATE()";
                         // echo $sql;
                         $res2 = mysqli_query($connection, $sql2);
                         if ($res2) {
                              $success_msg = getFullName($table, $id) . " Scan Out To License Gate";
                              // echo "person exited";
                         }
                    } else {
                         $error_msg = getFullName($table, $id) . " is Restricted can't Scan Out";

                    }
                    
               }
              
          }
     } else { // if person is not in plant then setting intime
          if (isInMainGate($id, $sub_dept)) {
               $sql = "SELECT * FROM $table WHERE `token_no` = '$id' AND `restricted` = '0'";
               $res = mysqli_query($connection, $sql);

               if($res){
                    $row = mysqli_fetch_assoc($res);

                    if($row){
                         $sql2 = "INSERT INTO `licensegate`(`qr_code`, `intime`, `date`, `section`, `token_no`, `department`, `adhar`, `name`, `mobile`, `address`) VALUES (
                              '" . $row['qr_code'] . "', '" . date('H:i:s') . "', '" . date("Y-m-d") . "', '$sub_dept', '$id', '" . $dept . "', '" . $row['aadhar_no'] . "', '" . $row['full_name'] . "', '" . $row['mobile_no'] . "', '" . $row['address'] . "')";
                                  $res2 = mysqli_query($connection, $sql2);
                                  // echo "<br>".$sql2;
                                  if ($res2) {
                                       $success_msg = getFullName($table, $id) . " Scan In To License Gate";
                                       // echo "Person entered.";
                                  }
                    } else {
                         $error_msg = getFullName($table, $id) . " is Restricted can't Scan In";

                    }


               }

              
          } else {
               $error_msg = "First Enter Main Gate";
               // echo "person is in license gate";
               // echo "First enter main gate";
          }
       }
     } else {
          $error_msg="This qr not exist";
     }

}

// checks qr is in table or not
function qrintable($table, $qr){
     global $connection;
     $sql = "SELECT * FROM $table WHERE qr_code = '$qr'";// 'true' AS bool 
     $res = mysqli_query($connection, $sql);
     if($res && mysqli_num_rows($res) > 0){
          $row = mysqli_fetch_row($res);
          // if($row['bool']){
          //      return true;
          // }else{
          //      return false;
          // }
          return true;
     }else{
          return false;
     }
}
function isQrExist($token, $sub_dept)
{
     global $connection;

     $sql = "SELECT * FROM `licensegate` WHERE `token_no` = '$token' AND `section`='$sub_dept' AND `date` = CURDATE() AND `status`='1' ";
     $res = mysqli_query($connection, $sql);

     if ($res && mysqli_num_rows($res) > 0) { // person is in main gate
          // echo $sql;
          return true;
     } else { // person is not in main gate
          // echo $sql . "asdf";
          return false;
     }
}

function isInMainGate($token, $sub_dept)
{
     global $connection;

     $sql = "SELECT * FROM `maingate` WHERE `token_no` = '$token' AND `section`='$sub_dept' AND `date` = CURDATE() AND `status`='1' ";
     $res = mysqli_query($connection, $sql);

     if ($res && mysqli_num_rows($res) > 0) { // person is in license gate
          // echo $sql;
          return true;
     } else { // person is not in license gate
          // echo $sql . "asdf";
          return false;
     }
}

function isValidQR($qr)
{
     // Define the regex pattern
     $pattern = '/^[A-Z]+\/HPNSK\/\d+$/';

     // Check if the input matches the pattern
     if (preg_match($pattern, $qr)) {
          return true;
     } else {
          return false;
     }
}


// variables for countings
$maintable = "maingate";
$licensetable = "licensegate";

// counting variables for main gate
$maingate_operation_count = 0;
$maingate_operation_count = getOperationCount($maintable);
$maingate_driver_count = 0;
$maingate_driver_count = getDriverCount($maintable);
$maingate_project_count = 0;
$maingate_project_count = getProjectCount($maintable);
$maingate_visitor_count = 0;
$maingate_visitor_count = getVisitorCount($maintable);

// counting variables for license gate
$licensegate_operation_count = 0;
$licensegate_operation_count = getOperationCount($licensetable);
$licensegate_driver_count = 0;
$licensegate_driver_count = getDriverCount($licensetable);
$licensegate_project_count = 0;
$licensegate_project_count = getProjectCount($licensetable);
$licensegate_visitor_count = 0;
$licensegate_visitor_count = getVisitorCount($licensetable);

// counting variables for license gate
$drivergate_operation_count = 0;
// $drivergate_operation_count = driverGateOperationCount($maintable ,$licensetable);
$drivergate_driver_count = 0;
$drivergate_driver_count = driverGateDriverCount($maintable, $licensetable);
$drivergate_project_count = 0;
// $drivergate_project_count = driverGateProjectCount($maintable ,$licensetable);
$drivergate_visitor_count = 0;
// $drivergate_visitor_count = driverGateVisitorCount($maintable ,$licensetable);

// counting variables for license gate
$delicense_operation_count = 0;
$delicense_operation_count = DeLiOperationCount();
$delicense_driver_count = 0;
$delicense_driver_count = DeLiDriverCount();
$delicense_project_count = 0;
$delicense_project_count = DeLiProjectCount();
$delicense_visitor_count = 0;
$delicense_visitor_count = DeLiVisitorCount();

$error_message = "";
// function operation counts
function getOperationCount($tablename)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if (
                    $row['section'] == 'OFC' || $row['section'] == 'EMP' || $row['section'] == 'CON' || $row['section'] == 'CONW' ||
                    $row['section'] == 'GAT' || $row['section'] == 'TAT' || $row['section'] == 'FEG' || $row['section'] == 'SEC'
               ) {
                    $count++;
               }
          }
     }

     return $count;
}

// function Driver counts
function getDriverCount($tablename)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
                    $count++;
               }
          }
     }

     return $count;
}

// function operation counts
function getProjectCount($tablename)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `status` = 1 AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['section'] == 'PW' || $row['section'] == 'AMC') {
                    $count++;
               }
          }
     }

     return $count;
}

// function operation counts
function getVisitorCount($tablename)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `status` = 1 AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['section'] == 'V') {
                    $count++;
               }
          }
     }

     return $count;
}

function DeLiOperationCount()
{
     global $connection;
     $count = 0;
     $sqlmain = "SELECT `id`, `qr_code` FROM `maingate` WHERE `status` = '1' AND (`section` = 'OFC' OR `section` = 'EMP' OR `section` = 'CON' OR `section` = 'CONW' OR `section` = 'GAT' OR `section` = 'TAT' OR `section` = 'SEC' OR `section` = 'FEG') AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sqlmain);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count++;
               $qr = $row['qr_code'];
               $sqllicense = "SELECT `id`, `qr_code` FROM `licensegate` WHERE `qr_code` = '$qr' AND `status` = '1' AND `date` = CURDATE()";
               $resli = mysqli_query($connection, $sqllicense);
               if ($resli) {
                    // $count--;
                    while ($rowli = mysqli_fetch_assoc($resli)) {
                         if ($row['qr_code'] == $rowli['qr_code']) {
                              $count--;
                         }
                    }
               }
          }
     }
     return $count;
}

function DeLiDriverCount()
{
     global $connection;
     $count = 0;
     $sqlmain = "SELECT `id`, `qr_code` FROM `maingate` WHERE `status` = '1' AND (`section` = 'BK' OR `section` = 'TR' OR `section` = 'PT') AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sqlmain);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count++;
               $qr = $row['qr_code'];
               $sqllicense = "SELECT `id`, `qr_code` FROM `licensegate` WHERE `qr_code` = '$qr' AND `status` = '1' AND `date` = CURDATE()";
               $resli = mysqli_query($connection, $sqllicense);
               if ($resli) {
                    // $count--;
                    while ($rowli = mysqli_fetch_assoc($resli)) {
                         if ($row['qr_code'] == $rowli['qr_code']) {
                              $count--;
                         }
                    }
               }
          }
     }
     return $count;
}

function DeLiProjectCount()
{
     global $connection;
     $count = 0;
     $sqlmain = "SELECT `id`, `qr_code` FROM `maingate` WHERE `status` = '1' AND (`section` = 'PW' OR `section` = 'AMC') AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sqlmain);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count++;
               $qr = $row['qr_code'];
               $sqllicense = "SELECT `id`, `qr_code` FROM `licensegate` WHERE `qr_code` = '$qr' AND `status` = '1' AND `date` = CURDATE()";
               $resli = mysqli_query($connection, $sqllicense);
               if ($resli) {
                    // $count--;
                    while ($rowli = mysqli_fetch_assoc($resli)) {
                         if ($row['qr_code'] == $rowli['qr_code']) {
                              $count--;
                         }
                    }
               }
          }
     }
     return $count;
}

function DeLiVisitorCount()
{
     global $connection;
     $count = 0;
     $sqlmain = "SELECT `id`, `qr_code` FROM `maingate` WHERE `status` = '1' AND (`section` = 'V') AND `date` = CURDATE()";
     $res = mysqli_query($connection, $sqlmain);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count++;
               $qr = $row['qr_code'];
               $sqllicense = "SELECT `id`, `qr_code` FROM `licensegate` WHERE `qr_code` = '$qr' AND `status` = '1' AND `date` = CURDATE()";
               $resli = mysqli_query($connection, $sqllicense);
               if ($resli) {
                    // $count--;
                    while ($rowli = mysqli_fetch_assoc($resli)) {
                         if ($row['qr_code'] == $rowli['qr_code']) {
                              $count--;
                         }
                    }
               }
          }
     }
     return $count;
}
function driverGateDriverCount($maingate, $licensetable)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `qr_code`,`section` FROM `$maingate` WHERE `status` = 1 AND `date` = CURDATE();";
     // $sql = "SELECT `id`, `section` FROM `$licensetable` WHERE `status` = 1 AND `date` = CURDATE();";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
                    $sql1 = "SELECT `id`, `section` FROM `$licensetable` WHERE `qr_code` = '" . $row['qr_code'] . "' AND `status` = 1 AND `date` = CURDATE();";
                    $res1 = mysqli_query($connection, $sql1);
                    if ($res1) {
                         while ($row = mysqli_fetch_assoc($res1)) {
                              if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
                                   $count++;
                              }
                         }
                    }
               }
          }
     }


     return $count;
}


?>

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
     <style>
          .alert-box {
               display: none;
          }
     </style>
</head>

<!-- filename -->
<?php
$filename = "licensegate.php";
?>

<body>
     <?php
     $page_title = "License Gate";
     include "gatecontent.php"; ?>

     <!-- script for showing messages/ alert boxes -->
     <script>
          var success_msg = <?php echo json_encode($success_msg); ?>; // Get the PHP message
          var error_msg = <?php echo json_encode($error_msg); ?>; // Get the PHP message

          if (success_msg) {
               document.getElementById('success-box').style.display = 'block';
               document.getElementById('strs').innerHTML = success_msg;
          } else if (error_msg) {
               document.getElementById('error-box').style.display = 'block';
               document.getElementById('stre').innerHTML = error_msg;
          }
     </script>
     <!-- script for showing message ends -->

     </script>
     <!-- script for adding record to database or removing from database -->
     <script>
          function checkqr() {
               const qr_code = document.getElementById('qr-field').value.trim();
               window.location.href = 'addlicensegate.php?qc=' + qr_code;
          }

     </script>
     <script>
          const myTimeout = setTimeout(myGreeting, 3000);

          function myGreeting() {
               if(document.getElementById("error-box").style.display == "block" || document.getElementById("success-box").style.display == "block"){
                    document.getElementById("error-box").style.display = "none";
                    document.getElementById("success-box").style.display = "none";
                    window.location.href = "licensegate.php";
               }
          }
     </script>

     <script>
          document.getElementById('page-title').innerHTML = "License Area";
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
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>


</body>

</html>