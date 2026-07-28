<?php
//Open a database connection with PDO
$host = getenv('DB_HOST');//Default host is  "localhost"
$port = getenv('DB_PORT');
$username = getenv('DB_USER');//Default username is "root"
$password = getenv('DB_PW');//Default password is ""
$db = getenv('DB_DATABASE');

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>