<?php
include("root_api.php");
 include($config_loc);

// Assuming $connection is your database connection object

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query to select reports
    $selectquery = "SELECT `report_id`, `report_gen_time`, `from_date`, `to_date`, `department`, `sub_department`, `name`, `gate` FROM `report`";
//print_r($selectquery);exit;
    // Execute the query
    $result = mysqli_query($connection, $selectquery);

    // Check if the query executed successfully
    if ($result) {
        $reports = array(); // Array to hold report data

        // Fetch each row from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $repo_id = $row['report_id'];

            // Query to select report data
            $selectquery2 = "SELECT `data_id`, `report_id`, `name`, `department`, `sub_department`, `time_in`, `time_out`, `check_in_dt`, `check_out_dt`, `gate_name` FROM `report_data` WHERE `report_id` = '$repo_id'";

            // Execute the query
            $resultData = mysqli_query($connection, $selectquery2);

            // Check if the query executed successfully
            if ($resultData) {
                $reportData = array(); // Array to hold report data

                // Fetch each row from the result set
                while ($rowData = mysqli_fetch_assoc($resultData)) {
                    $rowData['report_id'] = $row['report_id']; // Add report_id to each row of report data
                    $reportData[] = $rowData;
                }

                // Add report details to the report data
                $reportDetails = array(
                    'report_gen_dt' => $row['report_gen_time'],
                    'from_date' => $row['from_date'],
                    'to_date' => $row['to_date'],
                    'department' => $row['department'],
                    'sub_department' => $row['sub_department'],
                    'name' => $row['name'],
                    'gate' => $row['gate']
                );

                // Add report details and report data to reports array
                $reports[] = array_merge($reportDetails, ['report_data' => $reportData]);
            } else {
                // Error occurred while fetching report data
                echo json_encode(array('error' => true, 'message' => 'No data found'));
                exit(); // Exit the script
            }
        }

        // Output JSON response
         http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($reports);
        //echo json_encode(array('status' => 'success', 'reports' => $reports));
    } else {
        // Error occurred while fetching reports
        echo json_encode(array('error' => true, 'message' => 'No data found'));
    }
} else {
    // Invalid request method
    echo json_encode(array('error' => true, 'message' => 'Invalid request method'));
}
?>
