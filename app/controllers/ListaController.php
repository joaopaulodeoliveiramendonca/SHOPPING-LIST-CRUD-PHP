<?php

// Incluir o modelo
require_once 'app/models/Lista.php';

class ListaController {
    private $listaModel;

    public function __construct($db) {
        $this->listaModel = new Lista($db);
    }

    // Exibir todos os itens
    public function index() {
        $itens = $this->listaModel->read();

        // Exibir a view index.php
        require_once 'app/views/index.php';
    }

    // Exibir o formulário para adicionar um novo item
    public function create() {
        require_once 'app/views/add.php';
    }

    // Adicionar um novo item
    public function store() {
        if ($_POST) {
            // Validação de campos
            if (empty($_POST['nome']) || empty($_POST['quantidade']) || empty($_POST['preco'])) {
                $_SESSION['error'] = "Todos os campos são obrigatórios!";
                header("Location: /");
                return;
            }

            if (!is_numeric($_POST['quantidade']) || !is_numeric($_POST['preco'])) {
                $_SESSION['error'] = "Quantidade e preço devem ser números válidos!";
                header("Location: /");
                return;
            }

            // Atribuindo valores
            $this->listaModel->nome = $_POST['nome'];
            $this->listaModel->quantidade = $_POST['quantidade'];
            $this->listaModel->preco = $_POST['preco'];

            // Criar o item
            if ($this->listaModel->create()) {
                $_SESSION['success'] = "Item adicionado com sucesso!";
                header("Location: /");
            } else {
                $_SESSION['error'] = "Erro ao adicionar item!";
                header("Location: /");
            }
        }
    }

    // Exibir o formulário para editar um item
    public function edit($id) {
        $this->listaModel->id = $id;
        $item = $this->listaModel->readOne()->fetch(PDO::FETCH_ASSOC);

        require_once 'app/views/edit.php';
    }

    // Atualizar um item
    public function update($id) {
        if ($_POST) {
            // Validação de campos
            if (empty($_POST['nome']) || empty($_POST['quantidade']) || empty($_POST['preco'])) {
                $_SESSION['error'] = "Todos os campos são obrigatórios!";
                header("Location: /");
                return;
            }

            if (!is_numeric($_POST['quantidade']) || !is_numeric($_POST['preco'])) {
                $_SESSION['error'] = "Quantidade e preço devem ser números válidos!";
                header("Location: /");
                return;
            }

            // Atribuindo valores
            $this->listaModel->id = $id;
            $this->listaModel->nome = $_POST['nome'];
            $this->listaModel->quantidade = $_POST['quantidade'];
            $this->listaModel->preco = $_POST['preco'];

            // Atualizar o item
            if ($this->listaModel->update()) {
                $_SESSION['success'] = "Item atualizado com sucesso!";
                header("Location: /");
            } else {
                $_SESSION['error'] = "Erro ao atualizar item!";
                header("Location: /");
            }
        }
    }

    // Deletar um item
    public function delete($id) {
        $this->listaModel->id = $id;
        if ($this->listaModel->delete()) {
            $_SESSION['success'] = "Item excluído com sucesso!";
            header("Location: /");
        } else {
            $_SESSION['error'] = "Erro ao excluir item!";
            header("Location: /");
        }
    }
}
