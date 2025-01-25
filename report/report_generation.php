<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php"); ?>
<!-- if file is in any folder use ../root.php -->
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <link rel="icon" href="../../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
     <!-- including external links -->
     <?php include($external_links_loc); ?>
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

     <!-- including config file to use database -->
     <?php include($config_loc); ?>
</head>


<?php
// $sql1="SELECT * from `uni_aadhar` where `role` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG');";
// $res1=mysqli_query($connection,$sql1);
// $row1=mysqli_fetch_assoc($res1);

// $sql2="SELECT * from `uni_aadhar` where `role` IN ('PT', 'BK', 'TR');";
// $res2=mysqli_query($connection,$sql2);
// $row2=mysqli_fetch_assoc($res2);

// $sql3="SELECT * from `uni_aadhar` where `role` IN ('PW', 'AMC');";
// $res3=mysqli_query($connection,$sql3);
// $row3=mysqli_fetch_assoc($res3);

$fromdate="";
$todate="";
$dept="";
$sub_dept="";
$gate="";


if(isset($_POST['generate'])){
     //echo $_GET['dept'];}
     //echo "hello";
    $_SESSION["fromdate"]=$_POST['fromdate'];
     
    $_SESSION["todate"]=$_POST['todate'];
    $_SESSION["dept"]=$_POST['dept'];
    // echo "$dept";die;
    $_SESSION["sub_dept"]=$_POST['sub_dept'];
    $_SESSION["gate"]=$_POST['gate'];

    //$_SESSION[""] = "green";


//      echo $fromdate;
// echo $todate;

// echo $dept;

// echo $sub_dept;die;

     // if($gate=="Main Gate"){}
     // $sql = "SELECT * FROM `maingate` WHERE date BETWEEN '$fromdate' AND '$todate' ";
     // $res = mysqli_query($conn, $sql);





}





?>













<?php 
     $fromdate=$_SESSION["fromdate"];
     $todate=$_SESSION["todate"];
     $dept=$_SESSION["dept"];
     $sub_dept=$_SESSION["sub_dept"];
     $gate=$_SESSION["gate"];
     $s_by_name=$_SESSION["s_by_name"];




//-------





     




//-------





     



     //--------------------------  LISCENCE GATE--------------------------------












     if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="Officer"){
                                                 
          //$sql="SELECT * FROM `maingate` WHERE `section`='OFC'";
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, ofc.name FROM licensegate AS lg JOIN officer as ofc on lg.qr_code = ofc.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);

          
          // echo $row['mg.section'];die;
         // echo $res;die;
     }
     
     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="Employee"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, emp.name FROM licensegate AS lg JOIN employee as emp on lg.qr_code = emp.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
          
     }

     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="Contractor"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, con.name FROM licensegate AS lg JOIN contractor as con on lg.qr_code = con.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
          
     }
     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="Contractor workman"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, cw.name FROM licensegate AS lg JOIN contractor_workman as cw on lg.qr_code = cw.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
         // $row= mysqli_fetch_assoc($res);


          
     }
     
     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="GAT"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, gat.name FROM licensegate AS lg JOIN gat as gat on lg.qr_code = gat.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);


          
     }
     
     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="SEC"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, sec.name FROM licensegate AS lg JOIN sec as sec on mg.qr_code = sec.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);


          
     }

     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="TAT"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, tat.name FROM licensegate AS lg JOIN tat as tat on lg.qr_code = tat.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
         // $row= mysqli_fetch_assoc($res);


          
     }

     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="FEG"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, feg.name FROM licensegate AS lg JOIN feg as feg on lg.qr_code = feg.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);


          
     }

     else if($gate=="Liscence Gate" && $dept=="Operation" && $sub_dept=="All"){
          
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, tat.name FROM licensegate AS lg JOIN tat as tat on lg.qr_code = feg.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate' AND lg.section IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG')";
          $res= mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);


     }




