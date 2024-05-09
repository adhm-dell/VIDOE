<?php
require_once '../Controllers/Validator.php';
require_once '../Controllers/FormProcessor.php';
require_once '../Models/Video.php';
require_once '../Controllers/VideoController.php';
require_once '../Controllers/DBController.php';

$requiredFields = ['title', 'description', 'category'];
$processor = new FormProcessor();
$errors = array();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if (isset($_SESSION['channel_id']) && $_SESSION['channel_id'] != null && isset($_SESSION['userid'])) {
      $processor->handleFormSubmission($_POST, $requiredFields);
      $errors = $processor->getErrors();
      if (!$errors) {
         $videoController = new VideoController();
         $video = $videoController->setVideoData($_POST);
         if ($_FILES['video'] != '' && $_FILES['thumbnail'] != '') {
            $video_path = __DIR__ . "\\assets\\Videos\\" .  uniqid() . $_FILES['video']['name'];
            $thumbnail_path = __DIR__ . "\\assets\\Thumbnails\\" . uniqid() . $_FILES['thumbnail']['name'];
            move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_path);
            $video->setVideoThumbnail($thumbnail_path);
            $video->setVideoUrl($video_path);
            if ($videoController->createVideo($video)) {
               header('Location: index.php');
            } else {
               $errors = $videoController->getVideoErrors();
            }
         } else {
            $errors['thumbnail'] = "Thumbnail is required";
            $errors['video'] = "Video is required";
         }
      }
   } else {
      header('Location: channelForm.php');
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
   <?php require_once './navbar.php'; ?>
   <div id="wrapper">
      <!-- Sidebar -->
      <?php require_once './sidebar.php'; ?>
      <div id="content-wrapper">
         <div class="container-fluid upload-details">
            <div class="row">
               <div class="col-lg-12">
                  <div class="osahan-form">
                     <div class="row">
                        <form method="post" enctype="multipart/form-data" action="upload-video.php">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="e1">Video Title</label>
                                 <input type="text" placeholder="Enter Video's title" id="e1" class="form-control" name="title">
                                 <span class="error-message"><?php if (isset($errors["title"])) {
                                                                  echo $errors["title"];
                                                               } ?></span>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="e2">About</label>
                                 <input id="e2" name="description" class="form-control" placeholder="Enter Video's description">
                                 <span class="error-message"><?php if (isset($errors["description"])) {
                                                                  echo $errors["description"];
                                                               } ?></span>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="e3">Category</label>
                                 <select class="form-control" name="category">
                                    <option value="1">Movie</option>
                                    <option value="2">Music</option>
                                    <option value="3">TV</option>
                                 </select>
                                 <span class="error-message"><?php if (isset($errors["category"])) {
                                                                  echo $errors["category"];
                                                               } ?></span>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="e4">Thumbnail</label>
                                 <input type="file" name="thumbnail" class="form-control" id="e4">
                                 <span class="error-message"><?php if (isset($errors["thumbnail"])) {
                                                                  echo $errors["thumbnail"];
                                                               } ?></span>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="e5">Upload Video</label>
                                 <input type="file" name="video" class="form-control" id="e5">
                                 <span class="error-message"><?php if (isset($errors["video"])) {
                                                                  echo $errors["video"];
                                                               } ?></span>
                              </div>
                           </div>
                           <div class="osahan-area text-center mt-3">
                              <button class="btn btn-outline-primary" type="submit">Upload Video</button>
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