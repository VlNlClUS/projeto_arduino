<?php
include('conexao.php');
include('index.php');
if(empty($_POST['nome']) || empty($_POST['senha'])){

header('location: index.php');
exit();

}

$usuario = mysqli_real_escape_string($db_connect,$_POST['nome']);
$senha = mysqli_real_escape_string($db_connect,$_POST['senha']);

$query = "SELECT usuario_id, usuario FROM usuario WHERE usuario= '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($db_connect, $query);
$row = mysqli_num_rows($result);

if($row == 1){
    $_SESSION['usuario'] = $usuario;
    header('Location: main.php');
    exit();
}else {
    $_POST['teste'] = "Login inválido.";
    header('Location: index.php');
   
    exit();
}

 ?>


