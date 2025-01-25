<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("root.php");

// session_start();

if (!isset($_SESSION['username'])) {
     header("Location: login.php");
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

     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script> -->
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

     <!-- including config file to use database -->
     <?php include($config_loc); ?>

     <style>
          .success-alert {
               display: none;
          }

          .danger-alert {
               display: none;
          }

          @media screen and (max-width: 576px) {
               .card-container {
                    flex-direction: row;
               }
          }
     </style>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.19.0/powerbi.js"></script>


</head>
<?php
// demo qr: OFC/HPNSK/1
// demo qr: BK/HPNSK/2

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
$drivergate_driver_count = driverGateDriverCount($maintable, $licensetable);
$drivergate_project_count = 0;
// $drivergate_project_count = DeLiProjectCount();
$drivergate_visitor_count = 0;
// $drivergate_visitor_count = DeLiVisitorCount();

// counting variables for license gate
$delicense_operation_count = 0;
$delicense_operation_count = DeLiOperationCount();
$delicense_driver_count = 0;
// $delicense_driver_count = DeLiDriverCount();
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


// To display driver count at driver gate
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
function totalOperationStaffCount()
{
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
function totalDriverStaffCount()
{
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
function totalProjectStaffCount()
{
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
function totalVisitorStaffCount()
{
     global $connection;
     $count = 0;
     // $sql = "SELECT count(*) AS total_count FROM `visitor`";
     $sql = "SELECT COUNT(*) AS total_count FROM `visitor` WHERE `srno` IS NOT NULL";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
               $count = $row['total_count'];
          }
     }
     return $count;
}
?>

<body>

     <div class="wrapper d-flex overall-body">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <!-- <div class="main-content"> -->
          <div class="container-fluid">
               <!-- container-fluid -->

               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <!-- container-fluid -->
                    <!-- including content for dashboard -->
                    <?php include("dashboard_content.php"); ?>
                    <!-- <iframe title="SINNAR_dash" class="container-fluid" height="700" id="reportcontainer"
                         src="https://app.powerbi.com/view?r=eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9"
                         frameborder="0" allowFullScreen="true"></iframe> -->
                    <!-- width="1000" height="700"
               </div> 
               <-- // container-fluid ends here -->
               </div> <!-- container-fluid ends -->
               <!-- </div> -->

          </div>
          <!-- refresh code -->

          <script>
               const axios = require('axios');
               const qs = require('qs');

               // Azure AD and Power BI credentials
               const tenantId = 'YOUR_TENANT_ID';
               const clientId = 'YOUR_CLIENT_ID';
               const clientSecret = 'YOUR_CLIENT_SECRET';
               const datasetId = 'YOUR_DATASET_ID';

               async function getAccessToken() {
                    const tokenResponse = await axios.post(`https://login.microsoftonline.com/${tenantId}/oauth2/v2.0/token`, qs.stringify({
                         grant_type: 'client_credentials',
                         client_id: clientId,
                         client_secret: clientSecret,
                         scope: 'https://analysis.windows.net/powerbi/api/.default'
                    }), {
                         headers: {
                              'Content-Type': 'application/x-www-form-urlencoded'
                         }
                    });

                    return tokenResponse.data.access_token;
               }

               async function refreshDataset() {
                    const accessToken = await getAccessToken();

                    await axios.post(`https://api.powerbi.com/v1.0/myorg/datasets/${datasetId}/refreshes`, null, {
                         headers: {
                              'Authorization': `Bearer ${accessToken}`
                         }
                    });

                    console.log('Dataset refresh triggered successfully.');
               }

               // Trigger dataset refresh (you can call this function from an endpoint)
               refreshDataset().catch(console.error);

          </script>


          <!-- <script>
               document.addEventListener("DOMContentLoaded", function () {
                    var reportContainer = document.getElementById("reportcontainer");
                    var embedUrl = "https://app.powerbi.com/view?r=eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9"; // Make sure to assign a valid URL
                    var embedToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCIsImtpZCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCJ9.eyJhdWQiOiJodHRwczovL2FuYWx5c2lzLndpbmRvd3MubmV0L3Bvd2VyYmkvYXBpIiwiaXNzIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvNzRkNzhhODgtNWMxNC00NGJiLWIzYzgtNDFiNGZkZWFjNmQxLyIsImlhdCI6MTcxODYxOTY3OCwibmJmIjoxNzE4NjE5Njc4LCJleHAiOjE3MTg2MjM1NzgsImFpbyI6IkUyZGdZUGpyYVdBbVlLVjFRdHpXS1ZLZ1JFSUpBQT09IiwiYXBwaWQiOiI0YTlhMzc3Yy1kYjIzLTQ5YzUtODE4ZC1hNjU1Y2YxNzBlZmUiLCJhcHBpZGFjciI6IjEiLCJpZHAiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC83NGQ3OGE4OC01YzE0LTQ0YmItYjNjOC00MWI0ZmRlYWM2ZDEvIiwiaWR0eXAiOiJhcHAiLCJvaWQiOiJlY2U2NmEzMi00MWM0LTQxYjctYTA4Zi0zMWMwYWE0MzY4MmYiLCJyaCI6IjAuQVNzQWlJclhkQlJjdTBTenlFRzBfZXJHMFFrQUFBQUFBQUFBd0FBQUFBQUFBQURDQUFBLiIsInJvbGVzIjpbIlRlbmFudC5SZWFkV3JpdGUuQWxsIiwiVGVuYW50LlJlYWQuQWxsIl0sInN1YiI6ImVjZTY2YTMyLTQxYzQtNDFiNy1hMDhmLTMxYzBhYTQzNjgyZiIsInRpZCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSIsInV0aSI6IkNiaWd6Q19PRGtlM2VZMFF4QjVRQUEiLCJ2ZXIiOiIxLjAiLCJ4bXNfaWRyZWwiOiI3IDE4In0.QLEFhg9cgfjUzXQQkQMJ0NoI6Lya7zP1VY4_FZStOQpGBp4qcv57qFMxoLZE0pr9Q2mtdXRtg-02BJ_wrRcRkChNeZJwCcVxXuyL24zf9d9jZE-vA_Dv-3qqTy_N_wYv8DfOBGVIdZi1D1JM5_pJHs8bpdMCpdkinCwqw5-YgJnojQNdkdQrft-MER0gLT5GpBj7Zl2rphqzi0OJtJJAtPex00V7nIo9drrNfM7UPCWcziQq4bEm2XuQNMbB-ObsglJSvchhuIX1z4XUeTyxsmbMa0PEjHzxc7U671ndQCzTox1SdXh1Temq7TVPLtZB-U4yvyRlgTAyxhdJExgoyQ";
                    var report_id = "eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9";
                    var models = window['powerbi-client'].models;
                    var config = {
                         type: 'report',
                         id: report_id,
                         embedUrl: embedUrl,
                         accessToken: embedToken,
                         tokenType: models.TokenType.Embed,
                         settings: {
                              filterPaneEnabled: false,
                              navContentPaneEnabled: false
                         }
                    };

                    var powerbi = window['powerbi'];
                    var report = powerbi.embed(reportContainer, config);

                    setInterval(function () {
                         report.refresh();
                    }, 1000);
               });
          </script> -->


          <!-- <script>
               var reportContainer = document.getElementById("reportcontainer");
               var embedUrl = "https://app.powerbi.com/view?r=eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9"; // Make sure to assign a valid URL
               var embedToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCIsImtpZCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCJ9.eyJhdWQiOiJodHRwczovL2FuYWx5c2lzLndpbmRvd3MubmV0L3Bvd2VyYmkvYXBpIiwiaXNzIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvNzRkNzhhODgtNWMxNC00NGJiLWIzYzgtNDFiNGZkZWFjNmQxLyIsImlhdCI6MTcxODYxOTY3OCwibmJmIjoxNzE4NjE5Njc4LCJleHAiOjE3MTg2MjM1NzgsImFpbyI6IkUyZGdZUGpyYVdBbVlLVjFRdHpXS1ZLZ1JFSUpBQT09IiwiYXBwaWQiOiI0YTlhMzc3Yy1kYjIzLTQ5YzUtODE4ZC1hNjU1Y2YxNzBlZmUiLCJhcHBpZGFjciI6IjEiLCJpZHAiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC83NGQ3OGE4OC01YzE0LTQ0YmItYjNjOC00MWI0ZmRlYWM2ZDEvIiwiaWR0eXAiOiJhcHAiLCJvaWQiOiJlY2U2NmEzMi00MWM0LTQxYjctYTA4Zi0zMWMwYWE0MzY4MmYiLCJyaCI6IjAuQVNzQWlJclhkQlJjdTBTenlFRzBfZXJHMFFrQUFBQUFBQUFBd0FBQUFBQUFBQURDQUFBLiIsInJvbGVzIjpbIlRlbmFudC5SZWFkV3JpdGUuQWxsIiwiVGVuYW50LlJlYWQuQWxsIl0sInN1YiI6ImVjZTY2YTMyLTQxYzQtNDFiNy1hMDhmLTMxYzBhYTQzNjgyZiIsInRpZCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSIsInV0aSI6IkNiaWd6Q19PRGtlM2VZMFF4QjVRQUEiLCJ2ZXIiOiIxLjAiLCJ4bXNfaWRyZWwiOiI3IDE4In0.QLEFhg9cgfjUzXQQkQMJ0NoI6Lya7zP1VY4_FZStOQpGBp4qcv57qFMxoLZE0pr9Q2mtdXRtg-02BJ_wrRcRkChNeZJwCcVxXuyL24zf9d9jZE-vA_Dv-3qqTy_N_wYv8DfOBGVIdZi1D1JM5_pJHs8bpdMCpdkinCwqw5-YgJnojQNdkdQrft-MER0gLT5GpBj7Zl2rphqzi0OJtJJAtPex00V7nIo9drrNfM7UPCWcziQq4bEm2XuQNMbB-ObsglJSvchhuIX1z4XUeTyxsmbMa0PEjHzxc7U671ndQCzTox1SdXh1Temq7TVPLtZB-U4yvyRlgTAyxhdJExgoyQ";
               var report_id = "eyJrIjoiYWFhY2E1ODEtNTRkMS00ZGMwLWE3MDktMzE5NjM4ZjZjODZmIiwidCI6Ijc0ZDc4YTg4LTVjMTQtNDRiYi1iM2M4LTQxYjRmZGVhYzZkMSJ9";
               var models = window['powerbi-client'].models;
               var config = {
                    type: 'report',
                    id: report_id,
                    embedUrl: embedUrl,
                    accessToken: embedToken,
                    tokenType: models.TokenType.Embed,
                    settings: {
                         filterPaneEnabled: false,
                         navContentPaneEnabled: false
                    }
               };

               var powerbi = window['powerbi'];
               var report = powerbi.embed(reportContainer, config);

               setInterval(function () {
                    report.refresh();
               }, 1000);
          </script> -->


          <script>
               document.getElementById('page-title').innerHTML = "HPCL INOUT | Dashboard";
               document.getElementById('navbar-title').innerHTML = "Dashboard <i class='fas fa-home'></i>";
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
          <!-- Custom JavaScript -->
          <script>
          // $(document).ready(function () {
          //      $('.sidebar-link').on('click', function () {
          //           // Close all open dropdowns
          //           $('.collapse.show').collapse('hide');
          //      });
          // });

          // $(document).ready(function () {
          //      $('.collapse.show').on('click', function () {
          //           // Close all open dropdowns
          //           $('.collapse.show').collapse('hide');
          //      });
          // });
          </script>

          <?php
          // reset all records for gates
          if (isset($_POST['reset-btn'])) {
               $pass = md5($_POST['reset-pass']);
               $sql = "SELECT `password` FROM `reset_pass` WHERE `id` = 1";
               $result = mysqli_query($connection, $sql);
               if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                         if ($pass == $row['password']) {

                              $sql = "UPDATE `maingate`
               SET `outtime` = CURRENT_TIMESTAMP(), `status` = 0
               WHERE `date` = CURDATE();
               UPDATE `licensegate`
               SET `outtime` = CURRENT_TIMESTAMP(), `status` = 0
               WHERE `date` = CURDATE();
               ";
                              $res = mysqli_multi_query($connection, $sql);
                              if ($res) {
                                   echo "<script>alert('Record updated')</script>";
                                   echo "<script>document.getElementById('success-alert').style.display = 'block'</script>";
                                   echo "<script>document.getElementById('alert-msg-success').innerHTML = 'Records reset successful.'</script>";
                                   echo "<script>window.location.replace('dashboard.php');</script>";
                              } else {
                                   echo "<script>alert('Records resetss failed')</script>";
                              }
                         }
                    }
               } else {
                    echo "<script>document.getElementById('danger-alert').style.display = 'block'</script>";
                    echo "<script>document.getElementById('alert-msg-danger').innerHTML = 'Password not matched'</script>";
               }
          }
          // reset gates records ends
          ?>
</body>

</html>