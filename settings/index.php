<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php");
if (!isset($_SESSION['username'])) {
     header("Location: ../login.php");
     exit();
}
?>
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

     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
     <?php include($config_loc); ?>
</head>
<?php

if (isset($_POST['update-btn'])) {
     $name = $_POST['name'];
     $oldpass = md5($_POST['oldpassword']);
     $newpass = md5($_POST['newpassword']);
     
     $sqla = "SELECT * FROM `login`  WHERE username = '$name' AND password = '$oldpass'";
     $resa = mysqli_query($connection, $sqla);

     if (mysqli_num_rows($resa) > 0) {

     $sql = "UPDATE login SET password='$newpass' WHERE username = '$name' AND password = '$oldpass';";
     $res = mysqli_query($connection, $sql);
     // $row = mysqli_fetch_assoc($res);

     // print_r($row);die;

     if ($res) {
          echo '<script>document.addEventListener("DOMContentLoaded", function() {
               alert("Password Updateed Succesfully");
               // window.location.href = "index.php?s=access";
           });
            </script>';
     }
}
     else{
          echo '<script>document.addEventListener("DOMContentLoaded", function() {
               alert(" old password does not match");
               // window.location.href = "index.php?s=access";
           });
            </script>';
     }

}
if (isset($_POST['add-data'])) {
     $name = $_POST['name'];
     $pass = md5($_POST['password']);
     $access = $_POST['access'];
     $sql = "INSERT INTO login(username, password, access) VALUES ('$name','$pass','$access')";
     $res = mysqli_query($connection, $sql);
     if ($res) {
          echo '<script>document.addEventListener("DOMContentLoaded", function() {
               alert("Data Addes succesfully");
               window.location.href = "index.php?s=access";
           });
            </script>';
       
        } else {
             echo "fail to update data";
        }
     }


if (isset($_POST['change-reset-btn'])) {
     $crbtn = md5($_POST['change-reset-field']);

     if (isResetTableEmpty()) {

          $sql = "UPDATE reset_pass SET password='$crbtn' WHERE id= '1'";
          $res = mysqli_query($connection, $sql);
          if ($res) {
               echo "<script>alert('Changed successfully..');</script>";
          }

     } else {
          // insert query
          $sql = "INSERT INTO reset_pass(id, password) VALUES (1,'$crbtn')";
          $res = mysqli_query($connection, $sql);
          if ($res) {
               echo "<script>alert('Changed successfully..');</script>";
          }
     }
}

function isResetTableEmpty()
{ // true if record found | false if no data
     global $connection;
     $sql = "SELECT * FROM reset_pass";
     $res = mysqli_query($connection, $sql);
     if (mysqli_num_rows($res) > 0) {
          return true;
     } else {
          return false;
     }
}

?>

<body>
     <!-- <script>document.getElementById().style.display = 'none'</script>
