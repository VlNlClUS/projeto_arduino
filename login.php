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

    $row1 = $result->fetch_assoc();

    $usuarioid = $row1['usuario_id'];

$query = "TRUNCATE TABLE tmp_usuario";

    mysqli_query($db_connect, $query);

$query = "INSERT INTO `projeto_ed2`.`tmp_usuario`

                        (`usuario_id`,
                        `usuario`)
            SELECT       usuario_id,
                         usuario 
            FROM usuario
            
            WHERE usuario.usuario_id = '{$usuarioid}';";

    mysqli_query($db_connect, $query);
            if($row == 1){
                
                header('Location: main.php');
                exit();
            }else {
            
                header('Location: index.php');
            
                exit();
            }

            ?>


