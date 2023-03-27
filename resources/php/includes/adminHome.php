<?php
require_once 'resources/php/action/connection.php';
$connection = connection();
?>
<div class="container mt-3">
    <a class="btn btn-danger w-10" href="./resources/php/action/logout.php">Sair</a>
    <h2 class="mt-3">Visualizar os usuários cadastrados</h2>
    <?php
    $typeOfAlert = $_GET['c'] === '1' ? 'danger' : 'success';
    if (isset($_GET['m'])) {
        echo
        "<div class='alert alert-$typeOfAlert d-flex justify-content-between' role='alert'>
            <div>{$_GET['m']}</div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }?>
    <?php
    $sqlSelect = "SELECT * FROM users WHERE profile_id != 1";
    $sqlResult = $connection->query($sqlSelect);
    if ($sqlResult->num_rows === 0) { ?>
        <div class="alert alert-warning text-center mt-5" role="alert">
            Ainda não há nenhum usuário cadastrado
            <a href="./cadastrar.php" class="btn btn-info fw-semibold text-white">Cadastrar usuário</a>
        </div>
    <?php } else {?>
        <a href="./cadastrar.php" class="btn btn-info fw-semibold text-white">Cadastrar usuário</a>
        <table class="table table-info table-striped mt-5 align-middle">
            <tr>
                <td class="fw-bold">Código:</td>
                <td class="fw-bold">Nome:</td>
                <td class="fw-bold">Email:</td>
                <td class="fw-bold">Status:</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php

            while ($res = $sqlResult->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $res['id']?></td>
                    <td><?= $res['name']?></td>
                    <td><?= $res['email']?></td>
                    <td><?= $res['status'] ? 'Ativo' : 'Inativo'?></td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop<?=$res['id']?>">
                            <img width="35" title="Deletar" src="https://cdn2.iconfinder.com/data/icons/vivid/48/trash-256.png" alt="">
                        </a>
                        <div class="modal fade" id="staticBackdrop<?=$res['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Deletar usuário</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você tem certeza que deseja deletar o usuário <strong><?= $res['name']?></strong>? <br>
                                        <hr>
                                        <strong>Nome:</strong> <?= $res['name']?> <br>
                                        <strong>Email:</strong> <?= $res['email']?> <br>
                                        <hr>
                                        Ele será deletado para sempre!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="./home.php?action=delete&id=<?=$res['id']?>" class="btn btn-danger">Deletar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="./edit.php?id=<?=$res['id']?>">
                            <img width="35" title="Editar" src="https://cdn1.iconfinder.com/data/icons/website-internet/48/website_-_pencil-256.png" alt="">
                        </a>
                    </td>
                    <td>
                            <?php
                            if ((bool) $res['status'] === true) { ?>
                            <a href="./home.php?action=alterStatus&id=<?=$res['id']?>&status=<?=$res['status']?>">
                                <img width="35" title="Desativar" src="https://cdn4.iconfinder.com/data/icons/essentials-72/24/039_-_Cross-256.png" alt="">
                            </a>
                            <?php } else { ?>
                            <a href="./home.php?action=alterStatus&id=<?=$res['id']?>&status=<?=$res['status']?>">
                                <img width="35" title="Ativar" src="https://cdn4.iconfinder.com/data/icons/essentials-72/24/040_-_Tick-256.png" alt="">
                            </a>
                            <?php } ?>
                    </td>
                </tr>
            <?php }?>
        </table>
    <?php } ?>
    <?php
    if (isset($_GET['action']))
        if ($_GET['action'] === 'delete') {
            $id = $_GET['id'];
            $sqlDelete = "DELETE FROM users WHERE id='$id'";
            $resultDelete = $connection->query($sqlDelete);
            $message = "Usuário deletado com sucesso";
            $code = 0;
            echo "<script>window.location='home.php?m=$message&c=$code'</script>";
        } else if ($_GET['action'] === 'alterStatus') {
            $id = $_GET['id'];
            $status = (int) (! $_GET['status']);
            $sqlUpdate = "UPDATE users SET status=$status WHERE id='$id'";
            $resultUpdate = $connection->query($sqlUpdate);

            $mes = !$status ? "desativado" : "ativado";
            $message = "Usuário $mes com sucesso";
            $code = 0;
            echo "<script>window.location='home.php?m=$message&c=$code'</script>";
        }
    ?>
</div>
