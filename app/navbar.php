<!-- date: 9-5-24 || name: shubham chhanwal -->
<!-- this file contains code of navbar -->

<!-- Navbar Container -->
<div class="navbar-container">
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
               <!-- class="container-fluid" -->
               <!-- Toggle Sidebar Button -->
               <button class="btn" id="sidebar-toggle">
                    <i class="fas fa-bars text-primary" style="font-size: 22px;"></i>
               </button>

               <!-- Officer Text -->
               <p class="navbar-brand m-auto"><span class="fs-1 fw-bolder text-capitalize" id="navbar-title"></span></p>

               <!-- Navbar admin titme and logout button -->
               <div class="ms-auto">
                    <ul class="nav">
                         <li class="nav-item">
                              <a class="mt-2 mb-3 text-decoration-none disabled" style="pointer-events: none; cursor: default;">
                                   <span class="text-capitalize"><?php echo $_SESSION['username']; ?></span>
                              </a>
                         </li>
                         <li class="nav-item">
                              <a href="<?php echo $logout_loc; ?>" class="nav-link btn btn-danger btn-sm mt-2 mb-3 align-center">Logout</a>
                         </li>
                    </ul>
               </div>

          </div>
     </nav>
     <!-- End Navbar -->
</div>
<!-- <script>
// JavaScript to toggle sidebar
       document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
</script> -->
<!-- End Navbar Container -->