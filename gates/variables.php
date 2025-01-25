<?php
$licensetable = "licensegate";
$maintable = "maingate";
$assemblytable = "assemblygate";

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
$drivergate_driver_count = driverGateDriverCount($maintable ,$licensetable);
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

$assembly_operation_count = 0;
$assembly_operation_count = getOperationCount($assemblytable);
$assembly_driver_count = 0;
$assembly_driver_count = getDriverCount($assemblytable);
$assembly_project_count = 0;
$assembly_project_count = getProjectCount($assemblytable);
$assembly_visitor_count = 0;
$assembly_visitor_count = getVisitorCount($assemblytable);
// driverGateOperationCount(){}driverGateDriverCount(){}driverGateProjectCount(){}driverGateVisitorCount(){}

// checking if person entered in main gate or not
function enteredMaingate($qr)
{
     global $connection;
     $sql = "SELECT `id` FROM `maingate` WHERE `qr_code`='$qr' AND `status` = 1 AND `date` = CURDATE()"; //`intime` IS NOT NULL AND `outtime` IS NULL";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               return $row['id'];
          }
     } else {
          return 0;
     }
}

// increase count of section
function increaseCount($section)
{
     global $licensegate_operation_count;
     global $licensegate_driver_count;
     global $licensegate_project_count;
     global $licensegate_visitor_count;
     switch ($section) {
          // FOR OPERATION SECTION
          case 'OFC':
               $licensegate_operation_count++;
               break;
          case 'EMP':
               $licensegate_operation_count++;
               break;
          case 'CON':
               $licensegate_operation_count++;
               break;
          case 'CONW':
               $licensegate_operation_count++;
               break;
          case 'GAT':
               $licensegate_operation_count++;
               break;
          case 'TAT':
               $licensegate_operation_count++;
               break;
          case 'SEC':
               $licensegate_operation_count++;
               break;
          case 'FEG':
               $licensegate_operation_count++;
               break;

          // FOR DRIVER SECTION
          case 'PT':
               $licensegate_driver_count++;
               break;
          case 'BK':
               $licensegate_driver_count++;
               break;
          case 'TR':
               $licensegate_driver_count++;
               break;

          // FOR PROJECT SECTION
          case 'PW':
               $licensegate_project_count++;
               break;
          case 'AMC':
               $licensegate_project_count++;
               break;

          // FOR VISITOR SECTION
          case 'V':
               $licensegate_visitor_count++;
               break;
     }

}


// increase count of section
function decreaseCount($section)
{
     global $licensegate_operation_count;
     global $licensegate_driver_count;
     global $licensegate_project_count;
     global $licensegate_visitor_count;
     switch ($section) {
          // FOR OPERATION SECTION
          case 'OFC':
               $licensegate_operation_count--;
               break;
          case 'EMP':
               $licensegate_operation_count--;
               break;
          case 'CON':
               $licensegate_operation_count--;
               break;
          case 'CONW':
               $licensegate_operation_count--;
               break;
          case 'GAT':
               $licensegate_operation_count--;
               break;
          case 'TAT':
               $licensegate_operation_count--;
               break;
          case 'SEC':
               $licensegate_operation_count--;
               break;
          case 'FEG':
               $licensegate_operation_count--;
               break;

          // FOR DRIVER SECTION
          case 'PT':
               $licensegate_driver_count--;
               break;
          case 'BK':
               $licensegate_driver_count--;
               break;
          case 'TR':
               $licensegate_driver_count--;
               break;

          // FOR PROJECT SECTION
          case 'PW':
               $licensegate_project_count--;
               break;
          case 'AMC':
               $licensegate_project_count--;
               break;

          // FOR VISITOR SECTION
          case 'V':
               $licensegate_visitor_count--;
               break;
     }

}


// get section of qr
function getSectionOfQr($qr)
{
     // Finding the position of the dash
     $dash_position = strpos($qr, '/');

     // Extracting the substrings
     $section = trim(substr($qr, 0, $dash_position));
     return $section;
}

function getTableName($qr){
     $section = getSectionOfQr($qr);
     switch ($section) {
          // FOR OPERATION SECTION
          case 'OFC':
               return "officer";
          case 'EMP':
               return "employee";
          case 'CON':
               return "contractor";
          case 'CONW':
               return "contractor_workman";
          case 'GAT':
               return "gat";
          case 'TAT':
               return "tat";
          case 'SEC':
               return "sec";
          case 'FEG':
               return "feg";

          // FOR DRIVER SECTION
          case 'PT':
               return "packed";
          case 'BK':
               return "bulk";
          case 'TR':
               return "transporter";

          // FOR PROJECT SECTION
          case 'PW':
               return "workman";
          case 'AMC':
               return "amc";

          // FOR VISITOR SECTION
          case 'V':
               return "visitor";
     }
}



