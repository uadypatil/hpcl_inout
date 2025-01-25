<?php
include('../app/config.php');
// Set the content type to JSON
header('Content-Type: application/json');
$aadhar_no = $_GET['aadhar_no'];

$sqlu="SELECT * FROM `uni_aadhar` WHERE `aadhar_no`='$aadhar_no'";
$resu=mysqli_query($connection,$sqlu);
$rowu = mysqli_fetch_assoc($resu);


if(!empty($rowu) && $rowu['role']=='PW'){
    $sql1="SELECT * FROM `workman` WHERE `aadhar_no`='$aadhar_no'";
    $res1=mysqli_query($connection,$sql1);


    if (mysqli_num_rows($res1) > 0) {
    
        $row1 = mysqli_fetch_assoc($res1);
        $data = array(
            'token_no' => $row1['token_no'],
            'full_name' => $row1['full_name'],
            'mobile_no' => $row1['mobile_no'],
            'address' => $row1['address'],
            'firm_name' => $row1['firm_name'],
            'message' => "data found"

        );
    }
}

else if(!empty($rowu) && $rowu['role']=='AMC'){

    $sql2="SELECT * FROM `amc` WHERE `aadhar_no`='$aadhar_no'";
    $res2=mysqli_query($connection,$sql2);


    if (mysqli_num_rows($res2) > 0) {
    
        $row2 = mysqli_fetch_assoc($res2);
        $data = array(
            'token_no' => $row2['token_no'],
            'full_name' => $row2['full_name'],
            'mobile_no' => $row2['mobile_no'],
            'address' => $row2['address'],
            'firm_name' => $row2['firm_name'],
            'message' => "data found"

        );

    }
}
else{
    $data=array("message"=>"data not found");
}


// Encode the data to JSON format
// echo $data;
$json = json_encode($data);
echo $json;

?>