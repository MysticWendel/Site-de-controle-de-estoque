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
        $query = mysqli_query($conn, $result);

        if($query){
        $_SESSION['sucesso'] = "O produto foi inserido com sucesso!";
        header( "Location: listaProdutos.php" );
        die();
    } else {
        $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
        header( "Location: listaProdutos.php" );
        die();
    }

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

        $query = mysqli_query($conn, $result);

        if($query){
            $_SESSION['sucesso'] = "O produto foi editado com sucesso!";
            header( "Location: listaProdutos.php" );
            die();
        } else {
            $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
            header( "Location: listaProdutos.php" );
            die();
        }

    }

    if (isset($_POST['deletarProduto'])){

        $idProduto = $conn->real_escape_string($_POST['idDeletar']);

        $result = "DELETE from produtos where idProduto = $idProduto";
        
        $query = mysqli_query($conn, $result);

        if($query){
        $_SESSION['sucesso'] = "O produto foi deletado com sucesso!";
        header( "Location: listaProdutos.php" );
        die();
    } else {
        $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
        header( "Location: listaProdutos.php" );
        die();
    }
    }

    if (isset($_POST['adcionarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $conn->real_escape_string($_POST['idUsuario']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);
        $tipo = $conn->real_escape_string($_POST['seleçãoTipo']);

        $checarDuplicata = $conn->query("SELECT idUsuario, email FROM usuarios WHERE email = '$email'");
        $row = $checarDuplicata->fetch_assoc();

        if($row && $row['idUsuario'] <> $idUsuario){
            $_SESSION['erro'] = "Esse email já foi registrado!";
            header( "Location: listaUsuarios.php" );
            die();
        }

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $result = "INSERT INTO usuarios VALUES ($idUsuario, '$email', '$senhaHash', '$username', $tipo)";

        $query = mysqli_query($conn, $result);

        if($query){
        $_SESSION['sucesso'] = "O Usuario foi registrado com sucesso!";
        header( "Location: listaUsuarios.php" );
        die();
    } else {
        $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
        header( "Location: listaUsuarios.php" );
        die();
    }

    }

    if (isset($_POST['editarUsuario'])){
        //Informações que serão inseridas no banco de dados.
        $idUsuario = $conn->real_escape_string($_POST['idUsuario']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);
        $tipo = $conn->real_escape_string($_POST['seleçãoTipo']);
        
        $checarDuplicata = $conn->query("SELECT idUsuario, email FROM usuarios WHERE email = '$email'");
        $row = $checarDuplicata->fetch_assoc();

        if($row && $row['idUsuario'] <> $idUsuario){
            $_SESSION['erro'] = "Esse email já foi registrado!";
            header( "Location: listaUsuarios.php" );
            die();
        }

        if ($senha == null) {

            $result = "UPDATE usuarios SET email = '$email', username = '$username', tipo_usuario = $tipo WHERE idUsuario = $idUsuario";

            $query = mysqli_query($conn, $result);

            if($query){
            $_SESSION['sucesso'] = "O Usuario foi editado com sucesso!";
            header( "Location: listaUsuarios.php" );
            die();
        } else {
            $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
            header( "Location: listaUsuarios.php" );
            die();
        }

        } else {

            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            $result = "UPDATE usuarios SET email = '$email', senha = '$senhaHash', username = '$username', tipo_usuario = $tipo WHERE idUsuario = $idUsuario";

            $query = mysqli_query($conn, $result);

            if($query){
            $_SESSION['sucesso'] = "O Usuario foi editado com sucesso!";
            header( "Location: listaUsuarios.php" );
            die();
        } else {
            $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
            header( "Location: listaUsuarios.php" );
            die();
    }

    }
}

    if (isset($_POST['deletarUsuario'])){

        $idUsuario = $conn->real_escape_string($_POST['idDeletar']);

        $result = "DELETE from usuarios where idUsuario = $idUsuario";
        $query = mysqli_query($conn, $result);
        
        if($query){
            $_SESSION['sucesso'] = "O Usuario foi deletado com sucesso!";
            header( "Location: listaUsuarios.php" );
            die();
        } else {
            $_SESSION['erro'] = "Houve uma falha na inserção de dados.";
            header( "Location: listaUsuarios.php" );
            die();
    }
}

?>