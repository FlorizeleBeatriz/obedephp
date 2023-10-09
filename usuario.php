<?php
include_once('conexao.php');
if(!$sessao->esta_logado())
header('location:login.php'); 
$usuarios=listagemUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestao de Usuarios</title>
</head>
<body>
<span style="float:right"><?= $sessao->user_name ?></span>
<form method="post">
<input type="submit" name="sair" value="Sair" style="float:right"/>
</form>
<?php include_once('menu.php'); ?>

<h3>Lista de Contactos da Minha Agenda</h3>
<table border="1">
<thead>
<tr>
<th>#</th>
<th>Nome</th>
<th>Email</th>
<th>Opcao</th>
<!-- Vamos criar um link para adicionar novo registo -->
<th><a href="criarUsuario.php">+</a></th>
</tr>
</thead>
<!--Colocamos uma condicao pra verificar se a lista esta vazia -->
<?php if(count($usuarios)==0){ ?>
<tr><td colspan=6>Agenda de Contactos Vazia</td></tr>
<?php }else{ ?>
<!-- Aqui vamos correr a lista de contactos que temos na nossa agenda -->
<?php for($i=0;$i<count($usuarios);$i++){ ?>
<tr>
<td><?= $usuarios[$i]['id'] ?></td>
<td><?= $usuarios[$i]['nome'] ?></td>
<td><?= $usuarios[$i]['email'] ?></td>
<!-- Criamos aqui os botoes de editar e remover -->
<td colspan=2>
<!-- O botão remover é envolvido num formulário para que possamos fazer uso da 
variável global $_POST ao submeter o formuário.
Note que temos um input do tipo hidden que contém o id do registo, este valor é 
que será usado para remover o registo -->
<form method="post">
<input type="hidden" name="id" value="<?=
$usuarios[$i]['id'] ?>" />
<button type="submit" name="remover">Remover</button>
</form>
<!-- o editar é um link que redireciona a página para o formulário editar 
com um parâmetro na url que é o id do registo -->
<a href="editarUsuario.php?id='<?= $usuarios[$i]['id'] 
?>'">Editar</a></td>
</tr>
<?php } } ?>
</table>
<?php
// neste Código é acionado de acordo com a condição de ter sido clicado o botar 
// remover
if(isset($_POST['remover']))
{
    removerUsuario($_POST['id']);
}elseif(isset($_POST['sair'])){
$sessao->logout();
header('location:login.php');
}
?>
</body>
</html>