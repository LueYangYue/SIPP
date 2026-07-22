<?php 
session_start();
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['id']) && isset($_GET['year'])) {
  $_SESSION['stud_year'] = $_GET['year'];
  if ($_SESSION['stud_year'] == '0') {
    try {
    $sql1 = "SELECT * FROM prestasi JOIN kursus ON prestasi.kursus = kursus.kod WHERE NOT prestasi.kursus = 'PNG' ";
    $sql2 = "AND kursus.pensyarah = :id AND sesi = :acad_session ORDER BY prestasi.pelajar ASC";
    $stmt1 = $conn->prepare($sql1 . $sql2);
    $stmt1->bindParam(':id', $_SESSION['id']);
    $stmt1->bindParam(':acad_session', $_SESSION['acad_session']);
    $stmt1->execute();
    if ($stmt1->rowCount() > 0) {
    echo "<table>\n<caption>Nilai gred kursus</caption>\n";
    echo "<thead>\n<tr>\n";
    echo "<th>No. Matrik</th>\n<th>Nama</th>\n<th>Status</th>\n<th>Kursus</th>\n<th>Prestasi</th>\n";
    echo "</tr>\n</thead>\n";
    echo "<tbody>\n";
    while($row = $stmt1->fetch()) {
    $s = $row['pelajar'];
    $sql3 = "SELECT pengguna.id, nama, sesi, pelajar.status FROM pengguna JOIN pelajar ON pengguna.id = pelajar.id WHERE pengguna.id = '$s'";
    $result = $conn->query($sql3);
    $code_perf = $row['kod'];
    $acad_perf = $row['mata'];
    $gp_status = substr($row['status'], 0, 1);
    if ($gp_status === 'T') {$acad_perf = "Analitik PNG";}
    if ($row_student = $result->fetch()) {
    echo "<tr>\n";
    echo "<td>" . $row_student['id'] . "</td>\n";
    echo "<td>" . $row_student['nama'] . "</td>\n";
    echo "<td>" . $row_student['status'] . "</td>\n";
    echo "<td>" . $row['kursus'] . "</td>\n";
    echo "<td><b class=\"$gp_status\">$gp_status</b>";
    echo("<button name=\"perf\" class=\"perf-button\" onclick=\"analyzePerf(this, $code_perf)\">$acad_perf</button>");
    echo "</td>\n";
    echo "</tr>\n";}}
    echo "</tbody>\n</table>\n";
    echo "<small><strong>Petunjuk Risiko Kegagalan Berdasarkan Kumpulan (Nilai gred KURANG DARIPADA)</strong><br />";
    echo "[K1 < Gred C (2.00) | K2 < Gred D+ (1.33) | K3 < Gred D (1.00)]<br />";
    echo "Kod Status: <b class=\"R\">R</b>-Rancangan Dihantar, <b class=\"P\">P</b>-Peringatan Diberi, ";
    echo "<b class=\"D\">D</b>-Dinilai Risiko, <b class=\"B\">B</b>-Belum Dinilai, <b class=\"T\">T</b>-Tidak Lengkap</small>";
    } else {
    echo "Tiada rekod.";}}
    catch(PDOException $e) {
    die("Query failed: " . $e->getMessage());}
  } else {
  try {
  $sql1 = "SELECT p.id AS pi, p.nama AS pn, l.status AS ls, k.kod AS kk, k.nama AS kn, r.kod AS rk, r.mata AS rm ";
  $sql2 = "FROM pengguna AS p, pelajar AS l, kursus AS k JOIN prestasi AS r ON k.kod = r.kursus ";
  $sql3 = "WHERE k.pensyarah = :id AND r.sesi = :acad_session AND l.tahun = :year AND NOT r.kursus = 'PNG' ";
  $sql4 = "AND p.id = r.pelajar AND l.id = r.pelajar ORDER BY pi ASC";
  $sql5 = $sql1 . $sql2 . $sql3 . $sql4;
  $stmt1 = $conn->prepare($sql5);
  $stmt1->bindParam(':id', $_SESSION['id']);
  $stmt1->bindParam(':year', $_SESSION['stud_year']);
  $stmt1->bindParam(':acad_session', $_SESSION['acad_session']);
  $stmt1->execute();

  if ($stmt1->rowCount() > 0) {
    echo "<table>\n<caption>Nilai gred kursus</caption>\n";
    echo "<thead>\n<tr>\n";
    echo "<th>No. Matrik</th>\n<th>Nama</th>\n<th>Status</th>\n<th>Kursus</th>\n<th>Prestasi</th>\n";
    echo "</tr>\n</thead>\n";
    echo "<tbody>\n";
    while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $code_perf = $row['rk'];
    $acad_perf = $row['rm'];
    $gp_status = substr($row['status'], 0, 1);
    if ($gp_status === 'T') {$acad_perf = "Analitik PNG";}
    echo "<tr>\n";
    echo "<td>" . $row['pi'] . "</td>\n";
    echo "<td>" . $row['pn'] . "</td>\n";
    echo "<td>" . $row['ls'] . "</td>\n";
    echo "<td>" . $row['kk'] . "</td>\n";
    echo "<td><b class=\"$status_perf\">$status_perf</b>";
    echo("<button name=\"perf\" class=\"perf-button\" onclick=\"analyzePerf(this, $code_perf)\">$acad_perf</button>");
    echo "</td>\n";
    echo "</tr>\n";}
    echo "</tbody>\n</table>\n";
    echo "<small><strong>Petunjuk Risiko Kegagalan Berdasarkan Kumpulan (Nilai gred KURANG DARIPADA)</strong><br />";
    echo "[K1 < Gred C (2.00) | K2 < Gred D+ (1.33) | K3 < Gred D (1.00)]<br />";
    echo "Kod Status: <b class=\"R\">R</b>-Rancangan Dihantar, <b class=\"P\">P</b>-Peringatan Diberi, ";
    echo "<b class=\"D\">D</b>-Dinilai Risiko, <b class=\"B\">B</b>-Belum Dinilai, <b class=\"T\">T</b>-Tidak Lengkap</small>";
  } else {
    echo "Tiada rekod.";}}
  catch(PDOException $e) {
  die("Query failed: " . $e->getMessage());}}
  $conn = null;}
?>