<?php
// Incluindo o autoload do Faker
require './Faker/src/autoload.php';

use Faker\Factory as Faker;

// Configura��es do banco de dados
$host = 'localhost';
$db = 'crud-php'; // Nome do seu banco de dados
$user = 'root'; // Seu usu�rio do banco de dados
$pass = ''; // Sua senha do banco de dados

// Cria a conex�o
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Cria uma inst�ncia do Faker
$faker = Faker::create();

// Prepara a query de inser��o
$stmt = $pdo->prepare("INSERT INTO client (name, email, phone, country, address) VALUES (?, ?, ?, ?, ?)");

// Gera e insere 50.000 registros
for ($i = 0; $i < 50000; $i++) {
    $name = $faker->name;
    $email = $faker->unique()->safeEmail;
    $phone = $faker->phoneNumber;
    $country = $faker->country;
    $address = $faker->address;

    // Executa a inser��o
    $stmt->execute([$name, $email, $phone, $country, $address]);

    // Opcional: imprime uma mensagem a cada 1000 inser��es
    if ($i % 1000 == 0) {
        echo "Inseridos $i registros...\n";
    }
}

echo "Inser��o completa!";
