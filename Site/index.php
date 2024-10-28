<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Teste</title>
</head>
<?php
    include_once('connection.php');

    //Tabelas
    $produto = $conn->query("SELECT p.idProdutos, p.nome, p.preçoCompra, p.preçoVenda, p.estoque, p.distribuidora, p.disponilidade, s.Setor FROM produtos as p, setores as s where p.idSetores = s.idSetores ORDER BY idProdutos;");
    $setor = $conn->query("SELECT * FROM setores ORDER BY idSetores");

    //Função ativada após o botão do formulário ser pressionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Informações que serão inseridas no banco de dados.
        $nome = $_POST['nome'];
        $compra = $_POST['preçoCompra'];
        $venda = $_POST['preçoVenda'];
        $estoque = $_POST['estoque'];
        $distribuidora = $_POST['distribuidora'];
        $setor = $_POST['seleçãoSetor'];

        if ($estoque > 0){
            $disponibilidade = 1;
        } else {
            $disponibilidade = 0;
        }

        //Insert das informações no banco de dados
        $result = "INSERT INTO produtos
        VALUES (null, '$nome', $compra, $venda, $estoque, '$distribuidora', $disponibilidade, $setor)";
        mysqli_query($conn, $result);
    
        //Redirecionamento
        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
    }
     
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
            <button id='botãoAdição' class="botãoAdição">+</button>
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

                        echo "<td> <button class=\"botãoEditar\">Editar</button> <button class=\"botãoDeletar\">Deletar</button> </td>";
                echo "</tr>";
                    }
            ?>
            </tbody>
        </table>
        </div>
        </div>

        <div id="formularioModal" class='formularioModal'>
            <div class='formularioConteudo'>
            <h2>Formulário</h2> <span id="fechar" class='fechar'>&times;</span>
            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">

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
                <input type="text" name="distribuidora" id="distribuidora" required> <br>

                <input type="submit" value="submit">
            </form>
            </div>
        </div>
    </main>
</body>
</html>