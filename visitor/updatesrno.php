<?php
// Retrieve token and SrNo values from the POST request body

$token = $_POST['token'];
$srNo = $_POST['srNo'];

// Perform database update
// Replace this with your actual database connection and update logic

$updateSql = "UPDATE `visitor` SET `srno` = '$srNo' WHERE `token_no` = '$token'";
$updateResult = mysqli_query($connection, $updateSql);

if ($updateResult) {
    // Respond with success message
    echo json_encode(array('success' => true));
} else {
    // Respond with error message
    echo json_encode(array('success' => false, 'error' => mysqli_error($connection)));
}

// Close database connection
?>
