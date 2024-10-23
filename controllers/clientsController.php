<?php

// Inclua o arquivo autoload.php da pasta Faker que você baixou
require_once 'faker/src/autoload.php';

use Faker\Factory as Faker;

// Conexão com o banco de dados
$host = 'localhost';
$db = 'SistemaEscolar';
$user = 'root';  // Seu usuário do MySQL
$pass = '';  // Sua senha do MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$faker = Faker::create('pt_BR');  // Gera dados em português do Brasil

// Função para inserir 50k de dados na tabela Alunos
function inserirAlunos($pdo, $faker, $quantidade = 50000) {
    $stmt = $pdo->prepare('INSERT INTO Alunos (nome, data_nascimento, endereco, telefone, email) VALUES (?, ?, ?, ?, ?)');
    
    for ($i = 0; $i < $quantidade; $i++) {
        $stmt->execute([
            $faker->name,
            $faker->date('Y-m-d', '-18 years'),  // Data de nascimento para alunos com mais de 18 anos
            $faker->address,
            $faker->phoneNumber,
            $faker->unique()->email
        ]);
    }

    echo "50k Alunos inseridos.\n";
}

// Função para inserir 50k de dados na tabela Cursos
function inserirCursos($pdo, $faker, $quantidade = 50000) {
    $stmt = $pdo->prepare('INSERT INTO Cursos (nome_curso, duracao, descricao) VALUES (?, ?, ?)');
    
    for ($i = 0; $i < $quantidade; $i++) {
        $stmt->execute([
            $faker->words(3, true),  // Nome do curso com 3 palavras
            $faker->numberBetween(6, 48),  // Duração do curso entre 6 e 48 meses
            $faker->paragraph  // Descrição do curso
        ]);
    }

    echo "50k Cursos inseridos.\n";
}

// Função para inserir 50k de dados na tabela Professores
function inserirProfessores($pdo, $faker, $quantidade = 50000) {
    $stmt = $pdo->prepare('INSERT INTO Professores (nome, especialidade, email, telefone) VALUES (?, ?, ?, ?)');
    
    for ($i = 0; $i < $quantidade; $i++) {
        $stmt->execute([
            $faker->name,
            $faker->jobTitle,  // Especialidade do professor
            $faker->unique()->email,
            $faker->phoneNumber
        ]);
    }

    echo "50k Professores inseridos.\n";
}

// Função para inserir 50k de dados na tabela Matriculas
function inserirMatriculas($pdo, $faker, $quantidade = 50000) {
    $stmt = $pdo->prepare('INSERT INTO Matriculas (id_aluno, id_curso, data_matricula) VALUES (?, ?, ?)');
    
    for ($i = 0; $i < $quantidade; $i++) {
        $stmt->execute([
            $faker->numberBetween(1, 50000),  // Supondo que já existam 50k alunos e 50k cursos
            $faker->numberBetween(1, 50000),
            $faker->date('Y-m-d')
        ]);
    }

    echo "50k Matrículas inseridas.\n";
}

// Função para inserir 50k de dados na tabela Aulas
function inserirAulas($pdo, $faker, $quantidade = 50000) {
    $stmt = $pdo->prepare('INSERT INTO Aulas (id_curso, id_professor, data_aula, conteudo) VALUES (?, ?, ?, ?)');
    
    for ($i = 0; $i < $quantidade; $i++) {
        $stmt->execute([
            $faker->numberBetween(1, 50000),  // Supondo que já existam 50k cursos e 50k professores
            $faker->numberBetween(1, 50000),
            $faker->date('Y-m-d'),
            $faker->paragraph  // Conteúdo da aula
        ]);
    }

    echo "50k Aulas inseridas.\n";
}

// Chamando as funções para preencher as tabelas
inserirAlunos($pdo, $faker);
inserirCursos($pdo, $faker);
inserirProfessores($pdo, $faker);
inserirMatriculas($pdo, $faker);
inserirAulas($pdo, $faker);

echo "Inserção concluída.\n";
?>
