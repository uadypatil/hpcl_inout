
<?php include("root_api.php");




   include($config_loc);

$licensetable = "licensegate";
$maintable = "maingate";

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
// $drivergate_operation_count = DeLiOperationCount();
$drivergate_driver_count = 0;
// $drivergate_driver_count = DeLiDriverCount();
$drivergate_project_count = 0;
// $drivergate_project_count = DeLiProjectCount();
$drivergate_visitor_count = 0;
// $drivergate_visitor_count = DeLiVisitorCount();

// counting variables for license gate
$delicense_operation_count = 0;
$delicense_operation_count = DeLiOperationCount();
$delicense_driver_count = 0;
$delicense_driver_count = DeLiDriverCount();
$delicense_project_count = 0;
$delicense_project_count = DeLiProjectCount();
$delicense_visitor_count = 0;
$delicense_visitor_count = DeLiVisitorCount();


$totalOperationStaffCount = 0;
$totalOperationStaffCount = totalOperationStaffCount();
$totalDriverStaffCount = 0;
$totalDriverStaffCount = totalDriverStaffCount();
$totalProjectStaffCount = 0;
$totalProjectStaffCount = totalProjectStaffCount();
$totalVisitorStaffCount = 0;
$totalVisitorStaffCount = totalVisitorStaffCount();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
$data=[
'status' => 'success',
'TotalInCountMainGet' => [
'Operation'=>$maingate_operation_count,
'driver'=>$maingate_driver_count,
'calab'=>$maingate_project_count,
'visitor'=>$maingate_visitor_count,
'total_main'=>$maingate_operation_count+$maingate_driver_count+$maingate_project_count+$maingate_visitor_count,
],
 'TotalInoutLicenseArea' => [
'Operation_license'=>$licensegate_operation_count,
'driver_license'=>$licensegate_driver_count,
'calab_license'=>$licensegate_project_count,
'visitor_license'=>$licensegate_visitor_count,
],
'staff'=>[
'operation_total' => $totalOperationStaffCount,
'driver_total' => $totalDriverStaffCount,
'project_total' => $totalProjectStaffCount,
'visitor_total' => $totalVisitorStaffCount
],
'TotalInoutDelicenseArea' => [
'operation_delicense' => $delicense_operation_count, 
'driver_delicense' => $delicense_driver_count, 
'project_delicense' => $delicense_project_count, 
'visitor_delicense' => $delicense_visitor_count, 
],
        ];
 http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($data);
}
changeTimeAtDateChange();

// time validation 
function changeTimeAtDateChange()
{
     global $connection;

     // Define the default out-time (e.g., end of the day)
     $defaultOutTime = date('Y-m-d 12:12:00', strtotime('-1 day')); // 23:59:59

     // Update query
     $sql = "UPDATE licensegate SET outtime = '$defaultOutTime' WHERE outtime IS NULL AND intime < CURDATE()";
     $res = mysqli_query($connection, $sql);
     if ($res) {

     } else {

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



// function operation counts
function getOperationCount($tablename)
{
     global $connection;
     $count = 0;
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `outtime` IS NULL AND `status` != 9 AND `date` = CURDATE()";
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
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `outtime` IS NULL AND `status` != 9 AND `date` = CURDATE()";
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
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `outtime` IS NULL AND `status` != 9 AND `date` = CURDATE()";
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
     $sql = "SELECT `id`, `section` FROM `$tablename` WHERE `outtime` IS NULL AND `status` != 9 AND `date` = CURDATE()";
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

// total staff in operation section
function totalOperationStaffCount(){
     global $connection;
     $count = 0;
     $sql = "SELECT
     (SELECT COUNT(*) FROM `officer` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `contractor` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `contractor_workman` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `employee` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `gat` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `tat` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `feg` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `sec` WHERE `full_name` IS NOT NULL) AS total_count;
 ";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count = $row['total_count'];
          }
     }
     return $count;     
}

// total staff in driver section
function totalDriverStaffCount(){
     global $connection;
     $count = 0;
     $sql = "SELECT
     (SELECT COUNT(*) FROM `packed` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `bulk` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `transporter` WHERE `full_name` IS NOT NULL) AS total_count;
 ";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count = $row['total_count'];
          }
     }
     return $count;     
}

// totak staff in project section
function totalProjectStaffCount(){
     global $connection;
     $count = 0;
     $sql = "SELECT
     (SELECT COUNT(*) FROM `amc` WHERE `full_name` IS NOT NULL) +
     (SELECT COUNT(*) FROM `workman` WHERE `full_name` IS NOT NULL) AS total_count;
 ";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count = $row['total_count'];
          }
     }
     return $count;     
}

// total staff in visitor section
function totalVisitorStaffCount(){
     global $connection;
     $count = 0;
     // $sql = "SELECT count(*) AS total_count FROM `visitor`";
     $sql = "SELECT COUNT(*) AS total_count FROM `visitor` WHERE `srno` IS NOT NULL";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while($row = mysqli_fetch_assoc($res)){
               $count = $row['total_count'];
          }
     }
     return $count;     
}
?>

