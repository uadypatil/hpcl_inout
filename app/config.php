
<?php
// database conenctivity code
$server = "localhost";  
$user = "u242460058_Hpcl_InOutDemo";
$password = "sX0^yJuv";
$database_name = "u242460058_Hpcl_InOutDemo";

// $server = "localhost";  
// $user = "root";
// $password = "";
// $database_name = "hpcl_in_out";

// creating connection
$connection = mysqli_connect($server,$user,$password,$database_name);
if(!$connection){    // if connection not created
     die("Failed to connect");
}

// session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
//}
?>