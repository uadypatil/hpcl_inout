<?php

$remaindays = 0;
if (isset($_SESSION['remaindays'])) {
     $remaindays = $_SESSION['remaindays'];
} else {
     $remaindays = 0;
}

if ($_SESSION['access'] == 'admin') {
     displayAll();
} elseif ($_SESSION['access'] == 'officer') {
     displayForOfficer();
} elseif ($_SESSION['access'] == 'security') {
     displayForSecurity();
} else {
     echo "";
     die;
}

echo "<script>document.getElementById('dayscount').value = 10</script>";
function displayAll()
{
     global $dashboard_loc;
     global $operation_dir;
     global $driver_dir;
     global $project_dir;
     global $visitor_dir;
     global $report_dir;
     global $setting_dir;
     global $images_dir;
     global $remaindays;
     ?>

     <div class="wrapper d-flex">

          <!-- Main Content -->
          <div class="main-content">
               <!--      Sidebar -->
               <aside class="sidebar overflow-y-scroll scroll ">

                    <header>
                         <div
                              class="navbar-header m-auto mt-3 mb-3 botder border-bottom border-dark border-opacity-25 border-3 w-100">
                              <a class="w-100"><!--  href="https://www.hindustanpetroleum.com/"  -->
                                   <img src="<?php echo $images_dir . 'hpcl.jpeg'; ?>" alt="" class="img-fluid w-100">
                                   <!-- ../assets/imgs/hpcl.jpeg -->
                              </a>
                         </div> <!-- https://manasvi.tech/assets/img/new_logo.png -->
                         <div class="time-div">
                              <!-- adding digital clock -->
                              <p class="text-light fs-4 text-center">&nbsp;<span id="digiclock"></span></p>
                              <!-- including clock script -->
                              <script>
                                   function startTime() {
                                        var today = new Date();
                                        var now = new Date();
                                        var h = today.getHours();
                                        var m = today.getMinutes();
                                        var s = today.getSeconds();

                                        var month = String(now.getMonth() + 1).padStart(2, '0');
                                        var day = String(now.getDate()).padStart(2, '0');
                                        var year = now.getFullYear();
                                        var dateString = `${day}/${month}/${year}`;

                                        // var date = today.getDate();
                                        // var month = today.getMonth();
                                        // var year = today.getFullYear();
                                        m = checkTime(m);
                                        s = checkTime(s);
                                        document.getElementById('digiclock').innerHTML =
                                             "Now: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                                        var t = setTimeout(startTime, 500);
                                   }
                                   function checkTime(i) {
                                        if (i < 10) { i = "0" + i; }  // add zero in front of numbers < 10
                                        return i;
                                   }
                                   startTime();
                              </script>
                         </div>
                    </header>

                    <ul class="sidebar-nav">
                         <li class="sidebar-item">
                              <a href="<?php echo $dashboard_loc; ?>" class="sidebar-link text-decoration-none link-hover">
                                   <i class="fa fa-solid fa-house"></i>
                                   Dashboard
                              </a>
                         </li>
                         <li class="sidebar-item">
                              <a href="#"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover dropdown-toggle"
                                   data-bs-target="#operation" data-bs-toggle="collapse" data-toggle="collapse"
                                   aria-expanded="false">
                                   <i class="fa-solid fa-users"></i>
                                   <span class="pe-3">Operation</span>
                              </a>

                              <ul id="operation" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'officer.php'; ?>"
                                             class="sidebar-link list-unstyled text-decoration-none link-hover">Officer</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'employee.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Employee</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'contractor.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Contractor</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'contractorworkman.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Contractor
                                             Workman</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'gat.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Gat</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'tat.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Tat</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'feg.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Feg</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'sec.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Sec</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#driver"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#driver" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-sharp fa-solid fa-truck text-white ps-1"></i>
                                   <span class="pe-5">Driver</span> </a>



                              <ul id="driver" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'packed.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Packed</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'bulk.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Bulk</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'transporter.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Transporter</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#project"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                                   data-bs-target="#project" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-solid fa-id-card"></i>
                                   <span class="pe-5">Project</span>
                              </a>

                              <ul id="project" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $project_dir . 'workman.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Workman</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $project_dir . 'amc.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">AMC</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#visitor"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                                   data-bs-target="#visitor" data-bs-toggle="collapse" aria-expanded="false"
                                   data-toggle="dropdown"><i class="fa-solid fa-users"></i>
                                   <span class="pe-5">Visitor</span> </a>

                              <ul id="visitor" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $visitor_dir . "visitor.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Visitor</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#report"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#report" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-solid fa-address-book"></i>
                                   <span class="pe-5">Report</span>
                              </a>

                              <ul id="report" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $report_dir . "advance_report.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Advance Report</a>
                                   </li>
                                   <!-- <li class="sidebar-item">
                                        <a href="<?php // echo $report_dir . "recentReports.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Recent Reports</a>
                                   </li> -->
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#setting"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#setting" data-bs-toggle="collapse" aria-expanded="false">
                                   <i class="fa-solid fa-gear"></i>
                                   <span class="pe-5">Settings</span>
                              </a>

                              <ul id="setting" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $setting_dir . "?s=main"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Settings</a>
                                   </li>
                              </ul>
                         </li>

                    </ul>
                    <footer class="px-3">
                         <div class="navbar-header m-auto border border-bottom border-dark border-opacity-25 border-3 w-100"
                              height="30">
                              <!-- <a href="https://manasvi.tech/" class="w-100 bg-white" height="30" width="250"> -->
                                   <img src="<?php echo $images_dir . 'manasvilogo.png'; ?>" alt="" class="img-fluid w-100 bg-white"
                                        height="30" width="250"><!-- ../assets/imgs/manasvilogo.jpeg -->
                              <!-- </a> -->
                         </div> <!-- https://manasvi.tech/assets/img/new_logo.png -->

                         <div class="navbar-header m-auto w-100" height="30">
                              <p class="fs-2 text-center text-danger">
                                   <span><span id="dayscount">
                                             <?php echo "$remaindays"; ?>
                                        </span> days remaining for license to expire</span>
                              </p>
                         </div>

                    </footer>
               </aside>
               <!-- End Sidebar -->
          </div>
     </div>

     <?php
}

