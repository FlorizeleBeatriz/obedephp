<?php
require_once('conexao.php');
require_once('sessao.php');

Sessao::iniciar();

if (!Sessao::logado()) {
    header("Location: login.php");
    exit();
}

$user_id = Sessao::getUsuarioID();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nova_senha = $_POST['nova_senha'];

    $sql = "UPDATE usuario SET senha = '$nova_senha' WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Senha atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a senha: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form method="post">
        Nova Senha: <input type="password" name="nova_senha"><br>
        <input type="submit" value="Atualizar Senha">
    </form>
</body>
</html>
