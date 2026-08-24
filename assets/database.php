<?php
//Open a database connection with PDO
$host = $DATABASE_HOST;//Default host is  "localhost", "dbaas-db-3754887-do-user-39786782-0.a.db.ondigitalocean.com"
$port = $DATABASE_PORT;//25060
$username = $DATABASE_USER;//Default username is "root"
$password = $DATABASE_PW;//Default password is "", use getenv('DATABASE_PW')
$db = $DATABASE_DB;//sippdb

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>