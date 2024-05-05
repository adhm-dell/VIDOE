<?php
require_once '../Controllers/Validator.php';
require_once '../Controllers/FormProcessor.php';
require_once '../Controllers/Auth.php';
require_once '../Models/User.php';
$requiredFields = ['username', 'password', 'email', 'country'];
$processor = new FormProcessor();
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $processor->handleFormSubmission($_POST, $requiredFields);
   $errors = $processor->getErrors();
   if (!$errors) {
      $user = new User();
      $user->setUsername($_POST['username']);
      $user->setPassword($_POST['password']);
      $user->setEmail($_POST['email']);
      $user->setCountry($_POST['country']);
      if (isset($_FILES['pic'])) {
         $path = __DIR__ . "\\assets\\Profile pictures\\"  . $_FILES['pic']['name'];
         move_uploaded_file($_FILES['pic']['tmp_name'], $path);;
         $user->setPic($_FILES['pic']['name']);
      }
      $auth = new Auth();
      if ($auth->register($user)) {
         header('Location: index.php');
      } else {
         $errors = $auth->getErrors();
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

<body class="login-main-body">
   <section class="login-main-wrapper">
      <div class="container-fluid pl-0 pr-0">
         <div class="row no-gutters">
            <div class="col-md-5 p-5 bg-white full-height">
               <div class="login-main-left">
                  <div class="text-center mb-5 login-main-left-header pt-4">
                     <img src="img/favicon.png" class="img-fluid" alt="LOGO">
                     <h5 class="mt-3 mb-3">Welcome to Vidoe</h5>
                     <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                  </div>
                  <form action="register.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Usrername" name="username">
                        <span class="error-message"><?php if (isset($errors["username"])) {
                                                         echo $errors["username"];
                                                      } ?></span>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="error-message"><?php if (isset($errors["password"])) {
                                                         echo $errors["password"];
                                                      } ?></span>
                     </div>
                     <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email">
                        <span class="error-message"><?php if (isset($errors["email"])) {
                                                         echo $errors["email"];
                                                      } ?></span>
                     </div>
                     <div class="form-group">
                        <label>country</label>
                        <input type="text" class="form-control" placeholder="Enter your country" name="country">
                        <span class="error-message"><?php if (isset($errors["country"])) {
                                                         echo $errors["country"];
                                                      } ?></span>
                     </div>
                     <div class="form-group">
                        <label>Profile picture</label>
                        <input type="file" class="form-control" placeholder="Enter profile picture" name="pic" class="form-control"/>
                     </div>
                     <div class="mt-4">
                        <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Sign Up</button>
                     </div>
                  </form>
                  <div class="text-center mt-5">
                     <p class="light-gray">Already have an Account? <a href="login.php">Sign In</a></p>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="login-main-right bg-white p-5 mt-5 mb-5">
                  <div class="owl-carousel owl-carousel-login">
                     <div class="item">
                        <div class="carousel-login-card text-center">
                           <img src="img/login.png" class="img-fluid" alt="LOGO">
                           <h5 class="mt-5 mb-3">​Watch videos offline</h5>
                           <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it to make a type specimen book. It has survived not <br>only five centuries</p>
                        </div>
                     </div>
                     <div class="item">
                        <div class="carousel-login-card text-center">
                           <img src="img/login.png" class="img-fluid" alt="LOGO">
                           <h5 class="mt-5 mb-3">Download videos effortlessly</h5>
                           <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it to make a type specimen book. It has survived not <br>only five centuries</p>
                        </div>
                     </div>
                     <div class="item">
                        <div class="carousel-login-card text-center">
                           <img src="img/login.png" class="img-fluid" alt="LOGO">
                           <h5 class="mt-5 mb-3">Create GIFs</h5>
                           <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it to make a type specimen book. It has survived not <br>only five centuries</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
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