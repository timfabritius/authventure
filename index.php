<?php
  include('./classes/DB.php');
  include('./classes/Login.php');

  if (Login::isLoggedIn()) {
          $user = Login::isLoggedIn();
  } else {
          Header('Location: login.php');

  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tim Fabritius">
    <title>Auth Venture</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Services</h2>
            <div class="illustration"><i><img src="logo.png" id="logoimg" alt="logo"></i></div>
            <div class="form-group"><a class="btn btn-primary btn-block btn-lg" role="button" href="">Open service</a></div>
            <div class="form-group"><a class="btn btn-secondary btn-block btn-lg" role="button" href="change-password.php">Change password</a></div>
            <div class="form-group"><a class="btn btn-danger btn-block btn-lg" role="button" href="logout.php">Logout</a></div>
            <a href="rating.php" class="forgot" style="margin-top:16px;">Leave us feedback!</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
