<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<?php
$data = [
    'title' => "Email de contato",
    'destiny' => "borgesgustavo360@gmail.com",
    'body' => "Nome: {$_POST['name']} Email: {$_POST['email']} Mensagem: {$_POST['message']}"
];

if (mail($data['destiny'], $data['title'], $data['body'])) {
    $message = "Email enviado com sucesso";
    $code = 0;
} else {
    $message = "Ocorreu um erro";
    $code = 1;
}
header("Location: ../../../contato.php?m=$message&c=$code");

?>
</html>
