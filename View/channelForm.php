<!-- الخطأ في السيشنس المتراكمة على بعضها -->

<?php
require_once '../Controllers/Validator.php';
require_once '../Controllers/FormProcessor.php';
require_once '../Controllers/Auth.php';
require_once '../Models/channel.php';
require_once '../Controllers/channelController.php';
session_start();

$requireFields = ['name'];
$processor = new FormProcessor();
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $processor->handleFormSubmission($_POST, $requireFields);
    $errors = $processor->getErrors();
    if (!$errors) {
        $channel = new Channel();
        $controller = new channelController();
        $channel->setName($_POST['name']);
        $channel->setUserId($_SESSION['userid']);
        $channel->setSubscriptions(0);
        if ($_FILES['cover'] != '' && $_FILES['logo'] != '') {
            $coverPath = __DIR__ . "\\assets\\cover photos\\" .  uniqid() . $_FILES['cover']['name'];
            $logoPath = __DIR__ . "\\assets\\logo\\" .  uniqid() . $_FILES['logo']['name'];
            move_uploaded_file($_FILES['cover']['tmp_name'], $coverPath);
            move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath);
            $channel->setLogo($logoPath);
            $channel->setCoverPhoto($coverPath);
            if ($controller->createChannel($channel)) {
                header('Location: myChannel.php');
            } else {
                $errors = $controller->getErrors();
            }
        }
    }
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
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body id="page-top">
    <?php require_once './navbar.php' ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require_once './sidebar.php' ?>
        <div id="content-wrapper">
            <div class="container-fluid upload-details">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="osahan-form">
                            <div class="row">
                                <form method="post" enctype="multipart/form-data" action="channelForm.php">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="e1">Channel name</label>
                                            <input type="text" placeholder="Enter Channel's name" id="e1" class="form-control" name="name">
                                            <span class="error-message"><?php if (isset($errors['name'])) {
                                                                            echo $errors['name'];
                                                                        } ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="e2">Logo</label>
                                            <input id="e2" name="logo" class="form-control" type="file">
                                            <span class="error-message"><?php if (isset($errors['logo'])) {
                                                                            echo $errors['logo'];
                                                                        } ?></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="e4">Cover photo</label>
                                            <input type="file" name="cover" class="form-control" id="e4">
                                            <span class="error-message"><?php if (isset($errors['cover'])) {
                                                                            echo $errors['cover'];
                                                                        } ?></span>
                                        </div>
                                    </div>
                                    <div class="osahan-area text-center mt-3">
                                        <button class="btn btn-outline-primary" type="submit">Create Channel</button>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="terms text-center">
                                <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority <a href="#">Terms of Service</a> and <a href="#">Community Guidelines</a>.</p>
                                <p class="hidden-xs mb-0">Ipsum is therefore always free from repetition, injected humour, or non</p>
                            </div>
                        </div>
                    </div>
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