function getToken($qr, $tablename){
     global $connection;
     $sql = "SELECT `id`, `token_no` FROM `$tablename` WHERE `qr_code`='$qr'";
     // echo $sql;die;
     $res = mysqli_query($connection, $sql);
     // print_r($res);die;
     if ($res) {
          // echo 'true';1
          while ($row = mysqli_fetch_assoc($res)) {
               $token = $row['token_no'];
               return $token;
          }
     } else {
          // echo 'false' . "<br>";
          // echo $sql . "<br>";
          return $sql;
     }
}

function getDepartment($qr, $token, $tablename){
     
     $section = getSectionOfQr($qr);
     switch ($section) {
          // FOR OPERATION SECTION
          case 'OFC':
               return "operation";
          case 'EMP':
               return "operation";
          case 'CON':
               return "operation";
          case 'CONW':
               return "operation";
          case 'GAT':
               return "operation";
          case 'TAT':
               return "operation";
          case 'SEC':
               return "operation";
          case 'FEG':
               return "operation";

          // FOR DRIVER SECTION
          case 'PT':
               return "driver";
          case 'BK':
               return "driver";
          case 'TR':
               return "driver";

          // FOR PROJECT SECTION
          case 'PW':
               return "project";
          case 'AMC':
               return "project";

          // FOR VISITOR SECTION
          case 'V':
               return "visitor";
     }
}
function getAdhar($qr, $token, $tablename){
     global $connection;
     $sql = "SELECT `id`, `aadhar_no` FROM `$tablename` WHERE `qr_code`='$qr' AND `token_no` = '$token'";
     $res = mysqli_query($connection, $sql);

     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $token = $row['aadhar_no'];
               return $token;
          }
     } else {
          return 0;
     }
}
function getName($qr, $token, $tablename){
     global $connection;
     $sql = "SELECT `id`, `full_name` FROM `$tablename` WHERE `qr_code`='$qr' AND `token_no` = '$token'";
     $res = mysqli_query($connection, $sql);
     
     if ($res) {
          $row = mysqli_fetch_assoc($res);
               $token = $row['full_name'];
               return $token;
          
     } else {
          // echo "Done: $sql";
          // echo mysqli_error($connection);die;
          return $sql;
     }


     // if ($res) {
     //      while ($row = mysqli_fetch_assoc($res)) {
     //           $token = $row['full_name'];
     //           return $token;
     //      }
     // } else {
     //      return 0;
     // }
}

function getMobile($qr, $token, $tablename){
     global $connection;
     $sql = "SELECT `id`, `mobile_no` FROM `$tablename` WHERE `qr_code`='$qr' AND `token_no` = '$token'";
     $res = mysqli_query($connection, $sql);

     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $token = $row['mobile_no'];
               return $token;
          }
     } else {
          return 0;
     }
}
function getAddress($qr, $token, $tablename){
     global $connection;
     $sql = "SELECT `id`, `address` FROM `$tablename` WHERE `qr_code`='$qr' AND `token_no` = '$token'";
     $res = mysqli_query($connection, $sql);

     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $token = $row['address'];
               return $token;
          }
     } else {
          return 0;
     }
}



// to remove record or exiting user from gate
function setOutTime($qr, $tablename)
{
     global $connection;
     $time = date('H:i:s');
     // echo $time;
     $table = getTableName($qr);
     $sqlMain = "SELECT `restricted` FROM `$table` WHERE `qr_code` = '$qr'";
     $res = mysqli_query($connection, $sqlMain);
     if($res){
          while($row = mysqli_fetch_assoc($res)){
               if($row['restricted'] == 0){
                    $sql = "UPDATE `$tablename` SET `outtime`='$time', `status` = '0' WHERE `qr_code` = '$qr' AND `date` = CURDATE()";
                    $res = mysqli_query($connection, $sql);
                    if ($res) {
                         return true;
                    } else {
                         // mysqli_error($connection);
                         return false;
                    }
               }else if($row['restricted'] == 1){
                    return false;
               }
          }
     }

}

