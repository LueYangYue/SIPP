<?php
// Allow frontend (GitHub Pages) to fetch data from this API safely
header("Access-Control-Allow-Origin: https://LueYangYue.github.io");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
//Open a database connection with PDO
$host = $DB_HOST;//Default host is  "localhost"
$port = $DB_PORT;
$username = $DB_USER;//Default username is "root"
$password = $DB_PW;//Default password is ""
$db = $DB_DATABASE;
$dsn = "mysql:host=$host;port=$port;$dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

if (getenv('DB_SSL') === 'true') {
    $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
}

try {
    $conn = new PDO($dsn, $username, $password, $options);
    /*$conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>