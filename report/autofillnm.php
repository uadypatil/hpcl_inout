<?php
include('../app/config.php');

// Set the content type to JSON
header('Content-Type: application/json');

// all, officer, employee, contractor, contractor workman, gat, tat, feg, sec, 
// packed, bulk, transporter, workman, amc, visitor
// to get data table name
function getTableName($sub_depart){
     switch ($sub_depart) {
          // FOR OPERATION SECTION
          case 'officer':
               return "officer";
          case 'employee':
               return "employee";
          case 'contractor':
               return "contractor";
          case 'contractor workman':
               return "contractor_workman";
          case 'gat':
               return "gat";
          case 'tat':
               return "tat";
          case 'sec':
               return "sec";
          case 'feg':
               return "feg";

               // packed, bulk, transporter, workman, amc, visitor

          // FOR DRIVER SECTION
          case 'packed':
               return "packed";
          case 'bulk':
               return "bulk";
          case 'transporter':
               return "transporter";

          // FOR PROJECT SECTION
          case 'workman':
               return "workman";
          case 'amc':
               return "amc";

          // FOR VISITOR SECTION
          case 'visitor':
               return "visitor";


          // If sub department is al;
          case 'All':
               return 'all';
     }
}

$sub_dept = $_GET['sub_dept'];
$tablenm = getTableName($sub_dept);
if($tablenm == "all"){
     $data = array();
     array_push($data, "all");
     $json = json_encode($data);
     echo $json;
}else{
     $data = array();
     // all, officer, employee, contractor, contractor workman, gat, tat, feg, sec, packed, 
     // bulk, transporter, workman, amc, visitor
     // query to fetch all records
     $sqlu = "SELECT `full_name` FROM `$tablenm` WHERE `full_name` IS NOT NULL";
     $res = mysqli_query($connection, $sqlu);
     
     // $rowu = mysqli_fetch_assoc($resu);
     if (mysqli_num_rows($res) > 0) {
     
          // Sample data
          $data = array();
          while($row = mysqli_fetch_assoc($res)){
               array_push($data, $row['full_name']);
          }
     }
     $json = json_encode($data);
     echo $json;
}



?>