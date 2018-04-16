<?php
include('./classes/DB.php');
include('./classes/Login.php');

if (!Login::isLoggedIn()) {
        die("Not logged in.");
        Header('Location: login.php');
}

if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));
                Header('Location: login.php');

        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
                Header('Location: login.php');
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
        <form action="logout.php" method="post">
            <h2 class="sr-only">Logout Form</h2>
            <div class="illustration"><i><img src="logo.png" id="logoimg"></i></div>
            <div class="form-group">
                <div class="form-check"><input name="alldevices" value="alldevices" class="form-check-input" type="checkbox" id="formCheck-1" style="color:#214a80;font-size:20px;font-family:Raleway, sans-serif;font-weight:bold;background-color:#1e2833;background-position:left;background-size:cover;background-repeat:no-repeat;">
                    <label
                        class="form-check-label" for="formCheck-1">Log out from all devices?</label>
                </div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-primary btn-block" name="confirm" value="Confirm">Confirm</button>
              <a class="btn btn-danger btn-block" role="button" href="index.php">Cancel</a></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
