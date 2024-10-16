<?php
define('HOST', 'localhost');
define('DATABASENAME', 'crud-php');
define('USER', 'root');
define('PASSWORD', '');

class Connect {
    protected $connection;

    function __construct() {
        $this->connectDatabase();
    }

    function connectDatabase() {
        try {
            $this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASENAME, USER, PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

    function getConnection() {
        return $this->connection;
    }
}

// Inicializa a conexão
$database = new Connect();
$conn = $database->getConnection();

// Obter o método da requisição
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        // Listar registros
        $stmt = $conn->prepare("SELECT * FROM registros");
        $stmt->execute();
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($registros);
        break;

    case 'POST':
        // Adicionar um novo registro
        $data = json_decode(file_get_contents('php://input'), true);
        $nome = $data['nome'];
        $idade = $data['idade'];
        $stmt = $conn->prepare("INSERT INTO registros (nome, idade) VALUES (:nome, :idade)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        
        if ($stmt->execute()) {
            http_response_code(201); // Created
            echo json_encode(['id' => $conn->lastInsertId()]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Erro ao adicionar registro']);
        }
        break;

    case 'PUT':
        // Atualizar um registro
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $nome = $data['nome'];
        $idade = $data['idade'];
        $stmt = $conn->prepare("UPDATE registros SET nome=:nome, idade=:idade WHERE id=:id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'Registro atualizado']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Erro ao atualizar registro']);
        }
        break;

    case 'DELETE':
        // Deletar um registro
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM registros WHERE id=:id");
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            http_response_code(204); // No Content
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Erro ao deletar registro']);
        }
        break;

    default:
        http_response_code(405); // Method Not Allowed
        break;
}

$conn = null; // Fecha a conexão
?>
