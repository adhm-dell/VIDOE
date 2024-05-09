<?php
require_once '../Controllers/channelController.php';
require_once '../Controllers/channelController.php';
require_once '../Controllers/VideoController.php';
session_start();
$errors = [];
print_r($_SESSION);
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
} else {
    if (!$_SESSION['channel_id']) {
        header('Location: channelForm.php');
    } else {
        $videoController = new VideoController();
        $channelController = new channelController;
        $channel = $channelController->getChannelData($_SESSION['channel_id']);
        $channelVideos = $channelController->getChannelVidoes($_SESSION['channel_id']);
        if (isset($_GET['video_id_']) && $_GET['video_id_'] != '') {
            if ($videoController->deleteVideo($_GET['video_id_'])) {
                header('Location: myChannel.php');
            } else {
                $errors['deleteError'] = 'this video cannot be deleted';
            }
        } else {
            $errors['deleteError'] = 'something went wrong';
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
</head>

<body id="page-top">
    <?php require_once './navbar.php' ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require_once './sidebar.php' ?>
        <div class="single-channel-page" id="content-wrapper">
            <div class="single-channel-image">
                <img class="img-fluid" alt="" src="<?= "assets/cover photos/" . basename($channel[0]['cover_photo']) ?>" style="max-height: 20rem !important; object-fit: cover !important;">
                <div class="channel-profile">
                    <img class="channel-profile-img" alt="" src="<?= "assets/Logo/" . basename($channel[0]['logo']) ?>">
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <h6>Videos</h6>
                            </div>
                        </div>
                        <!-- start listing videos -->
                        <?php foreach ($channelVideos as $video) : ?>
                            <div class="col-xl-3 col-sm-6 mb-3">
                                <div class="video-card">
                                    <div class="video-card-image">
                                        <a class="video-close" href="http://localhost/Vidoe/View/myChannel.php?video_id = <?= $video['id'] ?>"><i class="fas fa-trash"></i></a>
                                        <a class="play-icon" href="http://localhost/Vidoe/View/video-page.php?id=<?= $video['id'] ?>"><i class="fas fa-play-circle"></i></a>
                                        <a href="http://localhost/Vidoe/View/video-page.php?id=<?= $video['id'] ?>"><img class="img-fluid" src="<?= "assets/Thumbnails/" . basename($video['thumbnail']) ?>" alt=""></a>
                                    </div>
                                    <div class="video-card-body">
                                        <div class="video-title">
                                            <a href="http://localhost/Vidoe/View/video-page.php?id=<?= $video['id'] ?>"><?= $video['title'] ?></a>
                                        </div>
                                        <div class="video-page text-success">
                                            <?= $videoController->getVideoCategory($video['category_id'])[0]['name'] ?> <a title="" data-placement="top" data-toggle="tooltip" href="http://localhost/Vidoe/View/video-page.php?id=<?= $video['id'] ?>" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                        </div>
                                        <div class="video-view">
                                            <?= $video['watches'] ?> &nbsp;<i class="fas fa-calendar-alt"></i> <?= $video['upload_date'] ?>
                                        </div>
                                    </div>
                                    <span class="error-message"><?php if (isset($errors["deleteError"])) {
                                                                    echo $errors["deleteError"];
                                                                } ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- ent listing videos -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer ml-0">
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