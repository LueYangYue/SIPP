<?php
//Open a database connection with PDO
$servername = "localhost";//"localhost" or "lrgs.ftsm.ukm.my"
$username = "root";//Default username is "root", lrgs is "A202211"
$password = "";//Default password is ""
$dbname = "sipp";//"sipp" or "a202211"
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>