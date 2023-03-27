<?php
session_start();
require_once 'resources/php/includes/userHome.php';
if (empty($_SESSION['name'])) {
    $message = "Você não tem acesso a essa página. Faça login no sistema";
    $code = 1;
    header("Location: signin.php?m=$message&c=$code");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>
<body>

    <?php
    if ($_SESSION['profile_id'] === "1") {
        require_once 'resources/php/components/navbarAdmin.php';
    }
    ?>
    <?php require_once userHome($_SESSION['profile_id'])?>


</body>
</html>