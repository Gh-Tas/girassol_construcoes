<?php 
    include_once 'conection.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nome = $_POST['Nome'];
        $preco = $_POST['Preco'];
        $descricao = $_POST['Descricao'];
        $categoria = $_POST['material'] ?? $_POST['ferramenta'] ?? $_POST['acabamento'] ?? null;

        if (empty($id)) {
            $id = '';
        }
        if (empty($nome)) {
            $nome = '';
        }
        if (empty($preco)) {
            $preco = '';
        }
        if (empty($descricao)) {
            $descricao = '';
        }
        if (empty($categoria)) {
            $categoria = '';
        }

        if (isset($_POST['materia']) && !empty($_POST['materia'])) {
            $categoria = 1;
        } elseif (isset($_POST['ferramenta'])) {
            $categoria = 2;
        } elseif (isset($_POST['acabamento'])) {
            $categoria = 3;
        }

        if (empty($nome) || empty($preco) || empty($descricao) || empty($categoria)) {
            $_SESSION['mensagem'] = 'preencha_todos_os_campos';
            echo "<p>Erro ao atualizar o produto.</p>";
            echo "<p>Por favor, preencha todos os campos.</p>";
        }
        
        $sql = ("UPDATE produtos SET nome_produto = :nome, preco = :preco, descricao = :descricao, id_categoria = :id_categoria WHERE id_produto = :id");
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
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
?>