function displayForOfficer()
{
     global $dashboard_loc;
     global $operation_dir;
     global $driver_dir;
     global $project_dir;
     global $visitor_dir;
     global $report_dir;
     global $setting_dir;
     global $images_dir;
     global $remaindays;
     ?>

     <div class="wrapper d-flex">

          <!-- Main Content -->
          <div class="main-content">
               <!-- Sidebar -->
               <aside class="sidebar overflow-y-scroll scroll ">

                    <header>
                         <div
                              class="navbar-header m-auto mt-3 mb-3 botder border-bottom border-dark border-opacity-25 border-3">
                              <a class="w-100"><!--  href="https://www.hindustanpetroleum.com/"  -->
                                   <img src="<?php echo $images_dir . 'hpcl.jpeg'; ?>" alt="" class="img img-fluid">
                                   <!-- https://manasvi.tech/demo/assest/img/logos/hpcl_logo.png -->
                              </a>
                         </div>
                         <div class="time-div">
                              <!-- adding digital clock -->
                              <p class="text-light fs-4 text-center">&nbsp;<span id="digiclock"></span></p>
                              <!-- including clock script -->
                              <script>
                                   function startTime() {
                                        var today = new Date();
                                        var now = new Date();
                                        var h = today.getHours();
                                        var m = today.getMinutes();
                                        var s = today.getSeconds();

                                        var month = String(now.getMonth() + 1).padStart(2, '0');
                                        var day = String(now.getDate()).padStart(2, '0');
                                        var year = now.getFullYear();
                                        var dateString = `${day}/${month}/${year}`;

                                        // var date = today.getDate();
                                        // var month = today.getMonth();
                                        // var year = today.getFullYear();
                                        m = checkTime(m);
                                        s = checkTime(s);
                                        document.getElementById('digiclock').innerHTML =
                                             "Now: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                                        var t = setTimeout(startTime, 500);
                                   }
                                   function checkTime(i) {
                                        if (i < 10) { i = "0" + i; }  // add zero in front of numbers < 10
                                        return i;
                                   }
                                   startTime();
                              </script>

                         </div>
                    </header>


                    <ul class="sidebar-nav">
                         <li class="sidebar-item">
                              <a href="<?php echo $dashboard_loc; ?>" class="sidebar-link text-decoration-none link-hover">
                                   <i class="fa fa-solid fa-house"></i>
                                   Dashboard
                              </a>
                         </li>
                         <li class="sidebar-item">
                              <a href="#"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover dropdown-toggle"
                                   data-bs-target="#operation" data-bs-toggle="collapse" data-toggle="collapse"
                                   aria-expanded="false">
                                   <i class="fa-solid fa-users"></i>
                                   <span class="pe-3">Operation</span>
                              </a>

                              <ul id="operation" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'officer.php'; ?>"
                                             class="sidebar-link list-unstyled text-decoration-none link-hover">Officer</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'employee.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Employee</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'contractor.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Contractor</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'contractorworkman.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Contractor
                                             Workman</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'gat.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Gat</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'tat.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Tat</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'feg.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Feg</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $operation_dir . 'sec.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Sec</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#driver"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#driver" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-sharp fa-solid fa-truck text-white ps-1"></i>
                                   <span class="pe-5">Driver</span> </a>



                              <ul id="driver" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'packed.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Packed</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'bulk.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Bulk</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $driver_dir . 'transporter.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Transporter</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#project"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                                   data-bs-target="#project" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-solid fa-id-card"></i>
                                   <span class="pe-5">Project</span>
                              </a>

                              <ul id="project" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $project_dir . 'workman.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Workman</a>
                                   </li>
                                   <li class="sidebar-item">
                                        <a href="<?php echo $project_dir . 'amc.php'; ?>"
                                             class="sidebar-link text-decoration-none link-hover">AMC</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#visitor"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                                   data-bs-target="#visitor" data-bs-toggle="collapse" aria-expanded="false"
                                   data-toggle="dropdown"><i class="fa-solid fa-users"></i>
                                   <span class="pe-5">Visitor</span> </a>

                              <ul id="visitor" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $visitor_dir . "visitor.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Visitor</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#report"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#report" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-solid fa-address-book"></i>
                                   <span class="pe-5">Report</span>
                              </a>

                              <ul id="report" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $report_dir . "advance_report.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Advance Report</a>
                                   </li>
                                   <!-- <li class="sidebar-item">
                                        <a href="<?php // echo $report_dir . "recentReports.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Recent Reports</a>
                                   </li> -->
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#setting"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#setting" data-bs-toggle="collapse" aria-expanded="false">
                                   <i class="fa-solid fa-gear"></i>
                                   <span class="pe-5">Settings</span>
                              </a>

                              <ul id="setting" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $setting_dir . "?s=main"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Settings</a>
                                   </li>
                              </ul>
                         </li>

                    </ul>
                    <footer class="px-3">
                         <div class="navbar-header m-auto border border-bottom border-dark border-opacity-25 border-3 w-100"
                              height="30">
                              <!-- <a href="https://manasvi.tech/" class="w-100 bg-white" height="30" width="250"> -->
                                   <img src="<?php echo $images_dir . 'manasvilogo.png'; ?>" alt="" class="img-fluid w-100 bg-white"
                                        height="30" width="250"><!-- ../assets/imgs/manasvilogo.jpeg -->
                              <!-- </a> -->
                         </div>
                         <div class="navbar-header m-auto w-100" height="30">
                              <p class="fs-2 text-center text-danger">
                                   <span><span id="dayscount">
                                             <?php echo "$remaindays"; ?>
                                        </span> days remaining for license to expire</span>
                              </p>
                         </div>
                    </footer>
               </aside>
               <!-- End Sidebar -->
          </div>
     </div>

     <?php

}

