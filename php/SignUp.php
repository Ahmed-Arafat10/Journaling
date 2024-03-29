<?php

require('../vendor/autoload.php'); # IMPORT

$myDB = new \App\DB();

$myDB->connect();

# $myDB->check();

// super global arrays


if (isset($_POST['signUpBtn'])) {
    #var_dump($_POST);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        \App\Alert::PrintMessage("Password Not Matched", "Danger");
    } else {
        $insert = "INSERT INTO `user` VALUES(NULL,?,?,?)";
        $Query = $myDB->Con->prepare($insert);
        $Query->bind_param('sss', $username, $password, $email);
        $check = $Query->execute();
        if ($check)
            \App\Alert::PrintMessage("Done", "Normal");
        else
            \App\Alert::PrintMessage("Failed", "Danger");
    }
}
//http://localhost/IA/php/SignUp.php?username=ahmed123&email=ahmed%40gmail.com&password=123&confirm_password=123&signUpBtn=123


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="\viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <title>Sign Up</title>
</head>

<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/IA/php/Layout/Navbar.php') ?>

<form method="post">
    <div class="Login-Card">
        <div class="screen-1">

            <div class="email">
                <label for="username">Username</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input id="username" type="text" name="username" placeholder="Ahmed Arafat"/>
                </div>
            </div>

            <div class="email">
                <label for="email">Email</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="ahmed@gmail.com"/>
                </div>
            </div>

            <div class="password">
                <label for="password">Password</label>
                <div class="sec-2">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input class="pas" type="password" name="password"/>
                </div>
            </div>

            <div class="password">
                <label for="password">Confirm Password</label>
                <div class="sec-2">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input class="pas" type="password" name="confirm_password"/>
                </div>
            </div>

            <button type="submit" name="signUpBtn" value="123" class="login">Sign Up</button>

            <div class="footer">
                <a href="">
                    Log In
                </a>
                <span>Forgot Password?</span>
            </div>

        </div>
</form>

</body>

</html>

