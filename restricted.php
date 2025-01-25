<?php
include("root.php");
include($config_loc);

$qrcode = $_GET['qr'];
$subdepart = $_GET['dept'];

if(isset($_POST['restricted'])){
    $restricted = $_POST['restricted'];

    $sqlmaingate="SELECT * FROM maingate WHERE `qr_code`='$qrcode' AND `status`='1' ";
    $resmaingate=mysqli_query($connection, $sqlmaingate);
    
    // print_r(mysqli_fetch_assoc($resmaingate));die;
    if(mysqli_num_rows($resmaingate) > 0) {

    $rest_insert = "UPDATE `$subdepart` SET `restricted`='$restricted' WHERE `qr_code`='$qrcode'";
    $rest_insert_result = mysqli_query($connection, $rest_insert);
    
    // Check if the update was successful
    if($rest_insert_result) {
        // Redirect to the main page
        echo "<script>window.history.back();</script>";

        exit; // Make sure to exit after redirecting to prevent further execution
    } else {
        // Handle error if the update failed
        echo "Update failed. Please try again."; // You can display an error message or handle it as per your requirement
    }

    } else {
        // echo "<script>alert('This person already exit in maingate')</script>";
        echo "<script>window.history.back();</script>";
    }
    
}
?>
