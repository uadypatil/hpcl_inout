<!-- <div class="container-fluid"> -->
<!-- container-fluid -->
<div class="row">
  <div class="col-sm-5">
    <div class="success-alert alert alert-success" role="alert">
      <span id="alert-msg-success"></span>
    </div>
    <div class="danger-alert alert alert-danger" role="alert">
      <span id="alert-msg-danger"></span>
    </div>

  </div>
  <div class="col-sm-7">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
      <div class="col-6">
        <input type="password" name="reset-pass" placeholder="Reset Count" class="form-control">
        <!-- <button class="form-control btn btn-outline-dark p-0 ">Reset Count</button> -->
      </div>
      <div class="col-6">
        <button type="submit" name="reset-btn" class="form-control btn btn-success">
          <i class="fa-solid fa-arrows-rotate"></i>&nbsp;<span>Reset</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- main gate section -->
<div class="content mt-3">
  <p>
    <span class="h4">TOTAL <span class="fw-bolder">IN </span>COUNT </span>
    <span class="label label-default fs-4 bg-primary">Main Gate</span>
  </p>

  <div class="row d-flex flex-row justify-content-between">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-3 pe-3">
      <div class="card pe-2 p-3 ps-0">
        <div class="card-body">
          <a href="infomore.php?type=operation&gate=main" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                <p>
                  <span class="h1 fw-bold text-dark">
                    <?php echo $maingate_operation_count; ?>
                  </span>
                </p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=driver&gate=main" class="text-decoration-none text-dark">
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            <div class="d-flex justify-content-between"><!-- row -->
              <div class="">
                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                <p><span class="h1 fw-bold">
                    <?php echo $maingate_driver_count; ?>
                  </span></p>
              </div>
              <div class="pt-2">
                <span><i class="fa-solid fs-1 fa-truck"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=project&gate=main" class="text-decoration-none text-dark">
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                <p><span class="h1 fw-bold">
                    <?php echo $maingate_project_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2 pe-4">
                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">

          <a href="infomore.php?type=visitor&gate=main" class="text-decoration-none text-dark">
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                <p><span class="h1 fw-bold">
                    <?php echo $maingate_visitor_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-users"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=total&gate=main" class="text-decoration-none text-dark"> -->
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
          <!-- </a> -->
        </div>
      </div>
    </div>

  </div>
</div>

<!-- main gate section ends here -->

<div class="content mt-3">
  <p>
    <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
    <span class="label label-default fs-4 bg-danger">License Area</span>
  </p>
  <div class="row d-flex flex-row justify-content-between">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <div class="card pe-2 p-3 ps-0">
        <div class="card-body">
          <a href="infomore.php?type=operation&gate=license" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="pe-0">
                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                <p><span class="h1 fw-bold">
                    <?php echo $licensegate_operation_count; ?>
                  </span></p>

              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=driver&gate=license" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                <p><span class="h1 fw-bold">
                    <?php echo $licensegate_driver_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-truck"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=project&gate=license" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                <p><span class="h1 fw-bold">
                    <?php echo $licensegate_project_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2 pe-4">
                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=visitor&gate=license" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                <p><span class="h1 fw-bold">
                    <?php echo $licensegate_visitor_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-users"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=total&gate=license" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                <p><span class="h1 fw-bold">
                    <?php echo ($licensegate_operation_count + $licensegate_driver_count + $licensegate_project_count + $licensegate_visitor_count); ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- driver gate section 'drivergate' -->
<div class="content mt-3">
  <p>
    <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
    <span class="label label-default fs-4 bg-warning">Driver Gate</span>
  </p>
  <div class="row d-flex flex-row justify-content-between">

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->

      <div class="card pe-2 p-3 ps-0">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation&gate=driver" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="pe-0">
                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                <p><span class="h1 fw-bold">
                    <?php echo $drivergate_operation_count; ?>
                  </span></p>

              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <a href="infomore.php?type=driver&gate=driver" class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                <p><span class="h1 fw-bold">
                    <?php echo $drivergate_driver_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-truck"></i></span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=driver&gate=driver" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                <p><span class="h1 fw-bold">
                    <?php echo $drivergate_project_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2 pe-4">
                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=visitor&gate=driver" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                <p><span class="h1 fw-bold">
                    <?php echo $drivergate_visitor_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-users"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=total&gate=driver" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title text-danger fs-4 fw-bolder">TOTAL</p>
                <p><span class="h1 fw-bold">
                    <?php echo ($drivergate_operation_count + $drivergate_driver_count + $drivergate_project_count + $drivergate_visitor_count); ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <!-- <span><i class="fa-solid fa-calendar-days"></i></span> -->
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- de-license gate section -->
<div class="content mt-3">
  <p>
    <span class="h4">TOTAL <span class="fw-bolder">IN</span> COUNT</span>
    <span class="label label-default fs-4 bg-success">De-License Area</span>
  </p>

  <div class="row d-flex flex-row justify-content-between">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->

      <div class="card pe-2 p-3 ps-0">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation&gate=delicense" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                <p><span class="h1 fw-bold">
                    <?php echo $delicense_operation_count; ?>
                  </span></p>

              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=driver&gate=delicense" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                <p><span class="h1 fw-bold">
                    <?php echo $delicense_driver_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-truck"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=project&gate=delicense" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                <p><span class="h1 fw-bold">
                    <?php echo $delicense_project_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2 pe-4">
                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=visitor&gate=delicense" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-muted ">VISITOR</p>
                <p><span class="h1 fw-bold">
                    <?php echo $delicense_visitor_count; ?>
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-users"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
      <!-- col-sm-2 -->
      <div class="card pe-3 p-3">
        <div class="card-body">
          <!-- <a href="infomore.php?type=total&gate=delicense" class="text-decoration-none text-dark"> -->
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
          <!-- </a> -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <p><span class="h4">TOTAL STAFF</span> <span class="label label-default fs-4 bg-info">Total Staff</span></p>
  <div class="row d-flex flex-row justify-content-between">
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
      <div class="card">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-danger pe-3">OPERATION</p>
                <p><span class="h1 fw-bold">
                  <?php echo $totalOperationStaffCount; ?>&nbsp;
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-calendar-days"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
      <div class="card">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-primary">DRIVER</p>
                <p><span class="h1 fw-bold">
                  <?php echo $totalDriverStaffCount; ?>&nbsp;
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-truck"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
      <div class="card">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-warning pe-3">PROJECT</p>
                <p><span class="h1 fw-bold">
                  <?php echo $totalProjectStaffCount; ?>&nbsp;
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-id-card"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
      <div class="card">
        <div class="card-body">
          <!-- <a href="infomore.php?type=operation" class="text-decoration-none text-dark"> -->
            <div class="d-flex justify-content-between">
              <div class="">
                <p class="card-title fs-4 fw-bolder text-muted">VISITOR</p>
                <p><span class="h1 fw-bold">
                  <?php echo $totalVisitorStaffCount; ?>&nbsp;
                  </span></p>
              </div>
              <div class="col-3 pt-2">
                <span><i class="fa-solid fs-1 fa-users"></i></span>
              </div>
            </div>
          <!-- </a> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- </div> -->
<!-- container-fluid -->