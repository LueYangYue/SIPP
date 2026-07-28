<?php
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['pw'] === $_POST['vpw']) {
try {
  //Register tester
  $sql = "SELECT MAX(id) AS max_no FROM pengguna WHERE id LIKE 'T%'";
  $result = $conn->query($sql);
  $row = $result->fetch();
  $next_r = $row['max_no'] + 1;
  $role = $_POST['role'];
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $name = $_POST['name'];
  $sesi = "2/20252026";
  $sql = "INSERT INTO pengguna (id, kataLaluan, nama, sesi, peranan) VALUES ($id, $pw, $name, $sesi, $role)";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  switch ($role) {
    case 1:
      $sql = "INSERT INTO pensyarah VALUES ($id)";
      $stmt = $conn->prepare($sql1);
      $stmt->execute();
      $sql = "INSERT INTO ketuaprogram VALUES ($id)";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      break;
    case 2:
      $sql = "INSERT INTO pensyarah VALUES ($id)";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      break;
    case 3:
      $year = $_POST['year'];
      $semester = $_POST['semester'];
      $sql = "INSERT INTO pelajar VALUES ($id, $year, $semester, 'Selamat')";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      break;
  }
function categorize ($suggestion){
  $suggestion = explode("; ", $suggestion);


  return "<b>$category</b><br /><br />" . $suggestion[1];
}
} catch (Exception $e) {
  exit($e->getMessage());
}
}
?>