<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Teste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php
    include_once('connection.php');

    //Tabelas
    $produto = $conn->query("SELECT p.idProdutos, p.nome, p.preçoCompra, p.preçoVenda, p.estoque, p.distribuidora, p.disponibilidade, s.Setor FROM produtos as p, setores as s where p.idSetores = s.idSetores ORDER BY idProdutos;");
    $setor = $conn->query("SELECT * FROM setores ORDER BY idSetores");
?>
<body>
    <header>
        <h1>Pitanga Seca Sistema de Estoque</h1>
    </header>
    <main>
    <div class='containerTabela'>
        <div class='tabelaFerramentas'>
            <input type="text" placeholder="Pesquisar..." onkeyup="pesquisa()" name="barraPesquisa" id="barraPesquisa"> 
            <select name="pesquisaSetor" id="pesquisaSetor">
                <option value="0">---Todos---</option>
                <?php 
                    while($rows = mysqli_fetch_array($setor)) {
                        echo "<option value=\"".$rows["Setor"]."\">".$rows["Setor"]."</option>";
                    }
                ?>
            </select>
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
                  ?>
                <tr class="ativo">
                        <td><?php echo $rows['idProdutos']; ?></td>
                        <td><?php echo $rows['nome']; ?></td>
                        <td><?php echo $rows['preçoCompra']; ?></td>
                        <td><?php echo $rows['preçoVenda']; ?></td>
                        <td><?php echo $rows['estoque']; ?></td>
                        <td><?php echo $rows['distribuidora']; ?></td>

                        <?php 
                        if ($rows['estoque'] > 0){
                        echo "<td class=\"statusDisponivel\"> Disponível </td>";
                        } else {
                        echo "<td class=\"statusIndisponivel\"> Indisponível </td>";
                        }
                        ?>

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
<!-- Tabela de Produtos -->

  
<!-- Modal Adcionar -->
<div class="modal fade" id="adcionarModal" tabindex="-1" aria-labelledby="AdcionarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adcionar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="funcoes.php" method="POST">
            <input type="hidden" name="idProduto" value="null">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Ex: Maçã"> <br>

            <label for="precoCompra">Preço de Compra</label>
            <input type="number" name="preçoCompra" id="preçoCompra" min="0" step="0.01" placeholder="Ex: 0,00"> <br>

            <label for="precoVenda">Preço de Venda</label>
            <input type="number" name="preçoVenda" id="preçoVenda" min="0" step="0.01" placeholder="Ex: 0,00"> <br>

            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" name="estoque" id="estoque" min="0" placeholder="Ex: 0"> <br>

            <label for="seleçãoSetor">Setor</label>
            <select name="seleçãoSetor" id="seleçãoSetor">
                <option value="1">Frios e Laticínios</option>
                <option value="2">Higiene e limpeza</option>
                <option value="3">Vegetais e frutas</option>
                <option value="4">Açougue</option>
                <option value="5">Padaria</option>
                <option value="6">Cereais</option>
                <option value="7">Enlatados</option>
                <option value="8">Adega e Bebidas</option>
            </select> <br>

            <label for="distribuidora">Distribuidora</label>
            <input type="text" name="distribuidora" id="distribuidora" placeholder="Ex: Fazenda Feliz"> <br>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="funcoes.php" method="POST">
            <input type="hidden" name="idProduto" id="editIdProduto">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="editNome" placeholder="Ex: Maçã"> <br>

            <label for="precoCompra">Preço de Compra</label>
            <input type="number" name="preçoCompra" id="editPreçoCompra" min="0" step="0.01" placeholder="Ex: 0,00"> <br>

            <label for="precoVenda">Preço de Venda</label>
            <input type="number" name="preçoVenda" id="editPreçoVenda" min="0" step="0.01" placeholder="Ex: 0,00"> <br>

            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" name="estoque" id="editEstoque" min="0" placeholder="Ex: 0"> <br>

            <label for="seleçãoSetor">Setor</label>
            <select name="seleçãoSetor" id="seleçãoSetor">
                <option value="1">Frios e Laticínios</option>
                <option value="2">Higiene e limpeza</option>
                <option value="3">Vegetais e frutas</option>
                <option value="4">Açougue</option>
                <option value="5">Padaria</option>
                <option value="6">Cereais</option>
                <option value="7">Enlatados</option>
                <option value="8">Adega e Bebidas</option>
            </select> <br>

            <label for="distribuidora">Distribuidora</label>
            <input type="text" name="distribuidora" id="editDistribuidora" placeholder="Ex: Fazenda Feliz"> <br>
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
      <form action="funcoes.php" method="post">
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
<script text="text/javascript" src="../JS/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Scripts do projeto -->
</body>
</html>