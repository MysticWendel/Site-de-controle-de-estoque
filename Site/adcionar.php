<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>