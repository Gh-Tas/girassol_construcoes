<?php
require_once 'conection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = ("DELETE FROM produtos WHERE id_produto = :id");
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "<p>Erro ao excluir o produto.</p>";
        echo "<p>Por favor, tente novamente.</p>";
    }
} else {
    $_SESSION['erro'] = 'metodo_invalido';
    echo "<p>Erro na requisição.</p>";
    echo "<p>Por favor, tente novamente.</p>";
}