function displayForSecurity()
{
     global $dashboard_loc;
     global $visitor_dir;
     global $report_dir;
     global $setting_dir;
     global $images_dir;
     global $remaindays;
     ?>

     <div class="wrapper d-flex">

          <!-- Main Content -->
          <div class="main-content">
               <!-- Sidebar -->
               <aside class="sidebar overflow-y-scroll scroll ">

                    <header>
                         <div
                              class="navbar-header m-auto mt-3 mb-3 botder border-bottom border-dark border-opacity-25 border-3">
                              <a class="w-100"><!--  href="https://www.hindustanpetroleum.com/"  -->
                                   <img src="<?php echo $images_dir . 'hpcl.jpeg'; ?>" alt=" hpcl logo"
                                        class="img img-fluid">
                                   <!-- https://manasvi.tech/demo/assest/img/logos/hpcl_logo.png -->
                              </a>
                         </div>
                         <div class="time-div">
                              <!-- adding digital clock -->
                              <p class="text-light fs-4 text-center">&nbsp;<span id="digiclock"></span></p>
                              <!-- including clock script -->
                              <script>
                                   function startTime() {
                                        var today = new Date();
                                        var now = new Date();
                                        var h = today.getHours();
                                        var m = today.getMinutes();
                                        var s = today.getSeconds();

                                        var month = String(now.getMonth() + 1).padStart(2, '0');
                                        var day = String(now.getDate()).padStart(2, '0');
                                        var year = now.getFullYear();
                                        var dateString = `${day}/${month}/${year}`;

                                        // var date = today.getDate();
                                        // var month = today.getMonth();
                                        // var year = today.getFullYear();
                                        m = checkTime(m);
                                        s = checkTime(s);
                                        document.getElementById('digiclock').innerHTML =
                                             "Now: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                                        var t = setTimeout(startTime, 500);
                                   }
                                   function checkTime(i) {
                                        if (i < 10) { i = "0" + i; }  // add zero in front of numbers < 10
                                        return i;
                                   }
                                   startTime();
                              </script>

                         </div>
                    </header>


                    <ul class="sidebar-nav">
                         <li class="sidebar-item">
                              <a href="<?php echo $dashboard_loc; ?>" class="sidebar-link text-decoration-none link-hover">
                                   <i class="fa fa-solid fa-house"></i>
                                   Dashboard
                              </a>
                         </li>
                         <li class="sidebar-item">
                              <a href="#"
                                   class="sidebar-link collapsed dropdown-toggle flex-row-reverse text-decoration-none link-hover"
                                   data-bs-target="#visitor" data-bs-toggle="collapse" aria-expanded="false"
                                   data-toggle="dropdown"><i class="fa-solid fa-users"></i>
                                   <span class="pe-5">Visitor</span> </a>

                              <ul id="visitor" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $visitor_dir . "visitor.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Visitor</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#report"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#report" data-bs-toggle="collapse" aria-expanded="false"><i
                                        class="fa-solid fa-address-book"></i>
                                   <span class="pe-5">Report</span>
                              </a>

                              <ul id="report" class="sidebar-dropdown list-unstyled collapse ms-5" data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $report_dir . "advance_report.php"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Advance Report</a>
                                   </li>
                              </ul>
                         </li>

                         <li class="sidebar-item">
                              <a href="#setting"
                                   class="sidebar-link collapsed dropdown-toggle text-decoration-none link-hover"
                                   data-bs-target="#setting" data-bs-toggle="collapse" aria-expanded="false">
                                   <i class="fa-solid fa-gear"></i>
                                   <span class="pe-5">Settings</span>
                              </a>

                              <ul id="setting" class="sidebar-dropdown list-unstyled collapse ms-5"
                                   data-bs-parent="#sidebar">
                                   <li class="sidebar-item">
                                        <a href="<?php echo $setting_dir . "?s=main"; ?>"
                                             class="sidebar-link text-decoration-none link-hover">Settings</a>
                                   </li>
                              </ul>
                         </li>
                    </ul>
                    <footer class="px-3">
                         <div class="navbar-header m-auto border border-bottom border-dark border-opacity-25 border-3 w-100"
                              height="30">
                              <!-- <a href="https://manasvi.tech/" class="w-100 bg-white" height="30" width="250"> -->
                                   <img src="<?php echo $images_dir . 'manasvilogo.png'; ?>" alt="" class="img-fluid w-100 bg-white"
                                        height="30" width="250"><!-- ../assets/imgs/manasvilogo.jpeg -->
                              <!-- </a> -->
                         </div>
                         <div class="navbar-header m-auto w-100" height="30">
                              <p class="fs-2 text-center text-danger">
                                   <span><span id="dayscount">
                                             <?php echo "$remaindays"; ?>
                                        </span> days remaining for license to expire</span>
                              </p>
                         </div>
                    </footer>
               </aside>
               <!-- End Sidebar -->
          </div>
     </div>

     <?php

}
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom JavaScript -->
<script>
     $(document).ready(function () {
          $('.sidebar-link').on('click', function () {
               // Close all open dropdowns
               $('.collapse.show').collapse('hide');
          });
     });
</script>