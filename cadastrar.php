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
    <title>Cadastrar usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>
<body>
<?= require_once 'resources/php/components/navbarAdmin.php'?>
<div class="container mt-5">
    <h2 class="mt-3">Cadastrar usuário</h2>
    <?php
    $typeOfAlert = $_GET['c'] === '1' ? 'danger' : 'success';
    if (isset($_GET['m'])) {
        echo
        "<div class='alert alert-$typeOfAlert d-flex justify-content-between' role='alert'>
            <div>
                {$_GET['m']}
                <a class='link-info fw-semibold' href='home.php'>Visualizar usuários cadastrados</a>
            </div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }?>
    <form action="./resources/php/action/register.php" class="mt-3" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" >
        </div>
        <div class="mb-3">
            <label for="email_confirmation" class="form-label">Confirme o email</label>
            <input type="email" class="form-control" id="email_confirmation" name="email_confirmation" >
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-info text-white fw-bold w-100">Cadastrar</button>
            <a class="btn w-25 fw-bold text-white text-center d-flex justify-content-center btn-danger" href="home.php">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>