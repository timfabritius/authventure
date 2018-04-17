<?php
include('classes/DB.php');
if(isset($_POST['sendfeedback'])){
  $email = $_POST['email'];
  $rating = $_POST['rating'];
  $feedback = $_POST['feedback'];
  if (strlen($feedback) >= 6 && strlen($feedback) <= 1000) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      DB::query('INSERT INTO feedback VALUES (\'\', :email, :rating, :feedback)', array(':email'=>$email, ':rating'=>$rating, ':feedback'=>$feedback));
      Header('Location: login.php');
    }else{
      echo "Invalid email";
    }
  }else{
    echo "Feedback too short or too long. Must be 6-1000 digits.";
  }
}
?>

<!DOCTYPE html>
<html>

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
        <form action="rating.php" method="post">
            <h2 class="sr-only">Feedback form</h2>
            <div class="illustration"><i><img src="logo.png" id="logoimg"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="d-inline-block d-flex flex-row align-self-center mx-auto" type="range" name="rating" min="0" max="5" step="1" style="width:240px;font-size:22px;height:40px;margin-top:0px;padding-top:0;"></div>
            <div class="form-group"><textarea class="form-control form-control-lg" rows="4" name="feedback" placeholder="Write feedback here."></textarea></div>
            <div class="form-group"><button name="sendfeedback" class="btn btn-primary btn-block" type="submit">Send feedback</button><button class="btn btn-danger btn-block" type="button">Cancel</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
