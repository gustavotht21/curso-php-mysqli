<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>
<body>
<?php require_once 'resources/php/components/navbar.php'?>

<a class="mt-3 ms-3 btn btn-primary fw-semibold w-10" href="index.php">Voltar</a>

<div class="container mt-5">
    <h2 class="mt-3">Faça cadastro no sistema</h2>
    <?php
    $typeOfAlert = $_GET['c'] === '1' ? 'danger' : 'success';
    if (isset($_GET['m'])) {
        echo
        "<div class='alert alert-$typeOfAlert d-flex justify-content-between' role='alert'>
            <div>{$_GET['m']}</div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }?>
    <form action="./resources/php/action/signup.php" class="mt-3" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirme a senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-info text-white fw-bold w-100">Cadastrar-se</button>
            <a class="btn w-25 fw-bold text-white text-center d-flex justify-content-center" style="background-color: #10A19D" href="signin.php">Entrar</a>
        </div>
    </form>
</div>
</body>
</html>