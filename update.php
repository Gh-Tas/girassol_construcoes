<?php
include_once 'conection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['Nome'];
    $preco = $_POST['Preco'];
    $quantidade = $_POST['Quantidade'];
    $descricao = $_POST['Descricao'];
    $categoria = $_POST['categoria'];

    if (empty($id)) {
        $id = '';
    }
    if (empty($nome)) {
        $nome = '';
    }
    if (empty($preco)) {
        $preco = '';
    }
    if (empty($quantidade)) {
        $quantidade = '';
    }
    if (empty($descricao)) {
        $descricao = '';
    }
    if (empty($categoria)) {
        $categoria = '';
    }

    if ($categoria == 'material') {
        $categoria = 1;
    } elseif ($categoria == 'ferramenta') {
        $categoria = 2;
    } elseif ($categoria == 'acabamento') {
        $categoria = 3;
    }

    if (empty($nome) || empty($preco) || empty($descricao) || empty($categoria)) {
        $_SESSION['mensagem'] = 'preencha_todos_os_campos';
        echo "<p>Erro ao atualizar o produto.</p>";
        echo "<p>Por favor, preencha todos os campos.</p>";
    }

    $sql = ("UPDATE produtos SET nome_produto = :nome, preco = :preco, descricao = :descricao, id_categoria = :id_categoria, quantidade = :quantidade WHERE id_produto = :id");
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_categoria', $categoria);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: index.php');
    exit();
} else {
    $_SESSION['erro'] = 'metodo_invalido';
    echo "<p>Erro na requisição.</p>";
    echo "<p>Por favor, tente novamente.</p>";
}
