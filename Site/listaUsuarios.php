<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php
    include_once('connection.php');
    if(!isset($_SESSION)) {
        session_start();
    }
  
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] <> 1) {
        die(header( "Location: listaProdutos.php" ));
    }
  
    //Tabelas
    $usuario = $conn->query("SELECT * FROM usuarios ORDER BY idUsuario");
?>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Inventário</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="listaProdutos.php">Produtos</a>
        </li>
        <?php if ($_SESSION['tipo'] == 1) {
        echo "<li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
          Admin
        </a>
        <ul class=\"dropdown-menu\">
          <li><a class=\"dropdown-item\" href=\"listaUsuarios.php\">Lista de Usuários</a></li>
        </ul>
      </li>";
    }?>
    </ul>
        <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
  </div>
</nav>
    </header>
    <main>
    <div class='containerTabela'>
        <div class='tabelaFerramentas'>
            <input type="text" placeholder="Pesquisar..." onkeyup="pesquisa()" name="barraPesquisa" id="barraPesquisa"> 
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adcionarModal">
  +
                  </button>
        </div>

<!-- Tabela de Produtos -->
        <div class='tabelaConteúdo'>
        <table id='myTable'>
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                //Linhas da tabela de produto
                while($rows = mysqli_fetch_array($usuario))
                {
                  ?>
                <tr class="ativo">
                        <td><?php echo $rows['idUsuario']; ?></td>
                        <td><?php echo $rows['username']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <?php 
                        if ($rows['tipo_usuario'] == 0){
                            echo "<td> Funcionário </td>";
                        } else if ($rows['tipo_usuario'] == 1) {
                            echo "<td> Admin </td>";
                        } else {
                            echo "<td> </td>";
                        }
                        ?>
                        <td> <button type="button" class="btn btn-primary btn-editar" data-bs-toggle="modal" data-bs-target="#editarModal">
  Editar </button> <button type="button" id="botãoDeletar" class="btn btn-danger btn-del" data-bs-toggle="modal" data-bs-target="#deletarModal">
  Deletar </button> </td>
                </tr>
              <?php
                    }
            ?>
            </tbody>
        </table>
        </div>
        </div>
<!-- Tabela de Produtos -->

  
<!-- Modal Adcionar -->
<div class="modal fade" id="adcionarModal" tabindex="-1" aria-labelledby="AdcionarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="funcoes.php" method="POST">
            <input type="hidden" name="idUsuario" value="null">

            <label for="nome">Nome</label>
            <input type="text" name="username" id="username" required> <br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required> <br>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required> <br>

            <label for="seleçãoTipo">Setor</label>
            <select name="seleçãoTipo" id="seleçãoTipo">
                <option value="0">Funcionário</option>
                <option value="1">Admin</option>
            </select> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" name="adcionarUsuario" id="adcionarUsuario" class="btn btn-primary">Adcionar</button>
                  </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Adcionar -->

<!-- Modal Editar -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="EditarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="funcoes.php" method="POST">
            <input type="hidden" name="idUsuario" id="editIdUsuario">

            <label for="nome">Nome</label>
            <input type="text" name="username" id="editUsername" required> <br>

            <label for="email">Email</label>
            <input type="email" name="email" id="editEmail" required> <br>

            <label for="email">Senha</label>
            <input type="password" name="senha" id="editSenha" required> <br>
            
            <label for="seleçãoTipo">Setor</label>
            <select name="seleçãoTipo" id="seleçãoTipo">
                <option value="0">Funcionário</option>
                <option value="1">Admin</option>
            </select> 
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" name="editarUsuario" id="editarUsuario" class="btn btn-primary">Editar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar -->


<!-- Modal de deletar  -->
        <div class="modal fade" id="deletarModal" tabindex="-1" aria-labelledby="deletarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="funcoes.php" method="post">
      <input type="hidden" name="idDeletar" id="idDeletar">
      <div class="modal-body">
        <h4>Realmente deseja deleta este usuario?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="deletarUsuario" class="btn btn-danger">Deletar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal de deletar  -->

<!-- Scripts do projeto -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script text="text/javascript" src="../JS/listaUsuarios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Scripts do projeto -->
</body>
</html>