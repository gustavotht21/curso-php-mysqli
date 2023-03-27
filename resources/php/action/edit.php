<?php
$data = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'email_before_edit' => $_POST['email_before_edit'],
    'email' => $_POST['email'],
    'status' => (int) $_POST['status'],
    'email_confirmation' => $_POST['email_confirmation'],
];
if (empty($data['name'])) {
    $message = "O campo de nome não pode ficar vazio";
    $code = 1;
} else if (empty($data['email'])) {
    $message = "O campo de email não pode ficar vazio";
    $code = 1;
} else if (empty($data['email_confirmation'])) {
    $message = "O campo de confirmação de email não pode ficar vazio";
    $code = 1;
} else if ($data['email'] !== $data['email_confirmation']) {
    $message = "Os emails não coincidem";
    $code = 1;
} else {
    require_once './connection.php';
    $connection = connection();
    $emailNotEdited = false;
    if ($data['email'] !== $data['email_before_edit']) {
        $sqlAuthentication = "SELECT * FROM users WHERE email='{$data['email']}'";
        $resultAuthentication = $connection->query($sqlAuthentication);
        $emailNotEdited = $resultAuthentication->num_rows >= 1;
    }
    if ($emailNotEdited) {
        $message = "Já existe uma conta cadastrada com o email fornecido";
        $code = 1;
    } else {
        $sqlUpdate = "UPDATE users SET name='{$data['name']}', email='{$data['email']}', profile_id=2, status={$data['status']} WHERE id={$data['id']}";
        $sqlResult = $connection->query($sqlUpdate);
        $dataMail = [
            'title' => "Atualização de credenciais",
            'destiny' => $data['email'],
            'body' => "Nome: {$_POST['name']} <br> Email: {$_POST['email']} <br> Mensagem: Suas credenciais foram atualizadas no sistema curso php mysqli de Gustavo Borges. A sua senha de acesso se mantém a mesma"
        ];

        mail($data['destiny'], $data['title'], $data['body']);

        if ($sqlResult) {
            $message = "Usuário atualizado com sucesso";
            $code = 0;
        } else {
            $message = "Ocorreu um erro ao atualizar o usuário";
            $code = 1;
        }
    }
}
header("Location: ../../../edit.php?id={$data['id']}&m=$message&c=$code");