<?php
session_start(); 
require_once 'database.php';
if (!isset($_GET['stud_id']) && !isset($_POST['student'])) {
  print_r($_SESSION);
  print_r($_GET);
  print_r($_POST);
  session_destroy();
  exit();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['stud_id']) && isset($_GET['session']) && $_GET['plan_filled'] === "false") {
  try {
  $sql1 = "SELECT DISTINCT k.pensyarah FROM kursus AS k JOIN prestasi AS p ON k.kod = p.kursus WHERE NOT k.kod ='PNG' ";
  $sql2 = "AND p.pelajar = ? ORDER BY k.pensyarah ASC";
  $stmt = $conn->prepare($sql1 . $sql2);
  $stmt->execute([$_GET['stud_id']]);
  $lecturers = $stmt->fetchAll();
  $sql = "SELECT prestasi.mata FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $png = $stmt->fetchColumn();
  $stud_id = $_GET['stud_id'];
  $gp_code = $_GET['gp_code'];
  $session = $_GET['session'];
  echo "<form action=\"/src/plan_intervention.php\" method=\"POST\">\n";
  echo "<div id=\"intervention\" class=\"container-fluid text-center\"><h3>Merancang Intervensi</h3>\n";
  echo "<div class=\"caption\">\n";
  echo "<h4>Sila pilih kategori intervensi dan mencadangkan panduan pengajian berdasarkan butiran prestasi di bawah.</h4><br />\n";
  echo "</div>\n<div id=\"perf\" class=\"row\">\n";
  echo "<div class=\"col-sm-4 form-group\">\n<h4>No. Matrik</h4>\n";
  echo "<input type=\"text\" id=\"student\" name=\"student\" value=\"$stud_id\" readonly=\"readonly\">\n</div>\n";
  echo "<div class=\"col-sm-4 form-group\">\n<h4>Semester/Sesi</h4>";
  echo "<input type=\"text\" id=\"session\" name=\"session\" value=\"$session\" readonly=\"readonly\">\n</div>\n";
  echo "<div class=\"col-sm-4 form-group\">\n<h4>PNG</h4>\n";
  echo "<input type=\"number\" id=\"png\" name=\"png\" value=\"$png\" readonly=\"readonly\">\n</div>\n</div>\n";
  echo "<div id=\"guidance\" class=\"row\">\n<div id=\"selection\" class=\"col-sm-6\">\n";
  echo "<select class=\"form-control\" name=\"lecturer\" autofocus=\"autofocus\">\n";
  echo "<option value=\"Tiada pilihan\" selected=\"selected\">--Sila pilih pensyarah--</option>\n";
  if (count($lecturers) > 0) {
  foreach($lecturers as $lecturer) {
    $lect_id = $lecturer['pensyarah'];
    $sql = "SELECT nama FROM pengguna WHERE id = '$lect_id'";
    $result = $conn->query($sql);
    $lect_name = $result->fetchColumn();
    echo "<option value=\"$lect_id\">$lect_name</option>\n";}}
  echo "</select><br />\n";
  echo "<select class=\"form-control\" name=\"category\" multiple=\"multiple\">\n";
  echo "<optgroup label=\"Kategori\">\n";
  echo "<option value=\"1\">Kaedah pembelajaran</option>\n";
  echo "<option value=\"2\">Aliran pengajian</option>\n";
  echo "<option value=\"3\">Kaunseling akademik</option>\n";
  echo "</optgroup>\n</select><br />\n</div>\n<div id=\"suggestion\" class=\"col-sm-6\">\n";
  echo "<label class=\"text-center\" for=\"guide\">Cadangan</label><br />\n";
  echo "<textarea id=\"guide\" class=\"form-control align-center\" name=\"guide_suggestion\" rows=\"5\" cols=\"50\" \n";
  echo "placeholder=\"Panduan pengajian\" autocomplete=\"on\"></textarea>\n";
  echo "<br />\n<input type=\"hidden\" name=\"gp_code\" value=\"$gp_code\" readonly=\"readonly\"/>\n</div>\n</div>\n";
  echo "<br />\n<input type=\"hidden\" name=\"plan_filled\" value=\"true\" readonly=\"readonly\"/>\n</div>\n</div>\n";
  echo "<div class=\"col-sm-12 form-group\"><input type=\"submit\" value=\"Merancang\"/></div>\n</div>\n</form>";
  } catch (Exception $e) {
  echo "Error: " . $e->getMessage();}
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student']) && $_POST['plan_filled'] === "true") {
  try {
  $_SESSION['id'] = 'P000001'; $_SESSION['role'] = 1;
  $sql = "SELECT MAX(no) AS max_no FROM pelan";
  $result = $conn->query($sql);
  $row = $result->fetch();
  $next_r = $row['max_no'] + 1;
  $sql = "SELECT kod FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_POST['student'], $_POST['session']]);
  $perf = $stmt->fetchColumn();
  $suggestion = $_POST['category'] . "; " . $_POST['guide_suggestion'];
  $sql = "INSERT INTO pelan (no, pelajar, pensyarah, prestasi, panduan) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$next_r, $_POST['student'], $_POST['lecturer'], $perf, $suggestion]);
  $gp_code = $_POST['gp_code'];
  $sql = "SELECT prestasi.status FROM prestasi WHERE prestasi.kod = '$gp_code'";
  $result = $conn->query($sql);
  $gp_status = $result->fetchColumn();
  $gp_status = substr_replace($gp_status, 'R', 0, 1);
  $sql = "UPDATE prestasi SET prestasi.status = ? WHERE prestasi.kod = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$gp_status, $gp_code]);
  exit("<script>alert('Rancangan intervensi bagi $perf telah berjaya dihantar.'); document.location = 'dashboard_phead.php';</script>");
  } catch (Exception $e) {
  echo "Error: " . $e->getMessage();
  }
}
?>