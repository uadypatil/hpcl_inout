<?php
    include('../app/config.php');
    // Set the content type to JSON
header('Content-Type: application/json');
    $aadhar_no = $_GET['aadhar_no'];

    $sqlu="SELECT * FROM `uni_aadhar` WHERE `aadhar_no`='$aadhar_no'";
    $resu=mysqli_query($connection,$sqlu);

    $rowu = mysqli_fetch_assoc($resu);


    if(!empty($rowu) && $rowu['role']=='VR'){
    

        $sql1="SELECT * FROM `visitor` WHERE `aadhar_no`='$aadhar_no'";
        $res1=mysqli_query($connection,$sql1);
 

        if (mysqli_num_rows($res1) > 0) {
        
            $row1 = mysqli_fetch_assoc($res1);
        
            $data = array(
                'token_no' => $row1['token_no'],
                'full_name' => $row1['full_name'],
                'mobile_no' => $row1['mobile_no'],
                'address' => $row1['address'],
                'to_see_whom' => $row1['to_see_whom'],
                'purpose_to_visit' => $row1['purpose_to_visit'],
                'is_regular' => $row1['is_regular'],
                'photo' => $row1['photo'],
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