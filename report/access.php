<!-- name: uday anil patil || date: 08-05-2024 -->
<!-- this file only contains theme which can be used in every executing file -->
<!-- start copy file from here -->

<!-- including root file -->
<?php include("../root.php"); ?>
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






if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $access = $_POST['access'];

    $sql = "INSERT INTO `setting`(`name`,`password`,`access`) VALUES('$name', '$password','$access')";
    $res = mysqli_query($connection, $sql);





    if ($res) {
        echo "success";
    } else {
        echo "fail";
    }
}




?>

<body>


    <div class="wrapper d-flex">

        <!-- including sidebar -->
        <?php include($sidebar_loc); ?>

        <div class="container-fluid">
            <!-- including navbar -->
            <?php include($navbar_loc); ?>

            <!-- Page Content -->
            <div class="container-fluid">
                <div class="row pt-4">
                    <!-- Combined Card -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <h1 class="text-center"><i class="fas fa-key"></i>Access</h1>
                            <div class="card-body border">

                                <div class="row">
                                    <!-- Button Card -->
                                    <div class="col-md-3">
                                        <div class="card m-0 shadow">
                                            <div class="card-body">
                                                <div class="d-grid gap-1">
                                                    <a href="settings.php"
                                                        class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        tabindex="-1" role="button"><i
                                                            class="fas fa-user"></i>Profile</a>
                                                    <a href="access.php"
                                                        class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        tabindex="-1" role="button"><i class="fas fa-key"></i>Access</a>

                                                    <a href="#" class="btn btn-outline-primary border-primary mb-3 fs-4"
                                                        tabindex="-1" role="button"><i
                                                            class="fas fa-sync-alt"></i></i>Change Reset</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Form Section -->
                                    <div class="col-md-9">

                                        <form method="post" action="#" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" id="name" name="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password" class="form-label"> Password</label>
                                                        <input type="password" id="password" name="password"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="access" class="form-label"> Access</label>
                                                        <select class="form-select form-control"
                                                            aria-label="Default select example" id="access"
                                                            name="access">
                                                            <option selected>Select</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="officer">Officer</option>
                                                            <option value="security">Security</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center pt-4">
                                                    <button type="submit" name="submit" id="submit"
                                                        onclick="submitdata()" class="btn btn-success px-4"><i
                                                            class="fas fa-plus"></i> Add</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row pt-4">
                                            <div class="col-12">
                                                <div class="card">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Access</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php


                                                                $sql1 = "SELECT * FROM `login`";
                                                                $res1 = mysqli_query($connection, $sql1);
                                                                if ($res1) {
                                                                    $cn = 1;
                                                                    while ($row = mysqli_fetch_assoc($res1)) {
                                                                        $cn++;
                                                                        ?>

                                                                        <td>
                                                                            <?php echo $row['username'] ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['access'] ?>
                                                                        </td>
                                                                        <td><a href="deletesetting.php ?id=<?php echo $row['id']; ?>"
                                                                                class=" text-decoration-none"><button
                                                                                    type="button" class="btn btn-danger"><i
                                                                                        class="fas fa-user-minus"
                                                                                        name="delete"></i>Delete</button></td>
                                                                        </a>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid ends here -->
            <!-- End Page Content -->
        </div>
    </div>

    <!-- Start writing content here -->
    <main>

    </main>



    <!-- giving title to document and navbar -->
    <script>
        document.getElementById('page-title').innerHTML = "HPCL INOUT | Settings";
        document.getElementById('navbar-title').innerHTML = "Settings <i class='fa-solid fa-gear'></i>";
    </script>
    <script>
        function submitdata() {
            const a = document.getElementById('name');
            if (!a) {
                alert("enter the name");
            }
        }
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
</body>

</html>