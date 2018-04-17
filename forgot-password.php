<?php
include('classes/DB.php');

if (isset($_POST['resetpassword'])) {

        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        $email = $_POST['email'];
        $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
        DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token),':user_id'=>$user_id));
        $link = 'change-password.php?token=' . $token;
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
        <form method="post" action="forgot-password.php">
            <h2 class="sr-only">Forgot Password Form</h2>
            <div class="illustration"><i><img src="logo.png" id="logoimg"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><button name="resetpassword" class="btn btn-primary btn-block" type="submit">Get recovery link</button>

            <?php
            if(isset($link)){
              echo '<a class="btn btn-primary btn-block" role="button" href="' . htmlspecialchars("change-password.php?token=" .
                  urlencode($token)) . '">Change</a>'."\n";
            }
            ?>

            <a class="btn btn-danger btn-block" role="button" href="index.php">Cancel</a></div></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
