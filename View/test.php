<?php
require_once '../Controllers/VideoController.php';
require_once '../Controllers/channelController.php';
$videoController = new VideoController();
$channelController = new channelController();

$videos = $videoController->getAllVideos();
$channels = $channelController->getAllChannels();
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
            <div class="top-mobile-search">
               <div class="row">
                  <div class="col-md-12">
                     <form class="mobile-search">
                        <div class="input-group">
                           <input type="text" placeholder="Search for..." class="form-control">
                           <div class="input-group-append">
                              <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- video -->
            <div class="video-block section-padding">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-title">
                        <h6>Featured Videos</h6>
                     </div>
                  </div>
                  <?php foreach ($videos as $video) : ?>
                     <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                           <div class="video-card-image">
                              <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                              <a href="#"><img class="img-fluid" src="<?= "assets/Thumbnails/" . basename($video['thumbnail']) ?>" alt=""></a>
                           </div>
                           <div class="video-card-body">
                              <div class="video-title">
                                 <a href="#"><?= $video['title'] ?></a>
                              </div>
                              <div class="video-page text-success">
                                 <?= $video['name'] ?> <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                              </div>
                              <div class="video-view">
                                 <?= number_format($video['watches'], 0) ?> views &nbsp;<i class="fas fa-calendar-alt"></i> <?= $video['upload_date'] ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
            <!-- /video -->
            <hr class="mt-0">
            <!-- pupular channels -->
            <div class="video-block section-padding">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-title">
                        <h6>Popular Channels</h6>
                     </div>
                  </div>
                  <?php foreach ($channels as $channel) : ?>
                     <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="channels-card">
                           <div class="channels-card-image">
                              <a href="#"><img class="img-fluid" src="<?= "assets/Logo/" . basename($channel['logo']) ?>" alt=""></a>
                              <div class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Subscribe</button></div>
                           </div>
                           <div class="channels-card-body">
                              <div class="channels-title">
                                 <a href="#"><?= $channel['name'] ?></a>
                              </div>
                              <div class="channels-view">
                                 <?= $channel['subscribers'] ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
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
                        <small class="mt-0 mb-0"><a class="text-primary" target="_blank" href="https://www.templatespoint.net/">Templates Point</a>
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