<?php include("../root.php"); ?>
<?php include($config_loc); ?>
<?php 

if(isset($_POST['update'])){
    // print_r($_POST);die;
    extract($_POST);
// print_r($_FILES);die;
    $id = $_POST['id'];
    


    $sql = "UPDATE `feg` SET `token_no`='$token_no', `aadhar_no`='$aadhar_no',`full_name`='$full_name',`mobile_no`='$mobile_no',`address`='$address' WHERE `id` = '$id'"; 
   $res = mysqli_query($connection,$sql);
    if($res){
        echo '<script>
        $(document).ready(function(){
            Swal.fire({
                title: "Good job!",
                text: "Data updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.history.go(-1);

                // window.location.href = "view03.php"; // Redirect to view2.php after user clicks OK
            });
        });
    </script>';
    }
    else{
        echo "fail to update data";
    }
}


?>