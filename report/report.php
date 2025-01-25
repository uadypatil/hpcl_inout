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


<!-- <?php
// $sql1="SELECT * from uni_aadhar where role IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG');";
// $res1=mysqli_query($connection,$sql1);
// $row1=mysqli_fetch_assoc($res1);

// $sql2="SELECT * from uni_aadhar where role IN ('PT', 'BK', 'TR');";
// $res2=mysqli_query($connection,$sql2);
// $row2=mysqli_fetch_assoc($res2);

// $sql3="SELECT * from uni_aadhar where role IN ('PW', 'AMC');";
// $res3=mysqli_query($connection,$sql3);
// $row3=mysqli_fetch_assoc($res3);

$fromdate = "";
$todate = "";
$dept = "";
$sub_dept = "";
$gate = "";


if (isset($_POST['generate'])) {
     //echo $_GET['dept'];}
     //echo "hello";
     $_SESSION["fromdate"] = $_POST['fromdate'];

     $_SESSION["todate"] = $_POST['todate'];
     $_SESSION["dept"] = $_POST['dept'];
     // echo "$dept";die;
     $_SESSION["sub_dept"] = $_POST['sub_dept'];
     $_SESSION["gate"] = $_POST['gate'];
     $_SESSION["s_by_name"] = $_POST['s_by_name'];

     $fromdate = $_SESSION["fromdate"];
     $todate = $_SESSION["todate"];
     $dept = $_SESSION["dept"];
     $sub_dept = $_SESSION["sub_dept"];
     $gate = $_SESSION["gate"];
     $s_by_name = $_SESSION["s_by_name"];

}
?> -->

 
<body>


     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content-->
               <!--<div class="container-fluid"> -->
                    <!-- container-fluid -->
                    <div class="container-fluid">
                    <!-- container-fluid -->

                    <!-- displaying report -->
                    <div class="card  border-0 shadow mt-4"  id="two" style="display:none;">
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
                                             $tablename = "";
                                             //-----------------------------------MAINGATE--------------------------------------------------------------
                                             if ($gate == "Main Gate") {
                                                  $tablename = "maingate";
                                             } elseif ($gate == "License Gate") {
                                                  $tablename = "licensegate";
                                             } elseif ($gate == "Driver Gate") {
                                                  $tablename = "drivergate";
                                             }

                                             if ($dept == "Operation" || $dept == "Driver" || $dept == "Project" || $dept == "Visitor" || $dept == "All") {
                                                  if ($sub_dept == "Officer") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='OFC' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Employee") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='EMP' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Contractor") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='CON' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Contractor workman") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='CONW' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       // $row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "GAT") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='GAT' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "SEC") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='SEC' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "TAT") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='TAT' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       // $row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "FEG") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='FEG' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "All") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG') AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Packed") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='PT' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Bulk") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='BK' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Transporter") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='TR' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "All") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section IN ('PT', 'BK', 'TR') AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Workman") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='PW' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "AMC") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='AMC' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "All") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section IN ('PW', 'AMC') AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($sub_dept == "Visitor") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='V' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  } else if ($gate == "Main Gate" && $dept == "Visitor" && $sub_dept == "All") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section='V' AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  }

                                                  //----------------------------------------------------------------
                                                  else if ($sub_dept == "All") {
                                                       $sql = "SELECT * FROM $tablename WHERE date BETWEEN '$fromdate' AND '$todate' AND section IN ('OFC', 'EMP', 'CON', 'CONW', 'GAT', 'TAT', 'SEC', 'FEG', 'PT', 'BK', 'TR', 'PW', 'AMC', 'V') AND (name='$s_by_name' or name is not null);";
                                                       $res = mysqli_query($connection, $sql);
                                                       //$row= mysqli_fetch_assoc($res);
                                                  }
                                             }



                                             while ($row = mysqli_fetch_assoc($res)) {
                                                  ?>
                                                       
                                                            <tr>
                                                                 <td>
                                                                      <?php echo $row['department']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['name']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['section']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['date']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['intime']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['outtime']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $row['date']; ?>
                                                                 </td>
                                                                 <td>
                                                                      <?php echo $gate; ?>
                                                                 </td>
                                                            </tr>
                                                                 <?php
                                                                 $sql = "";
                                                                 $result = mysqli_query($connection, $sql);
                                                                 if ($result) {
                                                                      return true;
                                                                 } else {
                                                                      return false;
                                                                 }

                                             }
                                             ?>

                                        </tbody>
                                   </table>
                              </div>

                         </div>

                         <!-- <div class="card-body">
                        <h1 class="text" style="text-align: center; color:black; font-family: Arial, Helvetica, sans-serif;">
                            <strong>Gat Form </strong><i class="fa-solid fa-users"></i></h1>
                        </div> -->
                    </div>


                    <!-- report form -->
                    <div class="card border-0 shadow mt-4" id="one" style="display:block;">
                         <div class="card-body">
                              <div class="one" >
                                   <form method="post">
                                        <div class="row">
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="fromdate" class="col-form-label ">From Date :</label>
                                                       <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="fromdate" id="fromdate">

                                                  </div>
                                             </div>
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="todate" class="col-form-label ">To Date :</label>
                                                       <input type="date" class="form-control" name="todate" value="<?= date("Y-m-d"); ?>" id="todate">

                                                  </div>
                                             </div>
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="dept" class="col-form-label ">Department</label>
                                                       <select class="form-control" name="dept" id="dept"
                                                            onchange="p(this.id,'sub_dept');">
                                                            <option class="dropdown-toggle" value="All">All</option>
                                                            <option value="Operation">Operation</option>
                                                            <option value="Driver">Driver</option>
                                                            <option value="Project">Project</option>
                                                            <option value="Visitor">Visitor</option>

                                                            <?php
                                                            // if($row1 && $row2 && $row3){
                                                            // while(){
                                                            //      echo '<option value="O"> </option>';
                                                            

                                                            // }
                                                            // }
                                                            

                                                            ?>


                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-md-3">
                                                  <div class="form-group">
                                                       <label for="sub_dept" class="col-form-label ">Sub-Department</label>
                                                       <select class="form-control form-control" name="sub_dept"
                                                            id="sub_dept">
                                                            <option value="All">All</option>
                                                            <option value=""></option>


                                                       </select>
                                                  </div>

                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <label for="s_by_name" class="col-form-label ">Search by Name</label>
                                                       <input type="text" class="form-control" name="s_by_name"
                                                            placeholder="Search by Name" id="s_by_name">
                                                  </div>
                                             </div>
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <label for="gate" class="col-form-label ">Gate</label>
                                                       <select class="form-control form-control" name="gate" id="gate">
                                                            <option value="Main Gate">All</option>
                                                            <option value="Main Gate">Main Gate</option>
                                                            <option value="Liscence Gate">Liscence Gate</option>
                                                            <option value="Driver Gate">Driver Gate</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="form-group">
                                                  <div class="col-md-3">
                                                       <button type="button" name="generate" onclick="display();show();" class="btn btn-lg btn-primary">Generate Report</button>
                                                       <!-- <input type="submit" onclick="display();" name="generate"> -->
                                                  </div>
                                                  <div class="col-md-9"></div>
                                             </div>

                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>

               </div> <!-- container-fluid ends here -->
               <!-- End Page Content -->
          </div>
     </div>




     <!-- giving title to document and navbar -->
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Theme";
          document.getElementById('navbar-title').innerHTML = "Advance report";
     </script>

     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

          <script>
                        function printContent() {
  
                            var visitorContent = document.getElementById("content").innerHTML;
                            var originalDocument = document.body.innerHTML;

                            document.body.innerHTML = visitorContent;

                            window.print();
                            document.body.innerHTML = originalDocument;
                        }
                        </script>
