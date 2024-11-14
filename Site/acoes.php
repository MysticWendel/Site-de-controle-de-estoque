<?php 
    //Função ativada após o botão do formulário ser pressionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Informações que serão inseridas no banco de dados.
        $id = $_POST['idProduto'];
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

        if ($id <> 'null') {
            $result = "UPDATE produtos SET nome = '$nome', preçoCompra = $compra, preçoVenda = $venda, estoque = $estoque, distribuidora = '$distribuidora', disponibilidade = $disponibilidade, idSetores = $setor WHERE idProdutos = $id";   
        } else {
            $result = "INSERT INTO produtos VALUES ($id, '$nome', $compra, $venda, $estoque, '$distribuidora', $disponibilidade, $setor)";
        }

        //Insert das informações no banco de dados
        mysqli_query($conn, $result);
    
        //Redirecionamento
        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
    }
     
?>