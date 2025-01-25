
<?php
include("../root.php");
header('Content-Type: application/json');

// Include config file
include($config_loc);
 
$srno=$_GET['srno'];


    // Perform the database query to check if visitor detail exists
    $query = "SELECT * FROM visitor WHERE srno = '$srno'";
    $result = mysqli_query($connection, $query);

    // Check if any row is returned from the query
    if(mysqli_num_rows($result) > 0) {
        // Visitor detail found
        $visitor = mysqli_fetch_assoc($result);
        $data = array(
            'srno' => $visitor['srno'],
            'full_name' => $visitor['full_name'],
            'token_no' => $visitor['token_no'],
            'aadhar_no' => $visitor['aadhar_no'],
            'date' => $visitor['date'],
            'to_see_whom' => $visitor['to_see_whom'],
            'purpose_to_visit' => $visitor['purpose_to_visit'],
            'mobile_no' => $visitor['mobile_no'],
            'address' => $visitor['address'],
            'time_in' => $visitor['time_in'],
            'time_out' => $visitor['time_out'],
            'photo' => $visitor['photo'],
            'qrpath' => $visitor['qrpath'],
            'message' => "data found");
    } else {
        // No visitor detail found
        $data = array('success' => false, 'message' => "data not found");
    }

// Send JSON response
$json = json_encode($data);
echo $json;

// echo json_encode($response);
?>

