<?php
include_once('conexao.php');
if(!$sessao->esta_logado())
header('location:login.php'); 
$contactos=listagem();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Contactos</title>
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
<th>Contacto</th>
<th>Email</th>
<th>Opcao</th>
<!-- Vamos criar um link para adicionar novo registo -->
<th><a href="criar.php">+</a></th>
</tr>
</thead>
<!--Colocamos uma condicao pra verificar se a lista esta vazia -->
<?php if(count($contactos)==0){ ?>
<tr><td colspan=6>Agenda de Contactos Vazia</td></tr>
<?php }else{ ?>
<!-- Aqui vamos correr a lista de contactos que temos na nossa agenda -->
<?php for($i=0;$i<count($contactos);$i++){ ?>
<tr>
<td><?= $contactos[$i]['id'] ?></td>
<td><?= $contactos[$i]['nome'] ?></td>
<td><?= $contactos[$i]['contacto'] ?></td>
<td><?= $contactos[$i]['email'] ?></td>
<!-- Criamos aqui os botoes de editar e remover -->
<td colspan=2>
<!--O botão remover é envolvido num formulário para que possamos fazer uso da 
variável global $_POST ao submeter o formuário.
Note que temos um input do tipo hidden que contém o id do registo, este valor é 
que será usado para remover o registo -->
<form method="post">
<input type="hidden" name="id" value="<?=
$contactos[$i]['id'] ?>" />
<button type="submit" name="remover">Remover</button>
</form>
<!--o editar é um link que redireciona a página para o formulário editar 
com um parâmetro na url que é o id do registo -->
<a href="editar.php?id='<?= $contactos[$i]['id'] 
?>'">Editar</a></td>
</tr>
<?php } } ?>
</table>
<?php
// neste Código é acionado de acordo com a condição de ter sido clicado o botar 
// remover
if(isset($_POST['remover']))
{
$conexao=mysqli_connect("localhost","root","","agenda");
$sql="delete from contacto where id=".$_POST['id'];
$result=mysqli_query($conexao,$sql);
header('location:index.php');
}elseif(isset($_POST['sair'])){
$sessao->logout();
header('location:login.php');
}
?>
</body>
</html>