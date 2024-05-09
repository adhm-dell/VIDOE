<?php
require_once '../Controllers/VideoController.php';
require_once '../Controllers/channelController.php';
require_once '../Controllers/DBController.php';
session_start();
$video_id = $_GET['id'];
$videoController = new VideoController;
if (isset($_SESSION['userid'])) {
   $videoController->setView($video_id, $_SESSION['userid']);
}
$channelController = new channelController;
$video = $videoController->getVideoById($video_id);
$category = $videoController->getVideoCategory($video->getCategoryId());
$relatedVideos = $videoController->getRelatedVideos($video->getCategoryId(), $video_id);
$channel = $channelController->getChannelData($video->getChannelId());
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
   <?php require_once './navbar.php'; ?>
   <div id="wrapper">
      <!-- Sidebar -->
      <?php require_once './sidebar.php'; ?>
      <div id="content-wrapper">
         <div class="container-fluid pb-0">
            <div class="video-block section-padding">
               <div class="row">
                  <div class="col-md-8">
                     <!-- played video -->
                     <div class="single-video-left">
                        <div class="single-video">
                           <video width="100%" height="315" src="<?= "assets/Videos/" . basename($video->getVideoUrl()) ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen controls></video>
                        </div>
                        <div class="single-video-title box mb-3">
                           <h2><a href="#"><?= $video->getVideoTitle() ?></a></h2>
                           <p class="mb-0"><i class="fas fa-eye"></i> <?= $video->getViews() ?> views</p>
                        </div>
                        <div class="single-video-author box mb-3">
                           <div class="float-right"><button class="btn btn-danger" type="button">Subscribe</button> <button class="btn btn btn-outline-danger" type="button"><i class="fas fa-bell"></i></button></div>
                           <img class="img-fluid" src="<?= "assets/Logo/" . basename($channel[0]['logo']) ?>" alt="">
                           <p><a href="#"><strong><?= $channel[0]['name'] ?></strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></p>
                           <small>Published on <?= $video->getUploadDate() ?></small>
                        </div>
                        <div class="single-video-info-content box mb-3">
                           <h6>Category : </h6>
                           <p><?= $category[0]['name'] ?></p>
                           <h6>About :</h6>
                           <p><?= $video->getVideoDescription() ?></p>
                        </div>
                        <a href="http://localhost/Vidoe/View/playlists.php?id=<?= $video->getVideoId() ?>" class="btn btn btn-outline-danger" type="button"><i class="fas fa-save"></i></a>
                     </div>
                     <!-- end played video -->
                  </div>
                  <div class="col-md-4">
                     <div class="single-video-right">
                        <div class="row">
                           <div class="col-md-12">
                              <!-- start list -->
                              <?php foreach ($relatedVideos as $relateVideo) : ?>
                                 <div class="video-card video-card-list">
                                    <div class="video-card-image">
                                       <a class="play-icon" href="http://localhost/Vidoe/View/video-page.php?id=<?= $relateVideo['id'] ?>"><i class="fas fa-play-circle"></i></a>
                                       <a href="http://localhost/Vidoe/View/video-page.php?id=<?= $relateVideo['id'] ?>"><img class="img-fluid" src="<?= "assets/Thumbnails/" . basename($relateVideo['thumbnail']) ?>" alt=""></a>
                                    </div>
                                    <div class="video-card-body">
                                       <div class="video-title">
                                          <a href="http://localhost/Vidoe/View/video-page.php?id=<?= $relateVideo['id'] ?>"><?= $relateVideo['title'] ?></a>
                                       </div>
                                       <div class="video-page text-success">
                                          <?= $category[0]['name'] ?> <a title="" data-placement="top" data-toggle="tooltip" href="http://localhost/Vidoe/View/video-page.php?id=<?= $relateVideo['id'] ?>" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                       </div>
                                       <div class="video-view">
                                          <?= $relateVideo['watches'] ?> &nbsp;<i class="fas fa-calendar-alt"></i> <?= $relateVideo['upload_date'] ?>
                                       </div>
                                    </div>
                                 </div>
                              <?php endforeach; ?>
                              <!-- end list -->
                           </div>
                        </div>
                     </div>
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