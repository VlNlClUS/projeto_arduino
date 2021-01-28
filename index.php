
<!DOCTYPE html

<html lang="pt-BR" dir="1tr">
<!-- comentario -->
<head>
    <meta charset="utf-8" />

    <link href="css/master.css" rel="stylesheet" type="text/css" />
   
    <title>Tela De Login</title>
</head>

<body>
    <div class="login">

        <img src="img/user.png" class="usuario" width="100" height="100" alt="">

        <h1>Login</h1> 
       
        <form action="login.php" method="post">

            <p>Usuario</p>
            <input type="text" name="nome" >
    
            <br>

            <p>Senha</p>
            <input type="password" name="senha" >

            <input type="submit" value="Login">
        </form>
       
    </div>
   
</body>

</html>