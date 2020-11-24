<!DOCTYPE html>
<html lang="pt-BR" dir="1tr">

<head>

<?php include('conexao.php');

$query = "SELECT usuario_id, usuario FROM tmp_usuario";
    $result = mysqli_query($db_connect, $query);
    $row = $result->fetch_assoc();

session_start();


if($_SERVER['REQUEST_METHOD'] == "GET")
        { 
            $_SESSION['msg'] = "";
        
        }
       
?>
    <meta charset="utf-8" />
    <link href="css/master.css" rel="stylesheet" type="text/css" />
   
</head>

<body>
<div class="text">


<div class = "add_token">

       
        <form method="post">

            <h1>Adicionar Token</h1>
           
            <p>Nick Name</p>
            <input type="text" name="nick" >

            <p>Token</p>
            <input type="text" name="token" >

            <br> <br>
            
         <input type="submit" value="ADD Token">
        <p class = <?php 

        if($_SESSION['msg'] == "*Token Cadastrado com Sucesso"){
            echo "verde";

        }else{
        echo "vermelho";

        }
        ?>>   <?php 

         echo $_SESSION['msg'];
        
        ?></p>

        </form>
       
        </div>

       <?php if(!empty($_POST['nick']) || !empty($_POST['token'])){


       $query0 = "SELECT id_token FROM projeto_ed2.bd_projeto WHERE id_token = '{$_POST['token']}'";

            $result0 = mysqli_query($db_connect, $query0);
            $row0 = mysqli_num_rows($result0);

            if($row0 == 1){


                $query1 = "INSERT INTO `projeto_ed2`.`token`
                                        (`idtoken`,
                                        `nick_token`,
                                        `usuario_token`)
                                        
                            VALUES
                            ('{$_POST['token']}',
                            '{$_POST['nick']}',
                            '{$row['usuario_id']}');";

                $result1 = mysqli_query($db_connect, $query1);
                $_SESSION['msg'] = '*Token Cadastrado com Sucesso';
         
            }else {
            $_SESSION['msg'] = '*Token Invalido!!';

            }

       }else if((empty($_POST['nick']) || empty($_POST['token'])) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $_SESSION['msg'] = '*Token Invalido!!'; 
    header("Refresh:5");
       }
?>

        <div class="tk">
 <?php 
                            
            $query2 = "SELECT nick_token, idtoken
                        FROM token
                        INNER JOIN usuario
                        ON token.usuario_token = usuario.usuario_id
                        WHERE usuario.usuario_id = '{$row['usuario_id']}';";

                        $result2 = mysqli_query($db_connect, $query2);              
                 

                            if ($result2->num_rows > 0){

                                ?> <h1>Tokens</h1><br><?php

                                while($row2 = $result2->fetch_assoc()){
                                    
                                    ?> <a href="main.php?teste=<?php echo $row2['idtoken']; ?>"> 
                                    
                                    <h3><?php echo "->  ".$row2['nick_token']?></h3></a>

<?php                                                                 }
                                                
                                                        }else {
                                                            ?> <h1>NENHUM TOKEN CADASTRADO!</h1> <?php
                                                        
                                                        }
                                                        
                                                        
                                                        
                                                        ?>
                                                

</div>
<?php

if (!empty($_GET)) {
    $query2 = "SELECT nick_token FROM token WHERE idtoken = '{$_GET['teste']}';";

                        $result2 = mysqli_query($db_connect, $query2);              
                        $row2 = $result2->fetch_assoc();
        
        $query3 = "SELECT temp,humidade,pressao,ultatu FROM bd_projeto WHERE id_token = '{$_GET['teste']}';";

                                $result3 = mysqli_query($db_connect, $query3);              
                               

                                            if ($result3->num_rows > 0){

?><div class="teste"> <h3><?php echo $row2['nick_token'];  ?></h3><br><?php
                                                while($row3 = $result3->fetch_assoc()){
                                                   
                                                    ?><h3><?php echo $row3['temp']."°"?></h3>
                                                      <h3><?php echo $row3['humidade']."%"?></h3>
                                                      <h3><?php echo $row3['pressao']?></h3>
                                                      <h3><?php echo $row3['ultatu']?></h3>


<?php
                                                }
                                            }}

                                                    ?>
                                                    </div> 
</div> 

</body>

</html>