<?php
require_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário criado com sucesso.";
    } else {
        echo "Erro ao criar usuário: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Criar Usuário</title>
</head>
<body>
    <h2>Criar Usuário</h2>
    <form method="post">
        Nome: <input type="text" name="nome"><br>
        Email: <input type="text" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" value="Criar Usuário">
    </form>
</body>
</html>