// for entering user in gate
function addRecord($qr, $section, $token_no, $depart, $adhar, $name, $mobile, $address, $tablename)
{
     global $connection;
     $table = getTableName($qr);
     $sqlMain = "SELECT `restricted` FROM `$table` WHERE `qr_code` = '$qr'";
     $res = mysqli_query($connection, $sqlMain);
     if($res){
          while($row = mysqli_fetch_assoc($res)){
               if($row['restricted'] == 0){
                    $sql = "INSERT INTO `$tablename`(`qr_code`, `intime`, `date`,`section`, `token_no`, `department`, `adhar`, 
                    `name`, `mobile`, `address`, `status`) VALUES ('$qr','" . date('H:i:s') . "','" . date("Y-m-d") . "','" . $section .
                     "', $token_no, '$depart','$adhar','$name','$mobile','$address',  1)";
                    //  echo $sql;die;
                    $res = mysqli_query($connection, $sql);
                    if ($res) {
                         return true;
                    } else {
                         return false;
                    }
               }else if($row['restricted'] == 1){
                    return false;
               }
          }
     }

    
}


// is qrcode correct
function isQrCorrect($input) {
     // Define the regex pattern
     $pattern = '/^[A-Z]+\/HPNSK\/\d+$/';
 
     // Check if the input matches the pattern
     if (preg_match($pattern, $input)) {
         return true;
     } else {
         return false;
     }
}
function isDriverQrCorrect($input){
     // Define the regex pattern
     $pattern = '/^[A-Z]+\/HPNSK\/\d+$/';
 
     // Check if the input matches the pattern
     if (preg_match($pattern, $input)) {
         $sec = getSectionOfQr($input);
         if($sec == "PT" || $sec == "BK" || $sec == "TR"){
               return true;
         }
     } else {
         return false;
     }
}


 
function driverGateOperationCount($maingate ,$licensetable){
     global $connection;
     $count = 0;
     // $sql = "SELECT `id`, `section` FROM `$maingate` WHERE `status` = 1 AND `date` = CURDATE();
     // SELECT `id`, `section` FROM `$licensetable` WHERE `status` = 1 AND `date` = CURDATE();";
     // $res = mysqli_query($connection, $sql);
     // if ($res) {
     //      while ($row = mysqli_fetch_assoc($res)) {
     //           if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
     //                $count++;
     //           }
     //      }
     // }

     return $count;
}

function driverGateDriverCount($maingate ,$licensetable){
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `qr_code`,`section` FROM `$maingate` WHERE `status` = 1 AND `date` = CURDATE();";
     // $sql = "SELECT `id`, `section` FROM `$licensetable` WHERE `status` = 1 AND `date` = CURDATE();";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
                    $sql1 = "SELECT `id`, `section` FROM `$licensetable` WHERE `qr_code` = '".$row['qr_code']."' AND `status` = 1 AND `date` = CURDATE();";
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
function  driverGateProjectCount($maingate ,$licensetable){
     global $connection;
     $count = 0;
     // $sql = "SELECT `id`, `section` FROM `$maingate` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE();
     // SELECT `id`, `section` FROM `$licensetable` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE();";
     // $res = mysqli_query($connection, $sql);
     // if ($res) {
     //      while ($row = mysqli_fetch_assoc($res)) {
     //           if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
     //                $count++;
     //           }
     //      }
     // }

     return $count;
}
function driverGateVisitorCount($maingate ,$licensetable){
     global $connection;
     $count = 0;
     // $sql = "SELECT `id`, `section` FROM `$maingate` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE();
     // SELECT `id`, `section` FROM `$licensetable` WHERE `status` = 1 AND `date` = CURDATE() AND `date` = CURDATE();";
     // $res = mysqli_query($connection, $sql);
     // if ($res) {
     //      while ($row = mysqli_fetch_assoc($res)) {
     //           if ($row['section'] == 'PT' || $row['section'] == 'BK' || $row['section'] == 'TR') {
     //                $count++;
     //           }
     //      }
     // }

     return $count;
}


function isEnteredMainGate($qr){
global $connection;
$sql = "SELECT * FROM `maingate` WHERE `qr_code` = '$qr' AND `status` = 1 AND `date` = CURDATE();";
$res = mysqli_query($connection, $sql);
if($res){
     if(mysqli_num_rows($res) > 0){
          return true;
     }else{
          return false;
     }
}
}
?>