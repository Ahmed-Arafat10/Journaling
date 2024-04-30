<?php
require('../vendor/autoload.php'); # IMPORT
$myAuth = new \App\Authentication();
$myAuth->auth();

$myAuth->logOut();

$myAlert = new \App\Alert();
$myAlert->alertIfUserAuth();

$myDate = new \App\Date();
$myDate->storeTodaysDateIfNeeded();

#var_dump($_SESSION);

?>

<!doctype html>
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
    <title>Home Page</title>
</head>
<body>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/IA/php/Layout/Navbar.php') ?>


<h1>Welcome Back <?php echo $_SESSION['Name']?> To Our Journaling Website</h1>

</body>
</html>
