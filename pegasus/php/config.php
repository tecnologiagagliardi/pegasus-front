<?php
// db.php - Conexão com o banco de dados PostgreSQL

$host = "192.168.1.180";
$port = "5432";
$dbname = "pegasus_db";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>