<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Teste</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
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
            <input type="text" placeholder="Pesquisar..." name="barraPesquisa" id="barraPesquisa"> 
            <select name="seleçãoSetor" id="seleçãoSetor">
                <option value="0">---Todos---</option>
                <?php 
                    $i = 1;
                    while($rows = mysqli_fetch_array($setor)) {
                        echo "<option value=".$i.">".$rows["Setor"]."</option>";
                        $i++;
                    }
                ?>
            </select>
            <a type="button" class="btn btn-success" data-toggle="modal" data-target="#adcionarModal">
  +
                </a>
        </div>
        <div class='tabelaConteúdo'>
        <table>
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
                while($rows = mysqli_fetch_array($produto)){
                echo "<tr>";
                        echo "<td>". $rows['idProdutos'] ."</td>";
                        echo "<td>" . $rows['nome'] ."</td>";
                        echo "<td>" . $rows['preçoCompra'] . "</td>";
                        echo "<td>" . $rows["preçoVenda"] ."</td>";
                        echo "<td>" . $rows["estoque"] ."</td>";
                        echo "<td>" . $rows["distribuidora"] . "</td>";

                        if ($rows['estoque'] > 0){
                        echo "<td class=\"statusDisponivel\"> Disponível </td>";
                        } else {
                        echo "<td class=\"statusIndisponivel\"> Indisponível </td>";
                        }

                        echo "<td>" . $rows['Setor'] . "</td>";

                        echo "<td> <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#editarModal\">
  Editar </button> <button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#deletarModal\">
  Deletar </button> </td>";
                echo "</tr>";
                    }
            ?>
            </tbody>
        </table>
        </div>
        </div>

<div class="modal fade" id="adcionarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adcionar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="acoes.php" method="POST">
            <input type="hidden" name="idProduto" value="null">

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required> <br>

            <label for="precoCompra">Preço de Compra</label>
            <input type="number" name="preçoCompra" id="preçoCompra" min="0" step="0.01" required> <br>

            <label for="precoVenda">Preço de Venda</label>
            <input type="number" name="preçoVenda" id="preçoVenda" min="0" step="0.01" required> <br>

            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" name="estoque" id="estoque" min="0" required> <br>

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
            <input type="text" name="distribuidora" id="distribuidora"> <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="adcionarProduto" id='adcionarProduto' class="btn btn-primary">Adcionar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="acoes.php" method="post">
            
            <input type="hidden" name="editIdProduto" id="idProduto">

            <label for="nome">Nome</label>
            <input type="text" name="editnome" id="nome" required> <br>

            <label for="precoCompra">Preço de Compra</label>
            <input type="number" name="editPreçoCompra" id="preçoCompra" min="0" step="0.01" required> <br>

            <label for="precoVenda">Preço de Venda</label>
            <input type="number" name="editPreçoVenda" id="preçoVenda" min="0" step="0.01" required> <br>

            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" name="editEstoque" id="estoque" min="0" required> <br>

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
            <input type="text" name="editDistribuidora" id="distribuidora" required> <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="editarProduto" class="btn btn-primary">Adcionar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Realmente deseja deletar este item? (ID: )
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" name="deletarProduto" class="btn btn-danger">Deletar</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>