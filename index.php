<?
require_once('./controllers/clientsController.php');

    $controller = new clientsController;

    $action = !empty($_GET['a'])? $GET['a']: 'getAll';

    $controller->{$action}();
?>