<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php 
    session_start();
    include_once('connection.php');

    if (isset($_SESSION['id'])) {
        die(header("Location: listaProdutos.php" ));
    }

    if (isset($_POST["email"]) || isset($_POST["senha"])){

        $email = $conn->real_escape_string($_POST["email"]);
        $senha = $conn->real_escape_string($_POST["senha"]); 
        
        $sqlusuario = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");
        $usuario = mysqli_fetch_array($sqlusuario, MYSQLI_ASSOC);
        $senhaHash = $usuario['senha'];

        var_dump(password_verify($senha, $senhaHash));


        $quantidade = $sqlusuario->num_rows;

        if($quantidade == 1) {
            
            $_SESSION['id'] = $usuario['idUsuario'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];
            
            header( "Location: listaProdutos.php" );   

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    

    };

?>
<body>

<h1>Faça seu Login</h1>
<form method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required> <br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required> <br>
    <button type="submit">Entrar</button>
</form>
    
</body>
</html>