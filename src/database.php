<?php
//Open a database connection with PDO
$servername = "db-pgsql-nyc1-13324-do-user-39786782-0.l.db.ondigitalocean.com";//"localhost" or "lrgs.ftsm.ukm.my"
$username = "sippadmin";//Default username is "root", lrgs is "A202211", sipp is "sipp-admin"
$password = "AVNS_d3E94q7SNqXscgEAot-";//Default password is ""
$dbname = "sippdb";//"sipp" or "a202211"
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
//Close database connection before the script ends with PDO: $conn = null;
?>