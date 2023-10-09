<?php
require_once('conexao.php');
require_once('sessao.php');

Sessao::iniciar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar as credenciais do usuário
    $sql = "SELECT id, nome FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        Sessao::definirUsuario($row['id'], $row['nome']);
        header("Location: usuario.php");
    } else {
        echo "Credenciais inválidas.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        Email: <input type="text" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

