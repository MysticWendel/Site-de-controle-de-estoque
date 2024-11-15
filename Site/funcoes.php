<?php 
session_start();
include_once('connection.php');

    if (isset($_POST['adcionarProduto'])){
        //Informações que serão inseridas no banco de dados.
        $idProduto = $_POST['idProduto'];
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

        $result = "INSERT INTO produtos VALUES ($idProduto, '$nome', $compra, $venda, $estoque, '$distribuidora', $disponibilidade, $setor)";

        echo "<h1>$result</h1>";

        mysqli_query($conn, $result);
        header( "Location: index.php" );

    }

    if (isset($_POST['editarProduto'])){
        //Informações que serão inseridas no banco de dados.
        $idProduto = $_POST['idProduto'];
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

        $result = "UPDATE produtos SET nome = '$nome', preçoCompra = $compra, preçoVenda = $venda, estoque = $estoque, distribuidora = '$distribuidora', disponibilidade = $disponibilidade, idSetores = $setor WHERE idProdutos = $idProduto";

        mysqli_query($conn, $result);
        header( "Location: index.php" );

    }

    if (isset($_POST['deletarProduto'])){

        $idProduto = $_POST['idDeletar'];

        $result = "DELETE from produtos where idProdutos = $idProduto";
        mysqli_query($conn, $result);
        
        header( "Location: index.php" );
    }
         
    header( "Location: index.php" );

        

     
?>