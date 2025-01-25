<?php
include("../root.php");
header('Content-Type: application/json');

date_default_timezone_set('Asia/Kolkata'); // Set the time zone to Indian Standard Time

// Include config file
include($config_loc);

// Check if token and srno are set in the GET request
if(isset($_GET['token']) && isset($_GET['srno'])) {
    $token = $_GET['token'];
    $srno = $_GET['srno'];
    $intime = date('H:i:s');


    // Perform database operations
    $sql = "SELECT * FROM visitor WHERE `token_no`='$token'";
    $res = mysqli_query($connection, $sql);

    // Check if query executed successfully
    if($res) {
        // Fetch the row
        $row = mysqli_fetch_assoc($res);
        
        // Check if a row was returned
        if($row) {
            $aadhar = $row['aadhar_no'];

            // Insert srno into srno table
            $updateSql = "INSERT INTO `srno`(`srno`,`aadhar`) VALUES ('$srno','$aadhar')";     
            $updateResult = mysqli_query($connection, $updateSql);

            // Update srno in visitor table
            $query = "UPDATE `visitor` SET `srno`='$srno',`time_in`='$intime' WHERE `token_no`='$token'";
            $result = mysqli_query($connection, $query);

            if($result) {
                // Data sent successfully
                $data = array('success' => true, 'message' => "Data sent");
            } else {
                // Failed to update data
                $data = array('success' => false, 'message' => "Failed to send data");
            }
        } else {
            // No visitor detail found for the given token
            $data = array('success' => false, 'message' => "Visitor detail not found for the given token");
        }
    } else {
        // Query execution failed
        $data = array('success' => false, 'message' => "Database query failed");
    }
} else {
    // Token or SrNo is missing in the request
    $data = array('success' => false, 'message' => "Token or SrNo is missing");
}

// Send JSON response
echo json_encode($data);
?>
