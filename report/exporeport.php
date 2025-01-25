<?php include 'advance_report.php'; ?>

<div id="content">
     <div class="table-responsive">
          <table class="table">
               <tbody>

                    <tr>
                         <th colspan="7">IN-OUT Report of HPCL</th>
                    </tr>

                    <tr>
                         <th>Department :<span id="dept1">
                                   <?php echo $_GET['dept']; ?>
                                   <!-- <script>document.write(document.getElementById('dept').value);</script> -->
                              </span></th>
                         <th colspan="2">Sub-Department :<span id="sub_dept1">
                                   <?php echo $_GET['sub_dept']; ?>
                                   <!-- <script>document.getElementById('sub_dept1').innerHTML = document.getElementById('sub_dept').value</script> -->
                              </span></th>
                         <th colspan="2">From Date :<span id="fromdate1">
                                   <?php echo $_GET['fd']; ?>
                                   <!-- <script>document.getElementById('fromdate1').innerHTML = document.getElementById('fromdate').value</script> -->
                              </span></th>
                         <th colspan="2">To Date :<span id="todate1">
                                   <?php echo $_GET['td']; ?>
                                   <!-- <script>document.getElementById('todate1').innerHTML = document.getElementById('todate').value</script> -->
                              </span></th>
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
                    $tablename = $_GET['gate'];
                    $name = $_GET['nm'];
                    $fromdate = $_GET['fd'];
                    $todate = $_GET['td'];
                    $section = getSection($_GET['sub_dept']);
                    $sql = "";
                    if ($section != "all") {
                         $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND `section`='$section' AND (`name`='$name' or `name` is not null);";
                    } else {
                         $sql = "SELECT * FROM `$tablename` WHERE (`date` BETWEEN '$fromdate' AND '$todate') AND (`name`='$name' or `name` is not null);";
                    }

                    // echo $sql;     
                    $res = mysqli_query($connection, $sql);
                    if ($res) {
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
                                        <?php echo $tablename; ?>
                                   </td>


                              </tr>
                              <?php
                         }
                    } else {
                         ?>
                         <tr>
                              <td colspan="8">
                                   <span class="text-danger">
                                        <?php echo "Record Not Found"; ?>
                                   </span>
                              </td>
                         </tr>
                         <?php
                    }


                    ?>


               </tbody>
          </table>
     </div>
</div>
<?php
// echo "<script>alert('Executed')</script>";
header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename="report.xls"');
?>