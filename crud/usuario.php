<?php
require_once('conexao.php');
require_once('sessao.php');

Sessao::iniciar();

if (!Sessao::logado()) {
    header("Location: login.php");
    exit();
}

$user_id = Sessao::getUsuarioID();
$user_name = Sessao::getUsuarioNome();

// Consulta todos os usuários na base de dados
$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $usuarios = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuários</title>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <p>Bem-vindo, <?php echo $user_name; ?>!</p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td>
                <a href="editarUsuario.php?id=<?php echo $usuario['id']; ?>">Editar Senha</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="editarUsuario.php">Editar Minha Senha</a>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>
