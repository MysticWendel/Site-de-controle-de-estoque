<?php 
session_start();
include_once('connection.php');

    if (isset($_POST['adcionarProduto'])){
        //Informações que serão inseridas no banco de dados.
        $idProduto = $conn->real_escape_string($_POST['idProduto']);
        $nome = $conn->real_escape_string($_POST['nome']);
        $compra = $conn->real_escape_string($_POST['preçoCompra']);
        $venda = $conn->real_escape_string($_POST['preçoVenda']);
        $estoque = $conn->real_escape_string($_POST['estoque']);
        $distribuidora = $conn->real_escape_string($_POST['distribuidora']);
        $setor = $conn->real_escape_string($_POST['seleçãoSetor']);

        $result = "INSERT INTO produtos VALUES ($idProduto, '$nome', $compra, $venda, $estoque, '$distribuidora', $setor)";

        echo "<h1>$result</h1>";

        mysqli_query($conn, $result);
        header( "Location: listaProdutos.php" );

    }

    if (isset($_POST['editarProduto'])){
        //Informações que serão inseridas no banco de dados.
        $idProduto = $conn->real_escape_string($_POST['idProduto']);
        $nome = $conn->real_escape_string($_POST['nome']);
        $compra = $conn->real_escape_string($_POST['preçoCompra']);
        $venda = $conn->real_escape_string($_POST['preçoVenda']);
        $estoque = $conn->real_escape_string($_POST['estoque']);
        $distribuidora = $conn->real_escape_string($_POST['distribuidora']);
        $setor = $conn->real_escape_string($_POST['seleçãoSetor']);

        $result = "UPDATE produtos SET nome = '$nome', preço_compra = $compra, preço_venda = $venda, estoque = $estoque, distribuidora = '$distribuidora', idSetor = $setor WHERE idProduto = $idProduto";

        echo "<h1>$result</h1>";

        mysqli_query($conn, $result);
        header( "Location: listaProdutos.php" );

    }

    if (isset($_POST['deletarProduto'])){

        $idProduto = $conn->real_escape_string($_POST['idDeletar']);

        $result = "DELETE from produtos where idProduto = $idProduto";
        mysqli_query($conn, $result);
        
        header( "Location: listaProdutos.php" );
    }

    if (isset($_POST['adcionarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $conn->real_escape_string($_POST['idUsuario']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);
        $tipo = $conn->real_escape_string($_POST['seleçãoTipo']);

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $result = "INSERT INTO usuarios VALUES ($idUsuario, '$email', '$senhaHash', '$username', $tipo)";


        mysqli_query($conn, $result);
        header( "Location: listaUsuarios.php" );

    }

    if (isset($_POST['editarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $conn->real_escape_string($_POST['idUsuario']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);
        $tipo = $conn->real_escape_string($_POST['seleçãoTipo']);

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $result = "UPDATE usuarios SET email = '$email', senha = '$senhaHash', username = '$username', tipo_usuario = $tipo WHERE idUsuario = $idUsuario";

        var_dump($result);

        mysqli_query($conn, $result);
        header( "Location: listaUsuarios.php" );

    }

    if (isset($_POST['deletarUsuario'])){

        $idUsuario = $conn->real_escape_string($_POST['idDeletar']);

        $result = "DELETE from usuarios where idUsuario = $idUsuario";
        mysqli_query($conn, $result);
        
        header( "Location: listaUsuarios.php" );
    }

     
?>