<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php 
    session_start();
    include_once('connection.php');
    include_once('funcoes.php');

    if (isset($_SESSION['id'])) {
        die(header("Location: listaProdutos.php"));
    }

    if (isset($_POST["email"]) || isset($_POST["senha"])){

        $email = $conn->real_escape_string($_POST["email"]);
        $senha = $conn->real_escape_string($_POST["senha"]); 
        
        $sqlusuario = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");
        if(mysqli_num_rows($sqlusuario) == 1){
        
        $usuario = mysqli_fetch_array($sqlusuario, MYSQLI_ASSOC);
        $senhaHash = $usuario['senha'];

        if (!password_verify($senha, $senhaHash)){
            $_SESSION['erro'] = "Falha ao logar! E-mail ou senha incorretos.";
            header( "Location: index.php");
            die();
        } else {
            
            $_SESSION['id'] = $usuario['idUsuario'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];
            
            header( "Location: listaProdutos.php" ); 
            die();
        } 
    } else {
        $_SESSION['erro'] = "Falha ao logar! E-mail ou senha incorretos.";
        header( "Location: index.php");
        die();
    }
}

?>
<body>
<header>
    <h1 class="text-center mt-5">Sistema de Controle de Estoque</h1>
</header>

<main>
<section>
      <div class="container mt-2 pt-5">
        <div class="row">
          <div class="col-2 col-sm-7 col-md-6 m-auto">
            <div class="card border-2">
              <div class="card-body">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Login</h1>
                <?php mensagemAlerta()?>
                <form method="post">
                  <input type="email" name="email" id="email" class="form-control my-4 py-2" placeholder="Email" />
                  <input type="password" name="senha" id="senha" class="form-control my-4 py-2" placeholder="Senha" />
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>