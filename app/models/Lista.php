<?php

class Lista {
    private $conn;
    private $table_name = "itens_compras";

    public $id;
    public $nome;
    public $quantidade;
    public $preco;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar um novo item
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, quantidade=:quantidade, preco=:preco";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":preco", $this->preco);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Ler todos os itens
    public function read() {
        $query = "SELECT id, nome, quantidade, preco FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Ler um item específico
    public function readOne() {
        $query = "SELECT id, nome, quantidade, preco FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt;
    }

    // Atualizar um item
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, quantidade = :quantidade, preco = :preco WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Deletar um item
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
