<?php
// Incluindo o autoload do Faker
require './Faker/src/autoload.php';

use Faker\Factory as Faker;

// Configurações do banco de dados
$host = 'localhost';
$db = 'crud-php'; // Nome do seu banco de dados
$user = 'root'; // Seu usuário do banco de dados
$pass = ''; // Sua senha do banco de dados

// Cria a conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Cria uma instância do Faker
$faker = Faker::create();

// Prepara a query de inserção
$stmt = $pdo->prepare("INSERT INTO client (name, email, phone, country, address) VALUES (?, ?, ?, ?, ?)");

// Gera e insere 50.000 registros
for ($i = 0; $i < 50000; $i++) {
    $name = $faker->name;
    $email = $faker->unique()->safeEmail;
    $phone = $faker->phoneNumber;
    $country = $faker->country;
    $address = $faker->address;

    // Executa a inserção
    $stmt->execute([$name, $email, $phone, $country, $address]);

    // Opcional: imprime uma mensagem a cada 1000 inserções
    if ($i % 1000 == 0) {
        echo "Inseridos $i registros...\n";
    }
}

echo "Inserção completa!";
