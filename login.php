<?php include "root.php"; ?>
<!-- including config file to use database -->
<?php include($config_loc); ?>

<!-- php login code here -->
<?php
$sqlr = "SELECT * FROM `licnse` WHERE `activestatus` = 1";
$resr = mysqli_query($connection, $sqlr);

if (mysqli_num_rows($resr) > 0) {
     while ($row = mysqli_fetch_assoc($resr)) {
          $fromdt = $row['fromdt'];
          $expirydt = $row['expirydt'];
          $currentdt = date('Y-m-d');
          $interval = date_diff(date_create($currentdt), date_create($expirydt)); // date_diff()
          $remaindays = 0;
          if ($fromdt <= $currentdt && $currentdt <= $expirydt) {
               $remaindays = number_format($interval->format('%a'));
          }
          if ($remaindays <= 0) {
               header("Location: licensekey.php");
               // license expired
          }
     }
} else {
     header("Location: licensekey.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //isset($_POST['login'])
     $username = $_POST['username'];
     $password = md5($_POST['password']);

     if (isLoginTableEmpty()) {

          $sql = "SELECT `id`, `access`, `username`, `password` FROM `login` WHERE `username` = '$username'";
          $res = mysqli_query($connection, $sql);

          $sqlr = "SELECT * FROM `licnse` WHERE `activestatus` = 1";
          $resr = mysqli_query($connection, $sqlr);
          if (mysqli_num_rows($resr) > 0) {
               while ($row = mysqli_fetch_assoc($resr)) {
                    $fromdt = $row['fromdt'];
                    $expirydt = $row['expirydt'];
                    $currentdt = date('Y-m-d');
                    $interval = date_diff(date_create($currentdt), date_create($expirydt)); // date_diff()
                    $remaindays = 0;
                    if ($fromdt <= $currentdt && $currentdt <= $expirydt) {
                         $remaindays = number_format($interval->format('%a'));
                    }
                    $_SESSION['remaindays'] = $remaindays;
                    if ($remaindays > 0) {
                         if ($res && mysqli_num_rows($res) > 0) {
                              // $_SESSION['username'] = $username; // Set session variable for username
                              // while ($row = mysqli_fetch_assoc($res)) {
                              $row = mysqli_fetch_assoc($res);
                              if ($username == $row['username'] && $password == $row['password']) {
                                   $_SESSION['access'] = $row['access']; // Set session variable for access
                                   $_SESSION['username'] = $username; // Set session variable for username
                                   $_SESSION['user'] = $username;
                                   $_SESSION['pass'] = $password;
                                   header("Location: dashboard.php");
                              } else {
                                   echo "<script>alert('Invalid details !!!')</script>";
                                   // header("Location: tryLoginAgain.php");
                              }
                         }else{
                              echo "<script>alert('Invalid details !!!')</script>";
                         }
                    } else {
                         header("Location: licensekey.php");
                         // echo "<script>alert('License expired');</script>";
                    }
               }
          }

     } else {
          // insert query
          $p = md5("admin");
          $sql = "INSERT INTO `login`(`id`, `username`, `password`, `access`) VALUES (1, 'admin','$p', 'admin')";
          $res = mysqli_query($connection, $sql);
          if ($res) {
                                                  $_SESSION['access'] = $row['access']; // Set session variable for access
               $_SESSION['username'] = $username; // Set session variable for username
               $_SESSION['user'] = $username;
               $_SESSION['pass'] = $password;
               header("Location: dashbaord.php");
          } else {
               echo "<script>Failed to create new login</script>";
          }
     }
}

function isLoginTableEmpty(){     // true if record found | false if no data
     global $connection;
     $sql = "SELECT * FROM `login`";
     $res = mysqli_query($connection, $sql);
     if(mysqli_num_rows($res) > 0){
          return true;
     }else{
          return false;
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title id="page-title"></title>
     <!-- including external links -->
     <?php include($external_links_loc); ?>

     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">

     <style>
          .set-bg {
               background-color: #493cff;
          }
     </style>

</head>


<body>

     <!-- content for login page -->
     <section class="container-fluid set-bg">
          <p class="mt-1 h2 fw-bold text-center text-white"><span class="text-uppercase">HPCL INOUT SYSTEM</span></p>
     </section>

     <section class="container-fluid mt-5 ">
          <div class="d-flex justify-content-center row">
               <div class="login-form-div col-lg-5">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="loginform"
                         class="set-bg d-block px-3 rounded">
                         <div class="label">
                              <p class="text-left h1 fw-bold"><span
                                        class="border-bottom border-light border-4 pb-2">Login&nbsp;&nbsp;</span></p>
                         </div>
                         <div class="d-none" id="error-box">
                              <div class="alert alert-danger">
                                   <strong>Error:</strong> <span id="error-msg">Password not matched</span>
                              </div>
                         </div>
                         <div class="fields mx-2 pb-5">
                              <div class="usernamefield">
                                   <p class="fs-4 fw-bold text-white"><label for="#user-field">Username</label></p>
                                   <input type="text" name="username" id="userfield" class="form-control bg-white">
                              </div>

                              <div class="passwordfield mt-3">
                                   <p class="fs-4 fw-bold text-white"><label for="#password">Password</label></p>
                                   <div class="d-flex">
                                        <input type="password" name="password" id="password"
                                             class="form-control bg-white">
                                        <span class="toggle-password mt-2 ms-3" id="togglePassword" height='30'
                                             width='30'>
                                             <i class="fa-solid fa-eye" style="color: white"></i>
                                        </span>
                                   </div>
                              </div>

                              <div class="login-btn mt-3">
                                   <button name="login" onclick="validateForm()" id="submitbtn"
                                        class="btn btn-light">Login</button>
                                   <!-- <input type="submit" value="Login" name="login" onclick="validateForm()" id="submitbtn" class="btn btn-light"> -->
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </section>

     <script>

          // loginform = document.getElementById('loginform');
          subbtn = document.getElementById('submitbtn');
          function validateForm() {
               if (document.getElementById('userfield').value == "") {
                    alert('Enter Username !!!');
               } else if (document.getElementById('password').value == "") {
                    alert('Enter Password !!!');
               } else {
                    document.getElementById('loginform').submit();
               }
          }


          // document.addEventListener("DOMContentLoaded", function () {
          const passwordField = document.getElementById("password");
          const togglePassword = document.getElementById("togglePassword");

          togglePassword.addEventListener("click", function () {
               // Toggle the type attribute
               const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
               passwordField.setAttribute("type", type);

               // Toggle the icon
               // this.textContent = type === "password" ? "<i class='fa-solid fa-eye-slash'></i>" : "<i class='fa-solid fa-eye' style='color: white'></i>";
          });
          // });

     </script>
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | Login";
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
          document.getElementById('sidebar-toggle').addEventListener('click', function () {
               document.querySelector('.wrapper').classList.toggle('sidebar-open');
               document.querySelector('.wrapper').classList.toggle('sidebar-closed');
          });
     </script>
</body>

</html>