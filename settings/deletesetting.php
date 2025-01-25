<?php

include("../root.php");
header('Content-Type: application/json');
include($config_loc);

$id = $_GET['id'];

$sql = "UPDATE login SET status=0 WHERE id = '$id'";
$res = mysqli_query($connection, $sql);

if ($res) {
    $data = array('message' => "data deleted");
} else {
    $data = array('message' => "data not deleted");
}

echo json_encode($data);

?>   