<script>
     function display(){
          document.getElementById('one').style.display="none";
          document.getElementById('two').style.display="block";
          
          

     }

//      $fromdate=$_POST['fromdate'];
     
//      $todate=$_POST['todate'];
//      $dept=$_POST['dept'];
//     // echo "$dept";die;
//      $sub_dept=$_POST['sub_dept'];
//      $gate=$_POST['gate'];

     function show(){
          let f=document.getElementById('fromdate').value;
          let t=document.getElementById('todate').value;
          let d=document.getElementById('dept').value;
          let s=document.getElementById('sub_dept').value;

          document.getElementById('fromdate1').innerText = f;
          document.getElementById('todate1').innerText = t;
          document.getElementById('dept1').innerText = d;
          document.getElementById('sub_dept1').innerText = s;

          console.log(f);
          console.log(t);

          console.log(d);

          console.log(s);

      }

     // function checkadhar(){
     //        const aadhar_no=document.getElementById('aadhar_no').value.trim();


     //        fetch('autofillop.php?aadhar_no='+aadhar_no)
     //        .then(response => {
     //            console.log(response);
     //            if (!response.ok) {
     //                throw new Error('Network response was not ok');
     //            }
     //            return response.json();
     //        })
     //        .then(data => {
     //            // console.log(data);
     //            if(data.message=="data found"){
                  
     //                // console.log(true);
     //                document.getElementById('token_no').value=data.token_no;
     //                document.getElementById('full_name').value=data.full_name;
     //                document.getElementById('mobile_no').value=data.mobile_no;
     //                document.getElementById('address').value=data.address;
              


     //            }
     //            else{
     //                document.getElementById('token_no').value=token;
     //                document.getElementById('full_name').value="";
     //                document.getElementById('mobile_no').value="";
     //                document.getElementById('address').value="";

     //            }
     //        })
     //        .catch(error => {
     //            console.error('There was a problem with the fetch operation:', error);
     //        });

     //      }
        </script>







     <script>
          function p(s1, s2) {

               var s1 = document.getElementById(s1);
               var s2 = document.getElementById(s2);
// console.log(s1.value);
               s2.innerHTML = "";
               if (s1.value == "Operation") {
                    var optionArray = ['All|All','Officer|Officer', 'Employee|Employee', 'Contractor|Contractor', 'Contractor workman|Contractor workman', 'GAT|GAT', 'TAT|TAT', 'SEC|SEC', 'FEG|FEG'];
                    // console.log(s1.value+"Operation");


               }
               else if (s1.value == "Driver") {
                    var optionArray = ['All|All','Packed|Packed', 'Bulk|Bulk', 'Transporter|Transporter'];
                    // console.log(s1.value+"Driver");

               }
               else if (s1.value == "Project") {
                    var optionArray = ['All|All','Workman|Workman', 'AMC|AMC'];
                    // console.log(s1.value+"Project");

               }
               else if (s1.value == "Visitor") {
                    var optionArray = ['All|All','Visitor|Visitor'];
                    // console.log(s1.value+"Visitor");

               }
               else {
                    var optionArray = ['All|All',];
                    // console.log(s1.value+"All");

               }

               for (var option in optionArray) {
                    var pair = optionArray[option].split("|");
                    var newoption = document.createElement("option");
                    newoption.value = pair[0];
                    newoption.innerHTML = pair[1];
                    s2.options.add(newoption);
               }
          }




          // let dept = document.getElementById("dept").value;
          // if(dept=="Operation") {
          //      getElementById().value=;

          // }
          // else if(dept=="Driver") {

          // }
          // else if(dept=="Project") {

          // }
          // else {

          // }
     </script>

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