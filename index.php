<?php
include_once 'conection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Bem-vindo ao sistema de gerenciamento de produtos</h1>
    <h1>Listando Dados</h1>
    <form action="select.php" method="get">
        <label for="id">ID(Opcional)</label>
        <input type="text" name="id" id="id">
        <label for="ordenacao">Ordenar por:</label>
        <select name="ordenacao" id="ordenacao">
            <option value="crescente">Crescente</option>
            <option value="decrescente">Decrescente</option>
        </select>
        <input type="submit" value="Filtrar">
    </form>
    <?php
    session_start();
    include_once 'conection.php';

    if (isset($_SESSION['resultados'])) {
        $resultados = $_SESSION['resultados'];
        echo "<h1>Resultados da Busca:</h1>";

        foreach ($resultados as $row) {
            echo "<p>ID: " . $row['id_produto'] . "</p>";
            echo "<p>Nome: " . $row['nome_produto'] . "</p>";
            echo "<p>Preço: " . $row['preco'] . "</p>";
            if ($row['quantidade'] <= 5) {
                echo "<p style='color: red;'>Quantidade: " . $row['quantidade'] . "</p>";
            } else {
                echo "<p>Quantidade: " . $row['quantidade'] . "</p>";
            }
            echo "<p>Descrição: " . $row['descricao'] . "</p>";
            echo "<p>Categoria: " . $row['id_categoria'] . "</p>";
            echo "<hr>";
        }
        unset($_SESSION['resultados']);
    }

    if (isset($_SESSION['mensagem'])) {
        if ($_SESSION['mensagem'] == 'nenhum_produto') {
            echo "<p>Nenhum produto encontrado com os critérios especificados.</p>";
        }
        unset($_SESSION['mensagem']);
    }

    if (isset($_SESSION['erro'])) {
        if ($_SESSION['erro'] == 'metodo_invalido') {
            echo "<p>Erro na requisição.</p>";
        }
        unset($_SESSION['erro']);
    }
    ?>
    <h1>Insira um Dado</h1>
    <form action="insert.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="Nome" id="Nome">
        <label for="preco">Preço</label>
        <input type="text" name="Preco" id="Preco">
        <label for="descricao">Descrição</label>
        <input type="text" name="Descricao" id="Descricao">
        <label for="quantidade">Quantidade</label>
        <input type="text" name="Quantidade" id="Quantidade">
        <fieldset>
            <legend>Escolha a categoria:</legend>

            <label for="categoria">Categoria</label>
            <select id="categoria" name="categoria">
                <option value="material">material</option>
                <option value="ferramenta">ferramenta</option>
                <option value="acabamento">acabamento</option>
            </select>

        </fieldset>
        <button>Submit</button>
    </form>

    <h1>Atualize um dado</h1>
    <form action="update.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <label for="nome">Nome</label>
        <input type="text" name="Nome" id="Nome">
        <label for="preco">Preço</label>
        <input type="text" name="Preco" id="Preco">
        <label for="descricao">Descrição</label>
        <input type="text" name="Descricao" id="Descricao">
        <label for="quantidade">Quantidade</label>
        <input type="text" name="Quantidade" id="Quantidade">
        <fieldset>
            <legend>Escolha a categoria:</legend>
            <label for="categoria">Categoria</label>
            <select id="categoria" name="categoria">
                <option value="material">material</option>
                <option value="ferramenta">ferramenta</option>
                <option value="acabamento">acabamento</option>
            </select>
        </fieldset>

        <button>Submit</button>
    </form>
    <h1>Removendo Dados</h1>
    <p>Selecione o ID do dado que você deseja apagar</p>
    <form action="drop.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <button>Enviar</button>
    </form>
</body>

</html>