<script>document.getElementById().style.display = 'block'</script> -->

     <div class="wrapper d-flex">

          <!-- including sidebar -->
          <?php include($sidebar_loc); ?>

          <div class="container-fluid">
               <!-- including navbar -->
               <?php include($navbar_loc); ?>

               <!-- Page Content -->
               <div class="container-fluid">
                    <div class="row">
                         <!-- Combined Card -->
                         <div class="col-md-12">
                              <div class="card shadow">
                                   <!-- php code here -->
                                   <?php
                                   if (isset($_GET['s'])) {
                                        if ($_GET['s'] == 'main') {
                                             ?>
                                             <h1 class="text-center" id="section-title">
                                                  <i class='fas fa-user'></i>
                                                  <span>Profile</span>
                                             </h1>
                                             <?php
                                        } else if ($_GET['s'] == 'access') {
                                             ?>
                                                  <h1 class="text-center" id="section-title">
                                                       <i class='fas fa-key'></i>
                                                       <span>Access</span>
                                                  </h1>
                                             <?php
                                        } else if ($_GET['s'] == 'reset') {
                                             ?>
                                                       <h1 class="text-center" id="section-title">
                                                            <i class="fas fa-sync-alt"></i></i>
                                                            <span>Change Reset Password</span>
                                                       </h1>
                                             <?php
                                        }
                                   }
                                   ?>
                                   <!-- php code here -->

                                   <div class="card-body border">

                                        <div class="row">

                                             <!-- Button Card -->
                                             <!-- buttons starts here -->
                                             <div class="col-md-3">
                                                  <div class="card m-0 shadow">
                                                       <div class="card-body">
                                                            <div class="d-grid gap-1">
                                                                 <?php
                                                                 if ($_SESSION['access'] == 'admin') {
                                                                      ?>
                                                                      <a href="?s=main"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button">
                                                                           <i class="fas fa-user"></i>Profile</a>
                                                                      <!-- <button type="button" class="btn    btn-outline-primary mb-3"><i class="fas fa-user"></i> Profile</button> -->
                                                                      <a href="?s=access"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button">
                                                                           <i class="fas fa-key"></i>Access</a>

                                                                      <a href="?s=reset"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button">
                                                                           <i class="fas fa-sync-alt"></i></i>Change
                                                                           Reset</a>
                                                                      <?php
                                                                 } elseif ($_SESSION['access'] == 'officer') {

                                                                      ?>
                                                                      <a href="?s=main"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button"><i
                                                                                class="fas fa-user"></i>Profile</a>
                                                                      <!-- <button type="button" class="btn    btn-outline-primary mb-3"><i class="fas fa-user"></i> Profile</button> -->
                                                                      <a href="?s=access"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button"><i
                                                                                class="fas fa-key"></i>Access</a>

                                                                      <a href="?s=reset"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button"><i
                                                                                class="fas fa-sync-alt"></i></i>Change
                                                                           Reset</a>
                                                                      <?php
                                                                 } elseif ($_SESSION['access'] == 'security') {
                                                                      ?>
                                                                      <a href="?s=main"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button"><i
                                                                                class="fas fa-user"></i>Profile</a>

                                                                      <a href="?s=reset"
                                                                           class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                                           tabindex="-1" role="button"><i
                                                                                class="fas fa-sync-alt"></i></i>Change
                                                                           Reset</a>
                                                                      <?php
                                                                 } else {
                                                                      echo "";
                                                                      die;
                                                                 }

                                                                 ?>


                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <!-- buttons ends here -->

                                             <!-- php code here -->
                                             <?php
                                             if (isset($_GET['s'])) {
                                                  if ($_GET['s'] == 'main') {
                                                       ?>
                                                       <!-- Form Section -->
                                                       <!-- profile form starts here -->
                                                       <form method="post" action="" enctype="multipart/form-data"
                                                            class="col-md-9">
                                                            <div class="row">
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label for="name" class="form-label">Name :</label>
                                                                           <input type="text" id="name" name="name"
                                                                                class="form-control"  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'')" placeholder="enter name"
                                                                                value="<?php echo $_SESSION['user'] ?>" readonly>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label for="oldpassword" class="form-label">Old
                                                                                Password :</label>
                                                                           <input type="password" id="oldpassword" required placeholder="Enter Old Password" 
                                                                                name="oldpassword" class="form-control">
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label for="newpassword" class="form-label">New
                                                                                Password :</label>
                                                                           <input type="password" id="newpassword" required placeholder="Enter New Password"
                                                                                name="newpassword" class="form-control">
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="col-md-12 pt-4">
                                                                      <button type="submit" class="btn btn-success"
                                                                           name="update-btn"><i class="fas fa-sync-alt"></i>
                                                                           Change</button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                       <!-- profile form ends here -->

                                                       <?php
                                                  } else if ($_GET['s'] == 'access') {
                                                       ?>

                                                            <!-- access section starts here -->
                                                            <div class="col-md-9" id="access-section">

                                                                 <form method="post" action="" enctype="multipart/form-data" id="myform">
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label for="name" class="form-label">Name :</label>
                                                                                     <input type="text" id="name" name="name"  oninput="this.value=this.value.replace(/[^a-z\sA-Z]/g,'');ws(this.id)"placeholder="Enter the Name" required
                                                                                          class="form-control">
                                                                                          <span id="nameerror" style="color: red;"></span>

                                                                                          
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label for="password" class="form-label">
                                                                                          Password :</label>
                                                                                          <input type="password" id="password" placeholder="Enter Password" oninput="ws(this.id);"
                                                                                          name="password" class="form-control" required>
                                                                                          <span id="passerror" style="color: red;"></span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label for="access" class="form-label">
                                                                                          Access :</label>
                                                                                     <select class="form-select form-control"
                                                                                          aria-label="Default select example"
                                                                                          id="access" name="access" required>
                                                                                          <option value="">Select</option>
                                                                                          <?php
                                                                                          if ($_SESSION['access'] == 'admin') {
                                                                                               ?>
                                                                                               <option value="admin">Admin</option>
                                                                                               <option value="officer">Officer</option>
                                                                                               <option value="security">Security</option>
                                                                                          <?php
                                                                                          } elseif ($_SESSION['access'] == 'officer') {
                                                                                               ?>
                                                                                               <option value="officer">Officer</option>
                                                                                               <option value="security">Security</option>
                                                                                          <?php
                                                                                          } else {
                                                                                               echo "";
                                                                                               die;
                                                                                          } ?>
                                                                                     </select>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 
                                                                      <div class="row">
                                                                           <div class="col-md-12 text-center pt-4">
                                                                                <button type="submit" name="add-data" id="submit"
                                                                                     class="btn btn-success px-4">
                                                                                     <i class="fas fa-plus"></i> Add
                                                                                </button>
                                                                           </div>
                                                                      </div>
                                                                                     </div>
                                                                 </form>
                                                                 <div class="row pt-4">
                                                                      <div class="col-12">
                                                                           <div class="card-body">
                                                                                <table class="table table-responsive">
                                                                                     <thead>
                                                                                          <tr>
                                                                                               <th scope="col" class="text-center">Name</th>
                                                                                               <th scope="col" class="text-center">Access</th>
                                                                                               <th scope="col" class="text-center">Action</th>

                                                                                          </tr>
                                                                                     </thead>
                                                                                     <tbody>
                                                                                          <tr>
                                                                                               <?php
                                                                                               $sql1 = "SELECT * FROM login WHERE status != '0'";
                                                                                               $res1 = mysqli_query($connection, $sql1);
                                                                                               if ($res1) {
                                                                                                    $cn = 1;
                                                                                                    while ($row = mysqli_fetch_assoc($res1)) {
                                                                                                         $cn++;
                                                                                                         ?>

                                                                                                         <td class="text-center">
                                                                                                         <?php echo $row['username'] ?>
                                                                                                         </td>
                                                                                                         <td class="text-capitalize text-center">
                                                                                                         <?php echo $row['access'] ?>
                                                                                                         </td>

                                                                                                         <?php
                                                                                                         if ($_SESSION['access'] == 'admin') {
                                                                                                              ?>
                                                                                                              <td class="text-center">
                                                                                                                   <button class="text-decoration-none btn btn-danger" onclick="deleterecord(<?php echo $row['id']; ?>)">
                                                                                                                        <i class="fa-solid fa-user"></i>
                                                                                                                        <span>Delete</span>
                                                                                                                   </button>
                                                                                                                   <!-- <a href="deletesetting.php ?id=<?php // echo $row['id']; ?>"
                                                                                                                        class=" text-decoration-none btn btn-danger">
                                                                                                                        <i class="fa-solid fa-user"></i>
                                                                                                                        <span>Delete</span>
                                                                                                                   </a> -->
                                                                                                              </td>
                                                                                                         <?php
                                                                                                         } elseif ($_SESSION['access'] == 'officer') {
                                                                                                              ?>
                                                                                                              <td>
                                                                                                              <button class="text-decoration-none btn btn-danger" onclick="deleterecord(<?php echo $row['id']; ?>)">
                                                                                                                        <i class="fa-solid fa-user"></i>
                                                                                                                        <span>Delete</span>
                                                                                                                   </button>     
                                                                                                              <!-- <a href="deletesetting.php ?id=<?php echo $row['id']; ?>"
                                                                                                                        class=" text-decoration-none btn btn-danger disabled">
                                                                                                                        <i class="fa-solid fa-user"></i>
                                                                                                                        <span>Delete</span>
                                                                                                                   </a> -->
                                                                                                              </td>
                                                                                                         <?php
                                                                                                         } else {
                                                                                                              echo "";
                                                                                                              die;
                                                                                                         } ?>
                                                                                                    </tr>
                                                                                          <?php } ?>
                                                                                     <?php } ?>
                                                                                     </tbody>
                                                                                </table>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <!-- access section ends here -->

                                                       <?php
                                                  } else if ($_GET['s'] == 'reset') {
                                                       ?>

                                                                 <!-- Form Section -->
                                                                 <form method="post" action="" enctype="multipart/form-data"
                                                                      class="col-md-9">
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label for="oldpassword" class="form-label">Reset
                                                                                          Password :</label>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <input type="password" id="oldpassword"
                                                                                          name="change-reset-field" class="form-control"
                                                                                          placeholder="Reset Password..">
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <button type="submit"
                                                                                          class="btn btn-success form-control"
                                                                                          name="change-reset-btn">
                                                                                          <i class="fas fa-sync-alt"></i>
                                                                                          <span>Change</span>
                                                                                     </button>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </form>
                                                                 <!-- profile form ends here -->
                                                       <?php
                                                  }
                                             } else {

                                                  ?>
                                                  <!-- 404 error display block -->
                                                  <div class="col-md-9" id="profile-section">
                                                       <div class="card m-0 shadow">
                                                            <div class="card-body">
                                                                 <img src="data:image/jpeg;base64,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"
                                                                      alt="" height="220" width="250" class="d-block m-auto">
                                                                 <p class="fs-4 fw-normal text-center">Invalid Request
                                                                 </p>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <?php
                                             }

                                             ?>



                                        </div>
                                   </div>
                              </div>
                         </div>

                    </div> <!-- container-fluid ends here -->
                    <!-- End Page Content -->
               </div>
          </div>

          <!-- <script>
        function confirmDelete(event) {
        if (confirm("Are you sure you want to drop data?")) {
          
            window.location.href = "amc.php"; 
        } else {
    
            event.preventDefault();
        }
        }
    </script> -->

     <!-- script for deleting record -->
     <script>
               function deleterecord(id) {
               const text = "Delete user!";
               if (confirm(text) == true) {  // OK pressed
                    fetch('deletesetting.php?id=' + id)
                    .then(response => {
                         if (!response.ok) {
                              throw new Error('Network response was not ok');
                         }
                         return response.json();
                    })
                    .then(data => {
                         if (data.message === "data deleted") {
                              alert("Record deleted");
                              location.reload();  // Reload the page after the alert
                         } else {
                              alert("Record not deleted. Please try again.");
                         }
                    })
                    .catch(error => {
                         console.error('There was a problem with the fetch operation:', error);
                         alert('There was a problem deleting the record. Please try again later.');
                    });
               }
          }

          </script>


          <!-- giving title to document and navbar -->
          <script>
               document.getElementById('page-title').innerHTML = "HPCL INOUT | Settings";
               document.getElementById('navbar-title').innerHTML = "Settings <i class='fa-solid fa-gear'></i>";
          </script>

          <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
               crossorigin="anonymous"></script>

          <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
          <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-NZA+MOJ7ckuDwH/Bpq3UL8uU8v4/UpxF0B/Uw9Js5PntSAfMR0J4caB+FVFVlZ9J"
               crossorigin="anonymous"></script>
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

          <script>
          function ws(name) { 
               var name=document.getElementById(name);
               name.value = name.value.replace(/^\s+/, '');

               }






               var nameField = document.getElementById("name");
               var passField = document.getElementById("password");


               nameField.addEventListener("input", validateName);
               passField.addEventListener("input", validatePass);


               function validateName() {
               var fullname = nameField.value;
               var errorElement = document.getElementById("nameerror");

               if (fullname.trim()=="") {
                    errorElement.textContent = "Fill Out This Field";
                    nameField.classList.add("invalid");
                    return false;
               } 
               else{
                    errorElement.textContent = "";
                    nameField.classList.remove("invalid");
               return true;

               }
          }

          function validatePass() {
               var name = passField.value;
               var errorElement = document.getElementById("passerror");

               if (name.trim()=="") {
                    errorElement.textContent = "Fill Out This Field";
                    passField.classList.add("invalid");
                    return false;
               } 
               else{
                    errorElement.textContent = "";
                    passField.classList.remove("invalid");
               return true;

               }
          }

          const form  = document.getElementById('myform');
    //console.log("sahil");


    form.addEventListener('submit', (event) => {
        // handle the form data            event.preventDefault();
        // event.preventDefault();        
          if(!validateName() || !validatePass()){
          event.preventDefault();
          }
          
      
    });

          </script>
</body>

</html>