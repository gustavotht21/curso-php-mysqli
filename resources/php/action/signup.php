<?php
$data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'password_confirmation' => $_POST['password_confirmation']
];
$data['hashPassword'] = md5($data['password']);

if (empty($data['name'])) {
    $message = "O campo de nome não pode ficar vazio";
    $code = 1;
} else if (empty($data['email'])) {
    $message = "O campo de email não pode ficar vazio";
    $code = 1;
} else if (empty($data['password'])) {
    $message = "O campo de senha não pode ficar vazio";
    $code = 1;
} else if (empty($data['password_confirmation'])) {
    $message = "O campo de confirmação de senha não pode ficar vazio";
    $code = 1;
} else if ($data['password'] !== $data['password_confirmation']) {
    $message = "As senhas não coincidem";
    $code = 1;
} else {
    require_once './connection.php';
    $connection = connection();
    $sqlAuthentication = "SELECT * FROM users WHERE email='{$data['email']}'";
    $resultAuthentication = $connection->query($sqlAuthentication);
    if ($resultAuthentication->num_rows >= 1) {
        $message = "Já existe uma conta cadastrada com o email fornecido";
        $code = 1;
    } else {
        $sqlInsert = "INSERT INTO users (name, email, profile_id, status, password) VALUES ('{$data['name']}', '{$data['email']}', 2, 1, '{$data['hashPassword']}')";
        $sqlResult = $connection->query($sqlInsert);

        $dataMail = [
            'title' => "Cadastro efetuado com sucesso",
            'destiny' => $data['email'],
            'body' => "Nome: {$_POST['name']} <br> Email: {$_POST['email']} <br> Mensagem: Você foi cadastrado com sucesso no sistema curso php mysqli de Gustavo Borges. A sua senha de acesso é: {$data['password']}"
        ];

        mail($dataMail['destiny'], $dataMail['title'], $dataMail['body']);

        if ($sqlResult) {
            $message = "Cadastro efetuado com sucesso";
            $code = 0;
        } else {
            $message = "Ocorreu um erro ao tentar se cadastrar";
            $code = 1;
        }
    }
}
header("Location: ../../../signup.php?m=$message&c=$code");