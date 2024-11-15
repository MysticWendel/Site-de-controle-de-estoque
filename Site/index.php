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
            <select name="seleçãoSetor" id="seleçãoSetor">
                <option value="0">---Todos---</option>
                <?php 
                    while($rows = mysqli_fetch_array($setor)) {
                        echo "<option value=\"".$rows["Setor"]."\">".$rows["Setor"]."</option>";
                    }
                ?>
            </select>
            <a type="button" class="btn btn-success" href="adcionar.php">
  +
                </a>
        </div>
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

                        <td> <a type="button" class="btn btn-primary" href="editar.php?idProduto=<?php echo $rows['idProdutos']?>">
  Editar </a> <button type="button" id="botãoDeletar" class="btn btn-danger btn-del" data-bs-toggle="modal" data-bs-target="#deletarModal">
  Deletar </button> </td>
                </tr>
              <?php
                    }
            ?>
            </tbody>
        </table>
        </div>
        </div>

        <div class="modal fade" id="deletarModal" tabindex="-1" aria-labelledby="deletarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script text="text/javascript" src="../JS/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>