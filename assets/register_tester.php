<?php
require_once 'database.php';
function generateTester() {
  try {
    $sql = "SELECT MAX(id) AS max_no FROM pengguna WHERE id LIKE 'T%'";
    $result = $conn->query($sql);
    $last_tester = $result->fetch();
    if ($last_tester && preg_match('/^T(\d+)$/', $last_tester['max_no'], $matches)) {
      $next_r = 'T' . str_pad($matches[1] + 1, 6, '0', STR_PAD_LEFT);
    } else {
      $next_r = 'T000001';
    }
  } catch (Exception $e) {
    exit("Gagal menjana ID percubaan: " . $e->getMessage());
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['pw']) && isset($_POST['vpw']) && $_POST['pw'] === $_POST['vpw']) {
  $conn->begin_transaction();
  try {
    // Prevent concurrent inserts using same ID by locking the table
    $sql = "LOCK TABLES pengguna WRITE, pelajar WRITE";
    $conn->query($sql); // Lock tables with exec($sql) if using PDO
    $role = $_POST['role'];
    $id = $_POST['id'];
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $sesi = "2/20252026";
    $sql = "INSERT INTO pengguna (id, kataLaluan, nama, sesi, peranan) VALUES ($id, $pw, $name, $sesi, $role)";
    $stmt = $conn->prepare($sql);
    if (!$stmt->execute()) {
      throw new Exception("Gagal mendaftar pengguna: " . $stmt->error);
    };
    /*
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
    }*/
  function validateForm($suggestion){
    $suggestion = explode("; ", $suggestion);
    return "<b>$category</b><br /><br />" . $suggestion[1];
  }
  } catch (Exception $e) {
    exit($e->getMessage());
  }
  }
}
?>