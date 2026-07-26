<?php
// Fetch frontend data from GitHub Pages
header("Access-Control-Allow-Origin: https://lueyangyue.github.io");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

// Connect database from DigitalOcean Console
$host = "db-pgsql-nyc1-13324-do-user-39786782-0.l.db.ondigitalocean.com";//Default host is  "localhost"
$port = "25060";
$username = "sippadmin";//Default username is "root"
$password = getenv("DATABASE");//Default password is ""
$db = "sippdb";
$ca = "/var/www/cert/ca-certificate.crt";

// Establish SSL-encrypted PDO Handshake
$options = [
    PDO::MYSQL_ATTR_SSL_CA => $ca, 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4"; // Specify Data Source Name
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    // Hide inner DB details
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Gagal menyambung pangkalan data."]);
}
?>