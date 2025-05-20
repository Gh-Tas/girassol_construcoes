<?php
include_once 'conection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['Nome'];
    $preco = $_POST['Preco'];
    $quantidade = $_POST['Quantidade'];
    $descricao = $_POST['Descricao'];
    $categoria = $_POST['categoria'];

    if ($categoria == 'material') {
        $categoria = 1;
    } elseif ($categoria == 'ferramenta') {
        $categoria = 2;
    } elseif ($categoria == 'acabamento') {
        $categoria = 3;
    }

    var_dump($categoria);

    if (empty($nome) || empty($preco) || empty($descricao) || empty($categoria) || empty($quantidade)) {
        $_SESSION['mensagem'] = 'preencha_todos_os_campos';
        header('Location: index.php');
        exit();
    }


    $sql = ("INSERT INTO produtos (nome_produto, preco, descricao, id_categoria, quantidade) VALUES (:nome, :preco, :descricao, :id_categoria, :quantidade)");
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_categoria', $categoria);
    $stmt->execute();
    header('Location: index.php');
    exit();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = 'produto_inserido';
    } else {
        $_SESSION['mensagem'] = 'erro_inserir_produto';
    }
}
