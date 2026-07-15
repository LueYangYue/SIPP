<?php
//Open a database connection with PDO
$host = "db-pgsql-nyc1-13324-do-user-39786782-0.l.db.ondigitalocean.com";//Default host is  "localhost"
$port = "25060";
$username = "sippadmin";//Default username is "root"
$password = "AVNS_d3E94q7SNqXscgEAot-";//Default password is ""
$db = "sippdb";
$ca = "/var/www/cert/ca-certificate.crt";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>