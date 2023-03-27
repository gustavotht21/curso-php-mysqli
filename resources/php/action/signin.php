<?php
$data = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];
$data['hashPassword'] = md5($data['password']);
if (empty($data['email'])) {
    $message = "O campo de email não pode ficar vazio";
    $code = 1;
} else if (empty($data['password'])) {
    $message = "O campo de senha não pode ficar vazio";
    $code = 1;
} else {
    require_once './connection.php';
    $connection = connection();
    $sqlAuthentication = "SELECT * FROM users WHERE email='{$data['email']}' AND password='{$data['hashPassword']}'";
    $resultAuthentication = $connection->query($sqlAuthentication);
    if ($resultAuthentication->num_rows === 0) {
        $message = "As credenciais fornecidas não constam na nossa base de dados. Verifique se os dados estão corretos";
        $code = 1;
    } else {
        $resultAuthentication = $resultAuthentication->fetch_assoc();
        if ((bool) $resultAuthentication['status'] === false) {
            $message = "Você está inativo. Se acha que isso é um erro, contate a administração";
            $code = 1;
        } else {
            session_start();
            $_SESSION['name'] = $resultAuthentication['name'];
            $_SESSION['email'] = $resultAuthentication['email'];
            $_SESSION['status'] = $resultAuthentication['status'];
            $_SESSION['profile_id'] = $resultAuthentication['profile_id'];
            header("Location: ../../../home.php");
            die();
        }
    }
}
header("Location: ../../../signin.php?m=$message&c=$code");