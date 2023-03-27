<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>
<body>
    <a class="mt-3 ms-3 btn btn-primary fw-semibold w-10" href="index.php">Voltar</a>
    <div class="container mt-5">
        <h2 class="mt-3">Contate-nos</h2>
        <?php
        $typeOfAlert = $_GET['c'] === '1' ? 'danger' : 'success';
        if (isset($_GET['m'])) {
            echo
            "<div class='alert alert-$typeOfAlert d-flex justify-content-between' role='alert'>
            <div>{$_GET['m']}</div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }?>
        <form action="./resources/php/action/sendMessage.php" class="mt-3" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea style="resize: none" rows="8" class="form-control resize-none" id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-semibold">Enviar mensagem</button>
        </form>
    </div>
</body>
</html>