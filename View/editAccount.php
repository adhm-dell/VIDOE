<?php
require_once "../Models/User.php";
require_once '../Controllers/Validator.php';
require_once '../Controllers/FormProcessor.php';
require_once '../Controllers/Auth.php';

$user = new User();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_POST);
    if (isset($_POST['username'])) {
        $user->setUsername($_POST['username']);
    }
    if (isset($_POST['email'])) {
        $user->setUsername($_POST['email']);
    }
    if (isset($_POST['country'])) {
        $user->setUsername($_POST['country']);
    }
    if (isset($_FILES['pic'])) {
        $path = __DIR__ . "\\assets\\Profile pictures\\"  . $_FILES['pic']['name'];
        move_uploaded_file($_FILES['pic']['tmp_name'], $path);;
        $user->setPic($path);
    }
    $auth = new Auth();
    echo $auth->editAccount($user);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>VIDOE - Video Streaming Website HTML Template</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/osahan.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
</head>

<body id="page-top">
    <?php require_once './navbar.php' ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require_once './sidebar.php' ?>
        <div id="content-wrapper">
            <div class="container-fluid pb-0">
                <form action="editAccount.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Usrername" name="username">

                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label>country</label>
                        <input type="text" class="form-control" placeholder="Enter your country" name="country">
                    </div>
                    <div class="form-group">
                        <label>Profile picture</label>
                        <input type="file" name="pic" class="form-control">
                        <img class="img-fluid" src="<?= "assets/Thumbnails/" . basename($user->getPic()) ?>" alt="">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Edit account</button>
                    </div>
                </form>

                <hr class="mt-0">

            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            <p class="mt-1 mb-0"><strong class="text-dark">Vidoe</strong>.
                                <small class="mt-0 mb-0"><a class="text-primary" target="_blank" href="https://templatespoint.net/">TemplatesPoint</a>
                                </small>
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
                            <div class="app">
                                <a href="#"><img alt="" src="img/google.png"></a>
                                <a href="#"><img alt="" src="img/apple.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Owl Carousel -->
    <script src="vendor/owl-carousel/owl.carousel.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/custom.js"></script>
</body>

</html>