//-------





     else if($gate=="Liscence Gate" && $dept=="Driver" && $sub_dept=="Packed"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, pk.name FROM licensegate AS lg JOIN packed as pk on lg.qr_code = pk.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }
     
     else if($gate=="Liscence Gate" && $dept=="Driver" && $sub_dept=="Bulk"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, bk.name FROM licensegate AS lg JOIN bulk as bk on lg.qr_code = bk.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

     else if($gate=="Liscence Gate" && $dept=="Driver" && $sub_dept=="Transporter"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, tr.name FROM licensegate AS lg JOIN transporter as tr on lg.qr_code = tr.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

     else if($gate=="Liscence Gate" && $dept=="Driver" && $sub_dept=="All"){
          $sql="SELECT lg.date, lg.intime, lg.outtime, lg.section, tr.name FROM licensegate AS lg JOIN transporter as tr on lg.qr_code = tr.qr_code WHERE lg.date BETWEEN '$fromdate' AND '$todate' AND mg.section IN ('PT', 'BK', 'TR')";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }




//-------





     else if($gate=="Liscence Gate" && $dept=="Project" && $sub_dept=="Workman"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, pw.name FROM licensegate AS mg JOIN workman as pw on mg.qr_code = pw.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

     else if($gate=="Liscence Gate" && $dept=="Project" && $sub_dept=="AMC"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, amc.name FROM licensegate AS mg JOIN amc as amc on mg.qr_code = amc.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

     else if($gate=="Liscence Gate" && $dept=="Project" && $sub_dept=="All"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, tr.name FROM licensegate AS mg JOIN transporter as tr on mg.qr_code = tr.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate' AND mg.section IN ('PW', 'AMC')";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }





     else if($gate=="Liscence Gate" && $dept=="Visitor" && $sub_dept=="Visitor"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, v.name FROM licensegate AS mg JOIN visitor as v on mg.qr_code = pw.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

     else if($gate=="Liscence Gate" && $dept=="Visitor" && $sub_dept=="All"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, v.name FROM licensegate AS mg JOIN visitor as v on mg.qr_code = v.qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate' AND mg.section ='V'";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }

//----------------------------------------------------------------


     else if($gate=="Liscence Gate" && $dept=="All" && $sub_dept=="All"){
          $sql="SELECT mg.date, mg.intime, mg.outtime, mg.section, .name FROM licensegate AS mg JOIN  as  on mg.qr_code = .qr_code WHERE mg.date BETWEEN '$fromdate' AND '$todate' AND mg.section IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG', 'PT', 'BK', 'TR', 'PW', 'AMC')";
          $res = mysqli_query($connection, $sql);
          //$row= mysqli_fetch_assoc($res);
     }




                                                                 
                                                            

                                                           

                                                            













                                                           

                                                            

                                                       


                                                     







//-----------------------------------LISCENCE GATE------------------------------------------------------------------------------------------------------------------------





                                             
                                             
                                             else if($gate=="Liscence Gate"){
                                                  $sqlg = "SELECT * FROM `licensegate` WHERE date BETWEEN '$fromdate' AND '$todate'";
                                                  $resg = mysqli_query($connection, $sqlg);
                                                  $rowg= mysqli_fetch_assoc($resg);

                                                  if($rowg){
                                                       if($dept=="Operation"){
                                                            if($sub_dept=="Officer"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='OFC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                                 


                                                                 
                                                            }

                                                            else if($sub_dept=="Employee"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='EMP'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="Contractor"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='CON'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="Contractor workman"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='CONW'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }


                                                                 
                                                       

                                                            else if($sub_dept=="GAT"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='GAT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="TAT"){
                                                                 $sqlt="SELECT * FROM `licensegate` WHERE `section`='TAT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="SEC"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='SEC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="FEG"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='FEG'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else{
                                                                 $sql="SELECT * from `licensegate` where `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG');";
                                                                 $res= mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                            }

                                                       }



                                                       else if($dept=="Driver"){
                                                            if($sub_dept=="Packed"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='PT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="Bulk"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='BK'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="Transporter"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='TR'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sql="SELECT * from `licensegate` where `section` IN ('PT', 'BK', 'TR');";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                            }

                                                       }


                                                       else if($dept=="Project"){
                                                            if($sub_dept=="Workman"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='PW'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="AMC"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='AMC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sqlpa="SELECT * from `licensegate` where `section` IN ('PW', 'AMC');";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                            }

                                                       }


                                                       else if($dept=="Visitor"){
                                                            if($sub_dept=="Visitor"){
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='V'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sql="SELECT * FROM `licensegate` WHERE `section`='V'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                            }


                                                       }

                                                       else{
                                                            $sql="SELECT * from `licensegate` where `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG', 'PT', 'BK', 'TR', 'PW', 'AMC');";
                                                                 $res= mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                       }


                                                  }

                                             }
                                        

                                             
                                             


//-----------------------------------DRIVER GATE------------------------------------------------------------------------------------------------------------------------






                                             
                                             
                                             else if($gate=="Driver Gate"){
                                                  $sqlg = "SELECT * FROM `drivergate` WHERE date BETWEEN '$fromdate' AND '$todate'";
                                                  $resg = mysqli_query($connection, $sqlg);
                                                  $rowg= mysqli_fetch_assoc($resg);

                                                  if($rowg){
                                                       if($dept=="Operation"){
                                                            if($sub_dept=="Officer"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='OFC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                                 


                                                                 
                                                            }

                                                            else if($sub_dept=="Employee"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='EMP'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="Contractor"){
                                                                 $sqlc="SELECT * FROM `drivergate` WHERE `section`='CON'";
                                                                 $resc = mysqli_query($connection, $sqlc);
                                                                 $rowc= mysqli_fetch_assoc($resc);


                                                                 
                                                            }

                                                            else if($sub_dept=="Contractor workman"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='CONW'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="GAT"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='GAT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="TAT"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='TAT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="SEC"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='SEC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else if($sub_dept=="FEG"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='FEG'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                                 
                                                            }

                                                            else{
                                                                 $sql="SELECT * from `drivergate` where `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG');";
                                                                 $res= mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);


                                                            }

                                                       }



                                                       else if($dept=="Driver"){
                                                            if($sub_dept=="Packed"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='PT'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="Bulk"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='BK'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="Transporter"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='TR'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sql="SELECT * from `drivergate` where `section` IN ('PT', 'BK', 'TR');";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                            }

                                                       }


                                                       else if($dept=="Project"){
                                                            if($sub_dept=="Workman"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='PW'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else if($sub_dept=="AMC"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='AMC'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sql="SELECT * from `drivergate` where `section` IN ('PW', 'AMC');";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                            }

                                                       }


                                                       else if($dept=="Visitor"){
                                                            if($sub_dept=="Visitor"){
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='V'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);
                                                            }
                                                            else{
                                                                 $sql="SELECT * FROM `drivergate` WHERE `section`='V'";
                                                                 $res = mysqli_query($connection, $sql);
                                                                 $row = mysqli_fetch_assoc($res);

                                                            }


                                                       }

                                                       else{
                                                            $sql="SELECT * from `drivergate` where `section` IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG', 'PT', 'BK', 'TR', 'PW', 'AMC');";
                                                                 $res= mysqli_query($connection, $sql);
                                                                 $row= mysqli_fetch_assoc($res);

                                                       }

                                                  }

                                             }

                         // ------------------else case---------------------------------------------------------------------------------------------------------------------

                                             else{
                                                 
                                             }
                                             ?>

<body>


     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <!-- container-fluid -->
                    <div class="card  border-0 shadow mt-4" id="two" >
                         <?php
                                
                              ?>

                         <div class="row mb-2">
                              <div class="col-md-12">
                                   <button type="button" name="print" id="print" onclick="printContent();"
                                        class="btn btn-success mx-1">Print</button>
                                   <button type="button" name="" onclick="" class="btn btn-primary mx-1">Export To
                                        Excel</button>
                                   <button type="button" name="back" onclick="history.back(); return false;"
                                        class="btn btn-secondary mx-1">Back</button>

                              </div>

                         </div>

                         <div class="content">
                              <div class="table-responsive">
                                   <table class="table">
                                        <tbody>

                                             <tr>
                                                  <th colspan="7">IN-OUT Report of HPCL</th>
                                             </tr>

                                             <tr>
                                                  <th>Department :<span id="dept1"></span></th>
                                                  <th colspan="2">Sub-Department :<span id="sub_dept1"></span></th>
                                                  <th colspan="2">From Date :<span id="fromdate1"></span></th>
                                                  <th colspan="2">To Date :<span id="todate1"></span></th>
                                             </tr>

                                             <tr>

                                                  <!-- <th>sr</th> -->
                                                  <th>Department</th>
                                                  <th>Name</th>
                                                  <th>Sub-Department</th>
                                                  <th>CheckIn Date</th>
                                                  <th>Time In</th>
                                                  <th>Time Out</th>
                                                  <th>CheckOut Date</th>
                                                  <th>Gate Name</th>


                                             </tr>

                                             <?php 
                                             // $cn = 1;
                                             // while($row= mysqli_fetch_assoc($res)){
                                                  
                                                  //extract($row);
                                                  //print_r($row);
                                                  
                                                  
                                                  


                                             ?>
                                             <tr>
                                                  <!-- <td><?php //echo $cn++; ?></td> -->
                                                  <td>
                                                       <?php if($row['section']=="OFC"){
                                                       echo "Operation";
                                                       } ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>
                                                  <td>
                                                       <?php echo $row['sample_label']; ?>
                                                  </td>

                                                  <?php  ?>
                                             <tr></tr>

                                        </tbody>
                                   </table>
                              </div>








                         </div>



                         <?php  ?>



                         <!-- <div class="card-body">
                        <h1 class="text" style="text-align: center; color:black; font-family: Arial, Helvetica, sans-serif;">
                            <strong>Gat Form </strong><i class="fa-solid fa-users"></i></h1>
                        </div> -->
                    </div>

                    <!----------------------------->
                    <!--                         -->
                    <!-- place your content here -->
                    <!--         sfdfhgfjhg                -->
                    <!----------------------------->
               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>

     <!-- Start writing content here -->
     <main>

     </main>



     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Theme";
          document.getElementById('navbar-title').innerHTML = "Theme";
     </script>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>

     <!-- Custom JavaScript -->
     <script>
          // JavaScript to toggle sidebar
          // document.getElementById('sidebar-toggle').addEventListener('click', function () {
          //      document.querySelector('.wrapper').classList.toggle('sidebar-open');
          //      document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          // });
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>
</body>

</html>