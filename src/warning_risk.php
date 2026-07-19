<?php
session_start();
require_once 'database.php';
if (!isset($_GET['stud_id']) && !isset($_GET['id']) && !isset($_GET['session']) && !isset($_GET['no'])) {
  session_destroy();
  exit();
} else if (isset($_GET['stud_id'])) {
try {
  $sql = "SELECT prestasi.status FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $status = $stmt->fetchColumn();
  if ($status === "Berisiko") {exit($status);}
  $sql = "UPDATE prestasi SET prestasi.status = \"Berisiko\" WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $sql = "UPDATE pelajar SET pelajar.status = \"Berisiko\" WHERE pelajar.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id']]);
  $sql = "SELECT MAX(no) AS max_no FROM peringatan";
  $result = $conn->query($sql);
  $row = $result->fetch();
  $next_r = $row['max_no'] + 1;
  $sql = "SELECT kod FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $perf = $stmt->fetchColumn();
  $sql = "INSERT INTO peringatan (no, prestasi) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$next_r, $perf]);
} catch (Exception $e) {
  exit($e->getMessage());
}
} else if (isset($_GET['id']) && !isset($_GET['no'])) {
try {
  $sql1 = "SELECT COUNT(no) FROM peringatan AS e JOIN prestasi AS r ON e.prestasi = r.kod WHERE dibaca = 0 AND r.pelajar = ?";
  $stmt = $conn->prepare($sql1);
  $stmt->execute([$_GET['id']]);
  $total = $stmt->fetchColumn();
  $sql1 = "SELECT * FROM peringatan AS e JOIN prestasi AS r ON e.prestasi = r.kod WHERE dibaca = 0 ";
  $sql2 = "AND r.pelajar = ? ORDER BY e.no DESC";
  $sql3 = $sql1 . $sql2;
  $stmt = $conn->prepare($sql3);
  $stmt->execute([$_GET['id']]);
  if ($stmt->rowCount() > 0) {
    echo "<h4 style=\"margin: 1rem;\">Jumlah peringatan: $total</h4>\n";
    echo "<i style = \"margin: 0 1rem;\">Letakkan kursor pada sudut kanan atas kotak untuk menatal senarai peringatan</i>";
    echo "<br /><br /><br />\n"; 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $no = $row['no'];
    $id = $_GET['id'];
    $code = $row['kod'];
    $time = $row['masa'];
    $session = $row['sesi'];
    echo "<button class=\"notification\" onclick=\"markRead(this,$no,'$id')\">$time<br />Prestasi $session ($code)";
    echo " telah ditandai sebagai berisiko.<br />Sila ambil maklum. </button>\n";
    }
  }
} catch (Exception $e) {
  exit($e->getMessage());
}
} else if (isset($_GET['no'])) {
try {
  $sql = "UPDATE peringatan SET dibaca = 1 WHERE no = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['no']]);
} catch (Exception $e) {
  exit($e->getMessage());
}
}
?>