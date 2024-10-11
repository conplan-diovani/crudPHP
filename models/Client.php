<?
    require_once('./configuration/connect.php');

    class ClientModel extends Connect{
        private $table;

        function __construct()
        {
            parent::__construct();
            $this->table = 'client';
        }

        function getAll(){
            $sqlSelect = $this->connection->query("SELECT * FROM $this->table");
        
            $resultQuery = $sqlSelect->fetchAll();
            return $resultQuery;
        }
    }


?>