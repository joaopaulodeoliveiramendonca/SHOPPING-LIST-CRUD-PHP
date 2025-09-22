<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-dark">Lista de Compras</h1>

        <!-- Exibição de mensagens de sucesso e erro -->
        <?php
        // Exibir mensagem de sucesso
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }

        // Exibir mensagem de erro
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
        ?>

        <a href="add" class="btn btn-primary mb-3">Adicionar Item</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
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
                        <td>
                            <a href="edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>