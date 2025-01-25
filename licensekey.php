<?php include "root.php"; ?>

<!-- including config file to use database -->
<?php include($config_loc); ?>

<!-- php login code here -->
<?php
$product = "hpcl sinnar";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_FILES['licensekey'])) {

          $plantname = $_POST['plantname'];

          $sql = "SELECT * FROM `licnse` WHERE `activestatus` = 1";
          $res = mysqli_query($connection, $sql);
          // $tmpFilePath = $_FILES['licensekey'];
          $tmpFilePath = $_FILES['licensekey']['tmp_name'];
          $license_key = file_get_contents($tmpFilePath);
          if (mysqli_num_rows($res) > 0) {
               while ($row = mysqli_fetch_assoc($res)) {
                    if ($plantname == $row['plantname'] && $license_key == $row['licensekey']) {
                         $_SESSION['plantname'] = $plantname;
                         $fromdt = $row['fromdt'];
                         $expirydt = $row['expirydt'];
                         $currentdt = date('Y-m-d');
                         $interval = date_diff(date_create($currentdt), date_create($expirydt)); // date_diff()
                         $remaincount = $interval->format('%a');
                         if ($fromdt < $currentdt && $currentdt < $expirydt) {
                              header("Location: login.php");
                              // echo "<script>alert('License not expired! date: $currentdt days remaining:$remaincount');</script>";
                         } else {
                              // echo "License expired!";
                              //echo "<script>alert('License expired! date: $currentdt');</script>";
                         }

                         // header("Location: dashboard.php");
                    } else {
                         echo "<script>alert('Invalid details !!!')</script>";
                    }
               }
          }else{
               echo "<script>alert('License expired!')</script>";
          }
     } else {
          echo "<script>alert('License key not chosen!')</script>";
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
     <link rel="stylesheet" href="<?php // echo $css_js_dir . 'style.css'; ?>">
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
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                         enctype="multipart/form-data" id="loginform" class="set-bg d-block px-3 rounded">
                         <div class="label">
                              <p class="text-left text-light h1 fw-bold"><span
                                        class="border-bottom border-light border-4 pb-2">License Key&nbsp;&nbsp;</span>
                              </p>
                         </div>
                         <div class="d-none" id="error-box">
                              <div class="alert alert-danger">
                                   <strong>Error:</strong> <span id="error-msg">license-key not matched</span>
                              </div>
                         </div>
                         <div class="fields mx-2 pb-5">
                              <div class="plantnamefield">
                                   <p class="fs-4 fw-bold text-white"><label for="#user-field">Plant name</label></p>
                                   <input type="text" name="plantname" id="userfield" class="form-control bg-white" required>
                              </div>

                              <div class="license-keyfield mt-3">
                                   <p class="fs-4 fw-bold text-white"><label for="#license-key">License key</label></p>
                                   <div class="d-flex">
                                        <input type="file" name="licensekey" id="license-key"
                                             class="form-control bg-white" accept=".txt" required>
                                   </div>
                              </div>

                              <div class="login-btn mt-3">
                                   <button type="submit" name="login" id="submitbtn"
                                        class="btn btn-light">Submit</button>
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
                    alert('Enter plantname !!!');
               } else {
                    document.getElementById('loginform').submit();
               }

               // else if (document.getElementById('license-key').value == "") {
               //      alert('Enter license-key !!!');
               // }
          }


          // document.addEventListener("DOMContentLoaded", function () {
          const license_keyField = document.getElementById("license-key");
          const togglelicense_key = document.getElementById("togglelicense-key");

          togglelicense_key.addEventListener("click", function () {
               // Toggle the type attribute
               const type = license - keyField.getAttribute("type") === "license-key" ? "text" : "license-key";
               license_keyField.setAttribute("type", type);

               // Toggle the icon
               // this.textContent = type === "password" ? "<i class='fa-solid fa-eye-slash'></i>" : "<i class='fa-solid fa-eye' style='color: white'></i>";
          });
          // });

     </script>
     <script>
          document.getElementById('page-title').innerHTML = "HPCL INOUT | License Key";
     </script>


     <!-- Bootstrap JS (optional, only needed if you use Bootstrap components that require JavaScript) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

     <!-- Font Awesome JS (optional, only needed if you use Font Awesome icons) -->
     <script src="https://kit.fontawesome.com/6ee00b2260.js" crossorigin="anonymous"></script>
</body>

</html>

<!-- $sqlr = "SELECT * FROM `licnse` WHERE `activestatus` = 1";
               $resr = mysqli_query($connection, $sqlr);
               if ($resr) {
                    while ($row = mysqli_fetch_assoc($resr)) {
                         $fromdt = $row['fromdt'];
                         $expirydt = $row['expirydt'];
                         $currentdt = date('Y-m-d');
                         $interval = date_diff(date_create($currentdt), date_create($expirydt)); // date_diff()
                         $remaindays = number_format($interval->format('%a'));
                         $_SESSION['remaindays'] = $remaindays;
                    }
               } -->