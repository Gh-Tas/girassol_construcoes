<?php
include_once 'conection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['Nome'];
    $preco = $_POST['Preco'];
    $descricao = $_POST['Descricao'];
    $categoria = $_POST['material'] ?? $_POST['ferramenta'] ?? $_POST['acabamento'];

    if (isset($_POST['material'])) {
        $categoria = 1;
    } elseif (isset($_POST['ferramenta'])) {
        $categoria = 2;
    } elseif (isset($_POST['acabamento'])) {
        $categoria = 3;
    }

    if (empty($nome) || empty($preco) || empty($descricao) || empty($categoria)) {
        $_SESSION['mensagem'] = 'preencha_todos_os_campos';
        header('Location: index.php');
        exit();
    }


    $sql = ("INSERT INTO produtos (nome_produto, preco, descricao, id_categoria) VALUES (:nome, :preco, :descricao, :id_categoria)");
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
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
