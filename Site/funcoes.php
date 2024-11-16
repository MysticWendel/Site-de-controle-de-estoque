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

        $result = "INSERT INTO produtos VALUES ($idProduto, '$nome', $compra, $venda, $estoque, '$distribuidora', $setor)";

        echo "<h1>$result</h1>";

        mysqli_query($conn, $result);
        header( "Location: listaProdutos.php" );

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

        $result = "UPDATE produtos SET nome = '$nome', preço_compra = $compra, preço_venda = $venda, estoque = $estoque, distribuidora = '$distribuidora', idSetor = $setor WHERE idProduto = $idProduto";

        echo "<h1>$result</h1>";

        mysqli_query($conn, $result);
        header( "Location: listaProdutos.php" );

    }

    if (isset($_POST['deletarProduto'])){

        $idProduto = $_POST['idDeletar'];

        $result = "DELETE from produtos where idProduto = $idProduto";
        mysqli_query($conn, $result);
        
        header( "Location: listaProdutos.php" );
    }

    if (isset($_POST['adcionarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $_POST['idUsuario'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $result = "INSERT INTO usuarios VALUES ($idUsuario, '$email', '$senha', '$username', 0)";


        mysqli_query($conn, $result);
        header( "Location: listaUsuarios.php" );

    }

    if (isset($_POST['editarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $_POST['idUsuario'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $result = "UPDATE usuarios SET email = '$email', senha = '$senha', username = '$username' WHERE idUsuario = $idUsuario";

        var_dump($result);

        mysqli_query($conn, $result);
        header( "Location: listaUsuarios.php" );

    }

    if (isset($_POST['deletarUsuario'])){

        $idUsuario = $_POST['idDeletar'];

        $result = "DELETE from usuarios where idUsuario = $idUsuario";
        mysqli_query($conn, $result);
        
        header( "Location: listaUsuarios.php" );
    }

     
?>