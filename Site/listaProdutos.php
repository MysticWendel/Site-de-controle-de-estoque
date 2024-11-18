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
  session_start();
  include_once('connection.php');
  include_once('funcoes.php');


  if (!isset($_SESSION['id'])) {
      die(header( "Location: index.php" ));
  }


    //Tabelas
    $produto = $conn->query("SELECT p.idProduto, p.nome, p.preço_compra, p.preço_venda, p.estoque, p.distribuidora, s.Setor FROM produtos as p, setores as s where p.idSetor = s.idSetor ORDER BY idProduto;");
    $setor = $conn->query("SELECT * FROM setores ORDER BY idSetor");
?>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Estoque</a>
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
      <h1 class="text-center">Lista de produtos</h1>
    <div class='containerTabela mx-5 mt-2 card'>
      <div class="mx-5">
        <?php mensagemAlerta()?>
        <div class='ms-2 mt-2'>
            <input type="text" placeholder="Pesquisar..." onkeyup="pesquisa()" name="barraPesquisa" id="barraPesquisa"> 
            <select name="pesquisaSetor" id="pesquisaSetor">
                <option value="0">---Todos---</option>
                <option value="Frios e laticínios">Frios e laticínios</option>
                <option value="Higiene e limpeza">Higiene e limpeza</option>
                <option value="Vegetais e frutas">Vegetais e frutas</option>
                <option value="Açougue">Açougue</option>
                <option value="Padaria">Padaria</option>
                <option value="Cereais">Cereais</option>
                <option value="Enlatados">Enlatados</option>
                <option value="Adega e Bebidas">Adega e Bebidas</option>
            </select>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adcionarModal">
  Adcionar Produto
                  </button>
          </div>
<!-- Tabela de Produtos -->
        <div class='tabelaConteúdo mx-auto'>
        <table class="table" id='myTable'>
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Nome</th>
                    <th>Preço de Compra</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade em estoque </th> 
                    <th>Distribuidora</th> 
                    <th>Disponibilidade</th>
                    <th>Setor</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                //Linhas da tabela de produto
                while($rows = mysqli_fetch_array($produto))
                {
                  if ($rows['estoque'] > 0){
                    $disponibilidade = 'Disponível';
                    } else {
                    $disponibilidade = 'Indisponivel';
                    }
                  ?>
                <tr class="ativo">
                        <td><?php echo $rows['idProduto']; ?></td>
                        <td><?php echo $rows['nome']; ?></td>
                        <td><?php echo $rows['preço_compra']; ?></td>
                        <td><?php echo $rows['preço_venda']; ?></td>
                        <td><?php echo $rows['estoque']; ?></td>
                        <td><?php echo $rows['distribuidora']; ?></td>
                        <td><?php echo $disponibilidade ?></td>
                        <td><?php echo $rows['Setor']; ?></td>

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
        </div>
<!-- Tabela de Produtos -->

  
<!-- Modal Adcionar -->
<div class="modal fade" id="adcionarModal" tabindex="-1" aria-labelledby="AdcionarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adcionar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="acoes.php" method="POST">
            <input type="hidden" name="idProduto" value="null">

            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control"name="nome" id="nome" placeholder="Ex: Maçã" required>
            </div>

            <div class="row mb-3">
              <div class="col">
               <label for="precoCompra" class="form-label">Preço de Compra</label>
               <input type="number" class="form-control" name="preçoCompra" id="preçoCompra" min="0" step="0.01" placeholder="Ex: 0,00" required>
             </div>
             <div class="col">
              <label for="precoVenda" class="form-label">Preço de Venda</label>
              <input type="number" class="form-control col" name="preçoVenda" id="preçoVenda" min="0" step="0.01" placeholder="Ex: 0,00" required>
             </div> 
            </div>

            <div class="mb-3">
              <label for="estoque" class="form-label">Quantidade em Estoque</label>
              <input type="number" class="form-control" name="estoque" id="estoque" min="0" placeholder="Ex: 0" required>
            </div>
            
            <div class="mb-3">
              <label for="seleçãoSetor" class="form-label">Setor</label>
              <select class="form-select" name="seleçãoSetor" id="seleçãoSetor">
                  <option value="1">Frios e Laticínios</option>
                  <option value="2">Higiene e limpeza</option>
                  <option value="3">Vegetais e frutas</option>
                  <option value="4">Açougue</option>
                  <option value="5">Padaria</option>
                  <option value="6">Cereais</option>
                  <option value="7">Enlatados</option>
                  <option value="8">Adega e Bebidas</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="distribuidora" class="form-label">Distribuidora</label>
              <input type="text" class="form-control" name="distribuidora" id="distribuidora" placeholder="Ex: Fazenda Feliz" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" name="adcionarProduto" id="adcionarProduto" class="btn btn-primary">Adcionar</button>
                  </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Adcionar -->

<!-- Modal Editar -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="EditarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="acoes.php" method="POST">
            <input type="hidden" name="idProduto" id="editIdProduto">

            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control"name="nome" id="editNome" placeholder="Ex: Maçã" required>
            </div>

            <div class="row mb-3">
              <div class="col">
               <label for="precoCompra" class="form-label">Preço de Compra</label>
               <input type="number" class="form-control" name="preçoCompra" id="editPreçoCompra" min="0" step="0.01" placeholder="Ex: 0,00" required>
             </div>
             <div class="col">
              <label for="precoVenda" class="form-label">Preço de Venda</label>
              <input type="number" class="form-control col" name="preçoVenda" id="editPreçoVenda" min="0" step="0.01" placeholder="Ex: 0,00" required>
             </div> 
            </div>

            <div class="mb-3">
              <label for="estoque" class="form-label">Quantidade em Estoque</label>
              <input type="number" class="form-control" name="estoque" id="editEstoque" min="0" placeholder="Ex: 0" required>
            </div>
            
            <div class="mb-3">
              <label for="seleçãoSetor" class="form-label">Setor</label>
              <select class="form-select" name="seleçãoSetor" id="seleçãoSetor">
                  <option value="1">Frios e Laticínios</option>
                  <option value="2">Higiene e limpeza</option>
                  <option value="3">Vegetais e frutas</option>
                  <option value="4">Açougue</option>
                  <option value="5">Padaria</option>
                  <option value="6">Cereais</option>
                  <option value="7">Enlatados</option>
                  <option value="8">Adega e Bebidas</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="distribuidora" class="form-label">Distribuidora</label>
              <input type="text" class="form-control" name="distribuidora" id="editDistribuidora" placeholder="Ex: Fazenda Feliz" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" name="editarProduto" id="editarProduto" class="btn btn-primary">Editar</button>
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
      <form action="acoes.php" method="post">
      <input type="hidden" name="idDeletar" id="idDeletar">
      <div class="modal-body">
        <h4>Realmente deseja deleta este item?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="deletarProduto" class="btn btn-danger">Deletar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal de deletar  -->

<!-- Scripts do projeto -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script text="text/javascript" src="../JS/listaProdutos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Scripts do projeto -->
</body>
</html>