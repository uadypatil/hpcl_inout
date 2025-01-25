<?php
    include('../app/config.php');
    // Set the content type to JSON
header('Content-Type: application/json');
    $aadhar_no = $_GET['aadhar_no'];

    $sqlu="SELECT * FROM `uni_aadhar` WHERE `aadhar_no`='$aadhar_no'";
    $resu=mysqli_query($connection,$sqlu);

    $rowu = mysqli_fetch_assoc($resu);


    if(!empty($rowu) && $rowu['role']=='PT'){
    

        $sql1="SELECT * FROM `packed` WHERE `aadhar_no`='$aadhar_no'";
        $res1=mysqli_query($connection,$sql1);
 

        if (mysqli_num_rows($res1) > 0) {
        
            $row1 = mysqli_fetch_assoc($res1);
        
            $data = array(
                'token_no' => $row1['token_no'],
                'full_name' => $row1['full_name'],
                'mobile_no' => $row1['mobile_no'],
                'address' => $row1['address'],
                'firm_name' => $row1['firm_name'],
                'truck_no' => $row1['truck_no'],
                'message' => "data found"



            );

        }
    }

    else if(!empty($rowu) && $rowu['role']=='BK'){

        $sql2="SELECT * FROM `bulk` WHERE `aadhar_no`='$aadhar_no'";
        $res2=mysqli_query($connection,$sql2);


        if (mysqli_num_rows($res2) > 0) {
        
            $row2 = mysqli_fetch_assoc($res2);
            $data = array(
                'token_no' => $row2['token_no'],
                'full_name' => $row2['full_name'],
                'mobile_no' => $row2['mobile_no'],
                'address' => $row2['address'],
                'firm_name' => $row2['firm_name'],
                'truck_no' => $row2['truck_no'],
                'message' => "data found"



            );

        }
    }

    else if(!empty($rowu) && $rowu['role']=='TR'){

        $sql3="SELECT * FROM `transporter` WHERE `aadhar_no`='$aadhar_no'";
        $res3=mysqli_query($connection,$sql3);


        if (mysqli_num_rows($res3) > 0) {
        
            $row3 = mysqli_fetch_assoc($res3);
            $data = array(
                'token_no' => $row3['token_no'],
                'full_name' => $row3['full_name'],
                'mobile_no' => $row3['mobile_no'],
                'address' => $row3['address'],
                'firm_name' => $row3['firm_name'],
                'truck_no' => $row3['truck_no'],
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