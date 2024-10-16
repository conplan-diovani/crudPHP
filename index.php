<?php
require_once('./controllers/clientsController.php');

$controller = new clientsController;
$action = !empty($_GET['a']) ? $_GET['a'] : 'getAll';

if ($action === 'editForm' || $action === 'delete') {
    $id = $_GET['id'];
    $controller->{$action}($id);
} else {
    $controller->{$action}();
}
?>
