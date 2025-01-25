<?php
$dept = [];

if (isset($_GET['type']) && isset($_GET['gate'])) {
    $department = $_GET['type'];
    $gate = $_GET['gate'];



    if ($department == 'operation' && $gate == 'main') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `maingate`.`intime` FROM `officer` INNER JOIN `maingate` ON `officer`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `maingate`.`intime` FROM `employee` INNER JOIN `maingate` ON `employee`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `maingate`.`intime` FROM `contractor` INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `maingate`.`intime` FROM `contractor_workman` INNER JOIN `maingate` ON `contractor_workman`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `maingate`.`intime` FROM `gat` INNER JOIN `maingate` ON `gat`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `maingate`.`intime` FROM `tat` INNER JOIN `maingate` ON `tat`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `maingate`.`intime` FROM `feg` INNER JOIN `maingate` ON `feg`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `maingate`.`intime` FROM `sec` INNER JOIN `maingate` ON `sec`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Officer', 'Employee', 'Contractor', 'Contractor_Workman', 'Gat', 'Tat', 'Feg', 'Sec'];
    } elseif ($department == 'driver' && $gate == 'main') {
        $sql = "SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `maingate`.`intime` FROM `packed` INNER JOIN `maingate` ON `packed`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL AND `maingate`.`date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `maingate`.`intime` FROM `bulk` INNER JOIN `maingate` ON `bulk`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `maingate`.`date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `maingate`.`intime` FROM `transporter` INNER JOIN `maingate` ON `transporter`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `maingate`.`date` = CURDATE()
     ";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Packed', 'Bulk', 'Workman'];

    } elseif ($department == 'project' && $gate == 'main') {

        $sql = "SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `maingate`.`intime` FROM `workman` INNER JOIN `maingate` ON `workman`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `maingate`.`intime` FROM `amc` INNER JOIN `maingate` ON `amc`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Workman', 'AMC'];

    } elseif ($department == 'visitor' && $gate == 'main') {
        $sql = "SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `maingate`.`intime` FROM `visitor` INNER JOIN `maingate` ON `visitor`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `maingate`.`date` = CURDATE()";
        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Visitor'];

    } elseif ($department == 'total' && $gate == 'main') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `maingate`.`intime` FROM `officer` INNER JOIN `maingate` ON `officer`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `maingate`.`intime` FROM `employee` INNER JOIN `maingate` ON `employee`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `maingate`.`intime` FROM `contractor` INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `maingate`.`intime` FROM `contractor_workman` INNER JOIN `maingate` ON `contractor_workman`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `maingate`.`intime` FROM `gat` INNER JOIN `maingate` ON `gat`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `maingate`.`intime` FROM `tat` INNER JOIN `maingate` ON `tat`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `maingate`.`intime` FROM `feg` INNER JOIN `maingate` ON `feg`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `maingate`.`intime` FROM `sec` INNER JOIN `maingate` ON `sec`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `maingate`.`intime` FROM `packed` INNER JOIN `maingate` ON `packed`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `maingate`.`intime` FROM `bulk` INNER JOIN `maingate` ON `bulk`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `maingate`.`intime` FROM `transporter` INNER JOIN `maingate` ON `transporter`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `maingate`.`intime` FROM `workman` INNER JOIN `maingate` ON `workman`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `maingate`.`intime` FROM `amc` INNER JOIN `maingate` ON `amc`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `maingate`.`intime` FROM `visitor` INNER JOIN `maingate` ON `visitor`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

    } elseif ($department == 'operation' && $gate == 'license') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `licensegate`.`intime` FROM `officer` INNER JOIN `licensegate` ON `officer`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `licensegate`.`intime` FROM `employee` INNER JOIN `licensegate` ON `employee`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `licensegate`.`intime` FROM `contractor` INNER JOIN `licensegate` ON `contractor`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `licensegate`.`intime` FROM `contractor_workman` INNER JOIN `licensegate` ON `contractor_workman`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `licensegate`.`intime` FROM `gat` INNER JOIN `licensegate` ON `gat`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `licensegate`.`intime` FROM `tat` INNER JOIN `licensegate` ON `tat`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `licensegate`.`intime` FROM `feg` INNER JOIN `licensegate` ON `feg`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `licensegate`.`intime` FROM `sec` INNER JOIN `licensegate` ON `sec`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Officer', 'Employee', 'Contractor', 'Contractor_workman', 'Gat', 'Tat', 'Feg', 'Sec'];
    } elseif ($department == 'driver' && $gate == 'license') {

        $sql = "SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `licensegate`.`intime` FROM `packed` INNER JOIN `licensegate` ON `packed`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `licensegate`.`date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `licensegate`.`intime` FROM `bulk` INNER JOIN `licensegate` ON `bulk`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `licensegate`.`date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `licensegate`.`intime` FROM `transporter` INNER JOIN `licensegate` ON `transporter`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `licensegate`.`date` = CURDATE()
     ";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Packed', 'Bulk', 'Workman'];

    } elseif ($department == 'project' && $gate == 'license') {

        $sql = "SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `licensegate`.`intime` FROM `workman` INNER JOIN `licensegate` ON `workman`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `licensegate`.`intime` FROM `amc` INNER JOIN `licensegate` ON `amc`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Workman', 'AMC'];

    } elseif ($department == 'visitor' && $gate == 'license') {

        $sql = "SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `licensegate`.`intime` FROM `visitor` INNER JOIN `licensegate` ON `visitor`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `licensegate`.`date` = CURDATE()";
        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Visitor'];

    } elseif ($department == 'total' && $gate == 'license') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `licensegate`.`intime` FROM `officer` INNER JOIN `licensegate` ON `officer`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `licensegate`.`intime` FROM `employee` INNER JOIN `licensegate` ON `employee`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `licensegate`.`intime` FROM `contractor` INNER JOIN `licensegate` ON `contractor`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `licensegate`.`intime` FROM `contractor_workman` INNER JOIN `licensegate` ON `contractor_workman`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `licensegate`.`intime` FROM `gat` INNER JOIN `licensegate` ON `gat`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `licensegate`.`intime` FROM `tat` INNER JOIN `licensegate` ON `tat`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `licensegate`.`intime` FROM `feg` INNER JOIN `licensegate` ON `feg`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `licensegate`.`intime` FROM `sec` INNER JOIN `licensegate` ON `sec`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `licensegate`.`intime` FROM `packed` INNER JOIN `licensegate` ON `packed`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `licensegate`.`intime` FROM `bulk` INNER JOIN `licensegate` ON `bulk`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `licensegate`.`intime` FROM `transporter` INNER JOIN `licensegate` ON `transporter`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `licensegate`.`intime` FROM `workman` INNER JOIN `licensegate` ON `workman`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `licensegate`.`intime` FROM `amc` INNER JOIN `licensegate` ON `amc`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `licensegate`.`intime` FROM `visitor` INNER JOIN `licensegate` ON `visitor`.`qr_code` = `licensegate`.`qr_code` WHERE licensegate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

    } elseif ($department == 'operation' && $gate == 'driver') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `drivergate`.`intime` FROM `officer` INNER JOIN `drivergate` ON `officer`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `drivergate`.`intime` FROM `employee` INNER JOIN `drivergate` ON `employee`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `drivergate`.`intime` FROM `contractor` INNER JOIN `drivergate` ON `contractor`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `drivergate`.`intime` FROM `contractor_workman` INNER JOIN `drivergate` ON `contractor_workman`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `drivergate`.`intime` FROM `gat` INNER JOIN `drivergate` ON `gat`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `drivergate`.`intime` FROM `tat` INNER JOIN `drivergate` ON `tat`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `drivergate`.`intime` FROM `feg` INNER JOIN `drivergate` ON `feg`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `drivergate`.`intime` FROM `sec` INNER JOIN `drivergate` ON `sec`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Officer', 'Employee', 'Contractor', 'Contractor_workman', 'Gat', 'Tat', 'Feg', 'Sec'];
    } elseif ($department == 'driver' && $gate == 'driver') {

        $sql = "SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `maingate`.`intime` FROM `packed` INNER JOIN `maingate` ON `packed`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND maingate.`date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `maingate`.`intime` FROM `bulk` INNER JOIN `maingate` ON `bulk`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND maingate.`date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `maingate`.`intime` FROM `transporter` INNER JOIN `maingate` ON `transporter`.`qr_code` = `maingate`.`qr_code` WHERE maingate.outtime IS NULL  AND maingate.`date` = CURDATE()";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Packed', 'Bulk', 'Workman'];

    } elseif ($department == 'project' && $gate == 'driver') {

        $sql = "SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `drivergate`.`intime` FROM `workman` INNER JOIN `drivergate` ON `workman`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `drivergate`.`intime` FROM `amc` INNER JOIN `drivergate` ON `amc`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()";

        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Workman', 'AMC'];

    } elseif ($department == 'visitor' && $gate == 'driver') {

        $sql = "SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `drivergate`.`intime` FROM `visitor` INNER JOIN `drivergate` ON `visitor`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND drivergate.`date` = CURDATE()";
        $res = mysqli_query($connection, $sql);
        $dept = ['All', 'Visitor'];

    } elseif ($department == 'total' && $gate == 'driver') {

        $sql = "SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `drivergate`.`intime` FROM `officer` INNER JOIN `drivergate` ON `officer`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `drivergate`.`intime` FROM `employee` INNER JOIN `drivergate` ON `employee`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `drivergate`.`intime` FROM `contractor` INNER JOIN `drivergate` ON `contractor`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `drivergate`.`intime` FROM `contractor_workman` INNER JOIN `drivergate` ON `contractor_workman`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `drivergate`.`intime` FROM `gat` INNER JOIN `drivergate` ON `gat`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `drivergate`.`intime` FROM `tat` INNER JOIN `drivergate` ON `tat`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `drivergate`.`intime` FROM `feg` INNER JOIN `drivergate` ON `feg`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `drivergate`.`intime` FROM `sec` INNER JOIN `drivergate` ON `sec`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `drivergate`.`intime` FROM `packed` INNER JOIN `drivergate` ON `packed`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `drivergate`.`intime` FROM `bulk` INNER JOIN `drivergate` ON `bulk`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `drivergate`.`intime` FROM `transporter` INNER JOIN `drivergate` ON `transporter`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `drivergate`.`intime` FROM `workman` INNER JOIN `drivergate` ON `workman`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `drivergate`.`intime` FROM `amc` INNER JOIN `drivergate` ON `amc`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()
     UNION SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `drivergate`.`intime` FROM `visitor` INNER JOIN `drivergate` ON `visitor`.`qr_code` = `drivergate`.`qr_code` WHERE drivergate.outtime IS NULL  AND `date` = CURDATE()";

        $res = mysqli_query($connection, $sql);

    }
    // if delicense gate
    elseif ($department == 'operation' && $gate == 'delicense') {


        $sql = "SELECT 
        `qr_code`,
        `full_name`,
        `working_as`,
        `intime`
    FROM 
        (
            SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `maingate`.`intime` 
            FROM `officer` 
            INNER JOIN `maingate` ON `officer`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `officer`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `maingate`.`intime` 
            FROM `employee`
            INNER JOIN `maingate` ON `employee`.`qr_code` = `maingate`.`qr_code`
            WHERE `employee`.`qr_code` NOT IN (
                SELECT `qr_code` 
                FROM `licensegate` 
                WHERE `licensegate`.`date` = CURDATE() 
                  AND `licensegate`.`status` = 0
            )
            AND `employee`.`qr_code` IN (
                SELECT `qr_code` 
                FROM `maingate` 
                WHERE `maingate`.`date` = CURDATE() 
                  AND `maingate`.`status` = 1
            )
    
            UNION 
            
            SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `maingate`.`intime` 
            FROM `contractor`
            INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `contractor`.`qr_code` = `licensegate`.`qr_code`
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `maingate`.`intime` 
            FROM `contractor_workman` 
            INNER JOIN `maingate` ON `contractor_workman`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `contractor_workman`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `maingate`.`intime` 
            FROM `gat` 
            INNER JOIN `maingate` ON `gat`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `gat`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `maingate`.`intime` 
            FROM `tat` 
            INNER JOIN `maingate` ON `tat`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `tat`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `maingate`.`intime` 
            FROM `feg` 
            INNER JOIN `maingate` ON `feg`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `feg`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
            
            UNION 
            
            SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `maingate`.`intime` 
            FROM `sec` 
            INNER JOIN `maingate` ON `sec`.`qr_code` = `maingate`.`qr_code` 
            INNER JOIN `licensegate` ON `sec`.`qr_code` = `licensegate`.`qr_code` 
            WHERE `maingate`.`outtime` IS NULL 
              AND `maingate`.`date` = CURDATE() 
              AND `licensegate`.`status` != 1
        ) AS combined_results;";
        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Officer', 'Employee', 'Contractor', 'Contractor_workman', 'Gat', 'Tat', 'Feg', 'Sec'];
    } elseif ($department == 'driver' && $gate == 'delicense') {

        $sql = "SELECT 
     `qr_code`,
     `full_name`,
     `working_as`,
     `intime`
 FROM 
     (
         SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `maingate`.`intime` 
         FROM `packed` 
         INNER JOIN `maingate` ON `packed`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE()
         
         UNION 
         
         SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `maingate`.`intime` 
         FROM `bulk` 
         INNER JOIN `maingate` ON `bulk`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE()
         
         UNION 
         
         SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `maingate`.`intime` 
         FROM `transporter` 
         INNER JOIN `maingate` ON `transporter`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE()
     ) AS combined_results;
 ";
        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Packed', 'Bulk', 'Workman'];

    } elseif ($department == 'project' && $gate == 'delicense') {

        $sql = "SELECT 
     `qr_code`,
     `full_name`,
     `working_as`,
     `intime`
 FROM 
     (
         SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `maingate`.`intime` 
         FROM `workman` 
         INNER JOIN `maingate` ON `workman`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE()
         
         UNION 
         
         SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `maingate`.`intime` 
         FROM `amc` 
         INNER JOIN `maingate` ON `amc`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE()
     ) AS combined_results
 ";
        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Workman', 'AMC'];

    } elseif ($department == 'visitor' && $gate == 'delicense') {

        $sql = "SELECT 
    `visitor`.`qr_code`,
    `visitor`.`full_name`,
    `visitor`.`working_as`,
    `maingate`.`intime` 
FROM 
    `visitor` 
INNER JOIN 
    `maingate` 
ON 
    `visitor`.`qr_code` = `maingate`.`qr_code` 
INNER JOIN
    `licensegate`
ON
    `visitor`.`qr_code` = `licensegate`.`qr_code`
WHERE 
    `maingate`.`outtime` IS NULL  AND `maingate`.`date` = CURDATE() 
AND
    `licensegate`.`status` != 1
";
        $res = mysqli_query($connection, $sql);

        $dept = ['All', 'Visitor'];

    } elseif ($department == 'total' && $gate == 'delicense') {

        $sql = "SELECT 
     `qr_code`,
     `full_name`,
     `working_as`,
     `intime`
 FROM 
     (
         SELECT `officer`.`qr_code`, `officer`.`full_name`, `officer`.`working_as`, `maingate`.`intime` 
         FROM `officer` 
         INNER JOIN `maingate` ON `officer`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `employee`.`qr_code`, `employee`.`full_name`, `employee`.`working_as`, `maingate`.`intime` 
         FROM `employee` 
         INNER JOIN `maingate` ON `employee`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `contractor`.`qr_code`, `contractor`.`full_name`, `contractor`.`working_as`, `maingate`.`intime` 
         FROM `contractor` 
         INNER JOIN `maingate` ON `contractor`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `contractor_workman`.`qr_code`, `contractor_workman`.`full_name`, `contractor_workman`.`working_as`, `maingate`.`intime` 
         FROM `contractor_workman` 
         INNER JOIN `maingate` ON `contractor_workman`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `gat`.`qr_code`, `gat`.`full_name`, `gat`.`working_as`, `maingate`.`intime` 
         FROM `gat` 
         INNER JOIN `maingate` ON `gat`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `tat`.`qr_code`, `tat`.`full_name`, `tat`.`working_as`, `maingate`.`intime` 
         FROM `tat` 
         INNER JOIN `maingate` ON `tat`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `feg`.`qr_code`, `feg`.`full_name`, `feg`.`working_as`, `maingate`.`intime` 
         FROM `feg` 
         INNER JOIN `maingate` ON `feg`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `sec`.`qr_code`, `sec`.`full_name`, `sec`.`working_as`, `maingate`.`intime` 
         FROM `sec` 
         INNER JOIN `maingate` ON `sec`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `packed`.`qr_code`, `packed`.`full_name`, `packed`.`working_as`, `maingate`.`intime` 
         FROM `packed` 
         INNER JOIN `maingate` ON `packed`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `bulk`.`qr_code`, `bulk`.`full_name`, `bulk`.`working_as`, `maingate`.`intime` 
         FROM `bulk` 
         INNER JOIN `maingate` ON `bulk`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `transporter`.`qr_code`, `transporter`.`full_name`, `transporter`.`working_as`, `maingate`.`intime` 
         FROM `transporter` 
         INNER JOIN `maingate` ON `transporter`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `workman`.`qr_code`, `workman`.`full_name`, `workman`.`working_as`, `maingate`.`intime` 
         FROM `workman` 
         INNER JOIN `maingate` ON `workman`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `amc`.`qr_code`, `amc`.`full_name`, `amc`.`working_as`, `maingate`.`intime` 
         FROM `amc` 
         INNER JOIN `maingate` ON `amc`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
         
         UNION 
         
         SELECT `visitor`.`qr_code`, `visitor`.`full_name`, `visitor`.`working_as`, `maingate`.`intime` 
         FROM `visitor` 
         INNER JOIN `maingate` ON `visitor`.`qr_code` = `maingate`.`qr_code` 
         WHERE `maingate`.`outtime` IS NULL  AND `date` = CURDATE()
     ) AS combined_results";

        $res = mysqli_query($connection, $sql);

    }


}

?>
<!-- 
<div class="col m-2">
     <button class="btn btn-outline-primary active">All</button>
</div> -->
<?php

for ($i = 0; $i < sizeof($dept); $i++) {
    ?>
    <div class="m-2">
        <button class="btn btn-outline-primary border-primary fs-4 fw-bolder"
            onclick="searchfun('<?php echo $dept[$i]; ?>')">
            <?php echo $dept[$i]; ?>
        </button>
    </div>
    <?php
}
?>