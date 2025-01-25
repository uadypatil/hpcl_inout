     <!-- container-fluid -->
     <!-- including content for dashboard -->

     <!-- <div class="container-fluid"> -->
     <div class="container-fluid">
     <div class="bg-secondary d-flex justify-content-between mb-3 rounded">
          <div class="logo-div pt-2 pb-2 ps-2">
               <a href="">
                    <img src="https://manasvi.tech/demo/assest/img/logos/hpcl_logo.png" alt="" class="rounded img-fluid"
                         style="height: 40px; background-color: #bababa;">
               </a>
          </div>
          <div class="title-div">
               <p class="text-center align-center mt-4">
                    <span class="label label-default fs-4 bg-danger"><?php echo "Assembly Gate"; ?></span>
               </p>
          </div>
          <div class="time-div">
               <p class="text-light text-center mt-3 me-3 fs-2 ">&nbsp;<span id="digiclock"
                         class="fs-3 fw-normal bg-primary label label-default"></span></p>
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
                              "NOW: " + dateString + " " + "@" + " " + h + ":" + m + ":" + s;
                         var t = setTimeout(startTime, 500);
                    }
                    function checkTime(i) {
                         if (i < 10) { i = "0" + i; }  // add zero in front of numbers < 10
                         return i;
                    }
                    startTime();
               </script>
          </div>
     </div>

     <!-- container-fluid -->
     <div class="row mb-2">
          <form action="" method="post" class="col-lg-12 mb-3">
               <input type="text" name="qr-field" id="qr-field" placeholder="Your QR code" class="form-control"
                    oninput="this.form.submit()"> <!-- checkqr(); -->
          </form>
          <!-- <button class="form-control btn btn-outline-dark p-0 ">Reset Count</button> -->
     </div>
     <div class="row">
          <div class="col-12">
               <div id="error-box" class="alert-box alert alert-danger alert-dismissible fade in">
                    <!-- <a href="<?php // echo $filename; ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close" onclick="window.location.replace('<?php echo $filename; ?>')">&times;</button>
                    <!-- </a> -->
                    <strong id="stre"></strong> <span>
                         <?php echo $error_message; ?>
                    </span>
               </div>
               <div id="success-box" class="alert-box alert alert-success alert-dismissible fade in">
                    <!-- <a href="<?php // echo $filename; ?>"> -->
                         <button class="close" data-dismiss="alert" aria-label="close" onclick="window.location.replace('<?php echo $filename; ?>')">&times;</button>
                    <!-- </a> -->
                    <strong id="strs"></strong> <span>
                         <?php echo $error_message; ?>
                    </span>
               </div>
          </div>
     </div>

</div>


     <div class="container-fluid ps-5 pe-5 pt-5"><!-- ps-5 pe-5 -->
     <!-- main gate section -->
     <div class="">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-primary">Main Gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col -->
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $maingate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $maingate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $maingate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $maingate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo ($maingate_operation_count + $maingate_driver_count + $maingate_project_count + $maingate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- main gate section ends here -->


     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-danger">License Area</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $licensegate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $licensegate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $licensegate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $licensegate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo ($licensegate_operation_count + $licensegate_driver_count + $licensegate_project_count + $licensegate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-warning">Driver Gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $drivergate_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $drivergate_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $drivergate_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $drivergate_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo ($drivergate_operation_count + $drivergate_driver_count + $drivergate_project_count + $drivergate_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Assembmly gate count displaying -->
     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-dark"> Assembly gate</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $assembly_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $assembly_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $assembly_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $assembly_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo ($assembly_operation_count + $assembly_driver_count + $assembly_project_count + $assembly_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- rows -->
          </div>
     </div>
     <!-- </div> -->

     <div class="mt-4">
          <p class="text-center">
               <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
               <span class="label label-default fs-4 bg-success">De-License Area</span>
          </p>

          <!-- rows -->
          <div class="row row-cols-5">
               <div class="col mb-3">
                    <!-- col-sm-2 -->

                    <div class="card pe-2">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9 pe-0">
                                        <p class="card-title fs-4 fw-bolder text-danger">OPERATION</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $delicense_operation_count; ?>
                                             </span></p>

                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $delicense_driver_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-truck"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-warning">PROJECT</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $delicense_project_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2 pe-4">
                                        <span><i class="fa-solid fs-1 fa-id-card"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo $delicense_visitor_count; ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <span><i class="fa-solid fs-1 fa-users"></i></span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col mb-3">
                    <!-- col-sm-2 -->
                    <div class="card pe-3">
                         <div class="card-body">
                              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                              <div class="row">
                                   <div class="col-9">
                                        <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                                        <p><span class="h1 fw-bold">
                                                  <?php echo ($delicense_operation_count + $delicense_driver_count + $delicense_project_count + $delicense_visitor_count); ?>
                                             </span></p>
                                   </div>
                                   <div class="col-3 pt-2">
                                        <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <!-- rows -->
          </div>
     </div>
     <!-- </div> -->
     <!-- container-fluid -->
</div> <!-- container-fluid ends here -->