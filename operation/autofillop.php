
<?php
include('../app/config.php');

    // Set the content type to JSON
header('Content-Type: application/json');

$aadhar_no = $_GET['aadhar_no'];
// console.log(aadhar_no);
//echo "hello";die;


$sqlu="SELECT * FROM `uni_aadhar` WHERE `aadhar_no`='$aadhar_no'";
$resu=mysqli_query($connection,$sqlu);

    $rowu = mysqli_fetch_assoc($resu);

    if(!empty($rowu) && $rowu['role']=='OFC'){
        $sql1="SELECT * FROM `officer` WHERE `aadhar_no`='$aadhar_no'";
        $res1=mysqli_query($connection,$sql1);


        if(mysqli_num_rows($res1) > 0) {
        
            $row1 = mysqli_fetch_assoc($res1);
            // echo $row1['token_no'];
            // echo $row1['full_name'];
            // echo $row1['mobile_no'];
            // echo $row1['address'];
            // Sample data
            $data = array(
                'token_no' => $row1['token_no'],
                'full_name' => $row1['full_name'],
                'mobile_no' => $row1['mobile_no'],
                'address' => $row1['address'],
                'message' => "data found"


            );


        }
    }else if(!empty($rowu) && $rowu['role']=='EMP'){
        $sql2="SELECT * FROM `employee` WHERE `aadhar_no`='$aadhar_no'";
        $res2=mysqli_query($connection,$sql2);


        if (mysqli_num_rows($res2) > 0) {
        
            $row2 = mysqli_fetch_assoc($res2);
            // echo $row2['token_no'];
            // echo $row2['full_name'];
            // echo $row2['mobile_no'];
            // echo $row2['address'];

            // Sample data
            $data = array(
                'token_no' => $row2['token_no'],
                'full_name' => $row2['full_name'],
                'mobile_no' => $row2['mobile_no'],
                'address' => $row2['address'],
                'message' => "data found"


            );


        }
    }else if(!empty($rowu) &&  $rowu['role']=='CON'){
        $sql3="SELECT * FROM `contractor` WHERE `aadhar_no`='$aadhar_no'";
        $res3=mysqli_query($connection,$sql3);


        if (mysqli_num_rows($res3) > 0) {
        
            $row3 = mysqli_fetch_assoc($res3);
            // echo $row3['token_no'];
            // echo $row3['full_name'];
            // echo $row3['mobile_no'];
            // echo $row3['address'];
            // echo $row3['firm_name'];

            // Sample data
            $data = array(
                'token_no' => $row3['token_no'],
                'full_name' => $row3['full_name'],
                'mobile_no' => $row3['mobile_no'],
                'address' => $row3['address'],
                'firm_name' => $row3['firm_name'],
                'message' => "data found"


            );
        }
    }else if(!empty($rowu) &&  $rowu['role']=='CONW'){
        $sql4="SELECT * FROM `contractor_workman` WHERE `aadhar_no`='$aadhar_no'";
        $res4=mysqli_query($connection,$sql4);


        if (mysqli_num_rows($res4) > 0) {
        
            $row4 = mysqli_fetch_assoc($res4);
            // echo $row4['token_no'];
            // echo $row4['full_name'];
            // echo $row4['mobile_no'];
            // echo $row4['address'];
            // echo $row4['firm_name'];

            // Sample data
            $data = array(
                'token_no' => $row4['token_no'],
                'full_name' => $row4['full_name'],
                'mobile_no' => $row4['mobile_no'],
                'address' => $row4['address'],
                'firm_name' => $row4['firm_name'],
                'message' => "data found"


            );


        }
    }else if(!empty($rowu) && $rowu['role']=='GAT'){
        $sql5="SELECT * FROM `gat` WHERE `aadhar_no`='$aadhar_no'";
        $res5=mysqli_query($connection,$sql5);


        if (mysqli_num_rows($res5) > 0) {
        
            $row5 = mysqli_fetch_assoc($res5);
            // echo $row5['token_no'];
            // echo $row5['full_name'];
            // echo $row5['mobile_no'];
            // echo $row5['address'];

            // Sample data
            $data = array(
                'token_no' => $row5['token_no'],
                'full_name' => $row5['full_name'],
                'mobile_no' => $row5['mobile_no'],
                'address' => $row5['address'],
                'message' => "data found"

        
            );

        }
    }else if(!empty($rowu) && $rowu['role']=='TAT'){
        $sql6="SELECT * FROM `tat` WHERE `aadhar_no`='$aadhar_no'";
        $res6=mysqli_query($connection,$sql6);


        if (mysqli_num_rows($res6) > 0) {
        
            $row6 = mysqli_fetch_assoc($res6);
            // echo $row6['token_no'];
            // echo $row6['full_name']; 
            // echo $row6['mobile_no'];
            // echo $row6['address'];

            // Sample data
            $data = array(
                'token_no' => $row6['token_no'],
                'full_name' => $row6['full_name'],
                'mobile_no' => $row6['mobile_no'],
                'address' => $row6['address'],
                'message' => "data found"

        
            );


        }
    }else if(!empty($rowu) && $rowu['role']=='SEC'){
        $sql7="SELECT * FROM `sec` WHERE `aadhar_no`='$aadhar_no'";
        $res7=mysqli_query($connection,$sql7);


        if (mysqli_num_rows($res7) > 0) {
        
            $row7 = mysqli_fetch_assoc($res7);
            // echo $row7['token_no'];
            // echo $row7['full_name'];
            // echo $row7['mobile_no'];
            // echo $row7['address'];
            // echo $row7['firm_name'];

              // Sample data 
              $data = array(
                'token_no' => $row7['token_no'],
                'full_name' => $row7['full_name'],
                'mobile_no' => $row7['mobile_no'],
                'address' => $row7['address'],
                'firm_name' => $row7['firm_name'],
                'message' => "data found"


            );

        }
    }else if(!empty($rowu) && $rowu['role']=='FEG'){
        $sql8="SELECT * FROM `feg` WHERE `aadhar_no`='$aadhar_no'";
        $res8=mysqli_query($connection,$sql8);


        if (mysqli_num_rows($res8) > 0) {
        
            $row8 = mysqli_fetch_assoc($res8);
            // echo $row8['token_no'];
            // echo $row8['full_name'];
            // echo $row8['mobile_no'];
            // echo $row8['address'];

            // Sample data
            $data = array(
                'token_no' => $row8['token_no'],
                'full_name' => $row8['full_name'],
                'mobile_no' => $row8['mobile_no'],
                'address' => $row8['address']   ,
                'message' => "data found"
        
            );

        }
    }else{
        $data=array("message"=>"data not found");
    }


// Encode the data to JSON format
    // echo $data;
    $json = json_encode($data);
    echo $json;
   
?>












 <?php
// include('../app/config.php');
// $aadhar_no = $_GET['aadhar_no'];

// $sql="SELECT * FROM `officer` WHERE `aadhar_no`='$aadhar_no'";
// $res=mysqli_query($connection,$sql);


// if (mysqli_num_rows($res) > 0) {
//     $row = mysqli_fetch_assoc($resi);
//     echo $row[''];
   
// }



// $sql1="SELECT * FROM `employee` WHERE `aadhar_no`='$aadhar_no'";
// $res1=mysqli_query($connection,$sql1);
// mysqli_num_rows($res1);
//<!-- working on autofill w r t aaadhar no by sonal bhirud on 22-05-24 -->
?> 


