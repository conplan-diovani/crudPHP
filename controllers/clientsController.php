<?php
require_once('./models/Client.php');

class clientsController {
    private $model;

    function __construct() {
        $this->model = new ClientModel;
    }

    function getAll() {
        $resultData = $this->model->getAll();
        require_once("./views/index.php");
    }

    function addForm() {
        require_once("./views/add.php");
    }

    function add() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        if ($this->model->add($name, $email, $phone)) {
            header('Location: index.php');
        } else {
            echo "Erro ao adicionar cliente.";
        }
    }

    function editForm($id) {
        $client = $this->model->getById($id);
        require_once("./views/edit.php");
    }

    function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        if ($this->model->update($id, $name, $email, $phone)) {
            header('Location: index.php');
        } else {
            echo "Erro ao atualizar cliente.";
        }
    }

    function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: index.php');
        } else {
            echo "Erro ao deletar cliente.";
        }
    }
}
?>
