<?php
  include('classes/DB.php');
  include('classes/Login.php');

  if(Login::isLoggedIn()){
    Header('Location: index.php');
  }

  if (isset($_POST['login'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];

          if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                  if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {

                          $cstrong = True;
                          $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                          $user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                          DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

                          setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                          setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                          header('Location: index.php');

                  } else {
                          echo 'Incorrect Password!';
                  }

          } else {
                  echo 'User not registered!';
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
        <form class="align-self-center" action="login.php" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i><img src="logo.png" id="logoimg"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" required="" placeholder="Username" maxlength="32" minlength="3"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group">
            <?php
              if(Login::isLoggedIn()){
                echo "<a class='btn btn-primary btn-block' role='button' href='index.php'>Open</a>";
              }else{
                echo "<button class='btn btn-primary btn-block' name='login' type='submit'>Log In</button>";
              }
            ?>
          </div>
            <a href="forgot-password.php" class="forgot">Forgot your password?</a>
            <a href="rating.php" class="forgot" style="margin-top:16px;">Leave us feedback!</a>
            <a href="create-account.php" class="forgot" style="margin-top:16px;">Create account</a>
          </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
