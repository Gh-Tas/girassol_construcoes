<?php
session_start();
require_once 'conection.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $where = '';
    $params = [];
    $orderBy = '';
    $resultados = [];

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $where = "WHERE id_produto = :id";
        $params[':id'] = $_GET['id'];
    }

    if (isset($_GET['ordenacao'])) {
        $order = $_GET['ordenacao'];
        if ($order == 'crescente') {
            $orderBy = "ORDER BY id_produto ASC";
        } elseif ($order == 'decrescente') {
            $orderBy = "ORDER BY id_produto DESC";
        }
    }

    $sql = "SELECT * FROM produtos " . $where . " " . $orderBy;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($data)) {
        $_SESSION['resultados'] = $data;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "nenhum_produto";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "metodo_invalido";
    header("Location: index.php");
    exit();
}
