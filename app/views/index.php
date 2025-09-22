<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }
        .actions a:hover {
            color: #0056b3;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Lista de Compras</h1>

    <!-- Exibição de mensagens de sucesso e erro -->
    <?php
    session_start();

    // Exibir mensagem de sucesso
    if (isset($_SESSION['success'])) {
        echo "<div class='message success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }

    // Exibir mensagem de erro
    if (isset($_SESSION['error'])) {
        echo "<div class='message error'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>

    <a href="add" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 10px 20px; border-radius: 5px; display: inline-block; margin-bottom: 20px;">Adicionar Item</a>
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibir todos os itens da lista de compras
            while ($item = $itens->fetch(PDO::FETCH_ASSOC)): 
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['quantidade']) ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td class="actions">
                        <a href="edit?id=<?= $item['id'] ?>">Editar</a>
                        <a href="delete?id=<?= $item['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
