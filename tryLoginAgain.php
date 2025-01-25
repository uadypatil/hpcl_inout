<!-- including root file -->
<?php include("root.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>

     <link rel="icon" href="../../assest/img/logos/hp.png" type="image/gif" sizes="16x16">
     <!-- including external links -->
     <?php include($external_links_loc); ?>
     <!-- stylesheet files -->
     <link rel="stylesheet" href="<?php echo $css_js_dir . 'style.css'; ?>">
     <link rel="stylesheet"
          href="<?php //echo 'http://localhost\eaglebyte\hpcl_in_out\hpcl_in_out\assets\css_js\style.css'; ?>">

</head>

<body>
     <div class="container">
          <div class="mt-5">
               <div class="row justify-content-center">
                    <div class="col-6">
                         <img srcset="https://static.vecteezy.com/system/resources/previews/008/568/878/non_2x/website-page-not-found-error-404-oops-worried-robot-character-peeking-out-of-outer-space-site-crash-on-technical-work-web-design-template-with-chatbot-mascot-cartoon-online-bot-assistance-failure-vector.jpg 1470w, https://static.vecteezy.com/system/resources/previews/008/568/878/large_2x/website-page-not-found-error-404-oops-worried-robot-character-peeking-out-of-outer-space-site-crash-on-technical-work-web-design-template-with-chatbot-mascot-cartoon-online-bot-assistance-failure-vector.jpg 2940w"
                              alt="" class="img-responsive">
                    </div>
               </div>

               <div class="row justify-content-center">
                    <div class="col-6 alert alert-danger">
                         <p class="fs-3"><span>Username or password may invalid</span></p>
                         <!-- <p class="fs-3"><span><?php // echo $_GET['p'];?></span></p> -->
                         <p class="fs-3 fw-bold">
                              <a href="login.php" class="text-danger text-decoration-underline">
                                   <span>Try Login Again..</span>
                              </a>
                         </p>
                    </div>
               </div>
          </div>
     </div>

</body>

</html>