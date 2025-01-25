



<?php
// $root_dir = "C:\wamp64\www\hpcl_in_out/";          // root location for main folder 
// $local_dir = "http://localhost/hpcl_in_out/";         // localhost directory for main folder
$root_dir = "/home/u242460058/domains/hpclso.in/public_html/hpcl_in_out/"; // root location for main folder 
$local_dir = "https://hpclso.in/hpcl_in_out/"; // localhost directory for main folder

$dashboard_loc = $local_dir."dashboard.php";

$operation_dir = $local_dir."operation/";      // to access operation folder
$driver_dir = $local_dir."driver/";        // to access driver folder
$project_dir = $local_dir."project/";       // to access project folder
$visitor_dir = $local_dir."visitor/";       // to access visitor folder
$report_dir = $local_dir."report/";
$setting_dir = $local_dir."settings/";
// css js, images and qr_code 
$css_js_dir = $local_dir."assets/css_js/";        // to access css_js folder
$images_dir = $local_dir."assets/imgs/";         // to access images folder
$qr_code_dir = $root_dir."assets/qr_codes/";        // to access qr_code folder
$qr_code_lib = $root_dir."assets/phpqr_code/";
$style_css = $css_js_dir."style.css";

$apppath = $root_dir."app/";
$sidebar_loc = $root_dir."app/sidebar.php";       // to access sidebar file
$navbar_loc = $root_dir."app/navbar.php";        // to access navbar file
$config_loc = $root_dir."app/config.php";        // to access config file
$external_links_loc = $root_dir."app/external_links.php";          // to access external links file

$logout_loc = $local_dir."logout.php";      // logout file

?>
