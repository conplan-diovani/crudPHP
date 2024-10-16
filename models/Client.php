<?php
require_once('./configuration/connect.php');

class ClientModel extends Connect {
    private $table;

    function __construct() {
        parent::__construct();
        $this->table = 'client';
    }

    function getAll() {
        $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }

    function getById($id) {
        $sqlSelect = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
        $sqlSelect->bindParam(':id', $id);
        $sqlSelect->execute();
        return $sqlSelect->fetch();
    }

    function add($name, $email, $phone) {
        $sqlInsert = $this->connection->prepare("INSERT INTO $this->table (name, email, phone) VALUES (:name, :email, :phone)");
        $sqlInsert->bindParam(':name', $name);
        $sqlInsert->bindParam(':email', $email);
        $sqlInsert->bindParam(':phone', $phone);
        return $sqlInsert->execute();
    }

    function update($id, $name, $email, $phone) {
        $sqlUpdate = $this->connection->prepare("UPDATE $this->table SET name = :name, email = :email, phone = :phone WHERE id = :id");
        $sqlUpdate->bindParam(':id', $id);
        $sqlUpdate->bindParam(':name', $name);
        $sqlUpdate->bindParam(':email', $email);
        $sqlUpdate->bindParam(':phone', $phone);
        return $sqlUpdate->execute();
    }

    function delete($id) {
        $sqlDelete = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
        $sqlDelete->bindParam(':id', $id);
        return $sqlDelete->execute();
    }
}
?>
