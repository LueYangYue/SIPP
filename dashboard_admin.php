<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 1) {
    session_destroy();
    header("Location: login.html");
    exit();
}

function categorize ($suggestion){
  $suggestion = explode("; ", $suggestion);
  $category = $suggestion[0];
  switch ($category) {
    case 1:
      $category = "Kaedah pembelajaran";
      break;
    case 2:
      $category = "Aliran pengajian";
      break;
    case 3:
      $category = "Kaunseling akademik";
      break;
  }
  return "<b>$category</b><br /><br />" . $suggestion[1];
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papan Pemuka</title>
  <link rel="icon" type="image/x-icon" href="images/university.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="visualize_perf.js"></script>
  <script src="intervene_perf.js"></script>
  <style>
    :root {
      --blue-one: #0044ba;
      --blue-two: rgba(0, 68, 186, 0.1);
    }
    
    body {
      font-family: serif, monospace;
      line-height: 0.5;
    }
    table {
      width: 100%;
    }
    th {
      padding: 1rem;
      background-color: var(--blue-one);
      color: white;
    }
    td {
      padding: 1rem;
      background-color: var(--blue-two);
    }

    @media (min-width: 945px) {
      #alerts-section, #plans-section {
        margin-left: 15%;
      }
    }
  </style>
</head>
<body>
  <a class="home-logo" href="landing.html">
    <img src="images/university.png" alt="University Logo" style="width: 32px;height: 32px;">
  </a>
  <aside class="sidebar">
    <div class="aside-links">
      <a href="#courses-section"><i class="fas fa-book"></i> Kursus</a>
      <a href="#students-section"><i class="fas fa-book-reader"></i> Prestasi</a>
      <a href="#alerts-section"><i class="fas fa-broadcast-tower"></i> Peringatan</a>
      <a href="#plans-section"><i class="fas fa-chalkboard"></i> Pelan</a>
    </div>
  </aside>
  <div class="navbar">
    <h1>Ketua Program</h1>
    <nav class="navbar-menu">
      <button onclick="document.location='logout.php'">Log Keluar</button>
    </nav>
  </div>
  <section><p>Selamat datang, <?php echo $_SESSION['name']; ?>!</p></section>
  <section id="courses-section"><h2>Kursus</h2>
    <div>
    <?php 
    try {
      $sql = "SELECT kod, nama FROM kursus WHERE NOT kod = 'PNG' AND pensyarah = :id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id', $_SESSION['id']);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        echo "<table>\n<caption>Penilaian terlibat kini</caption>\n";
        echo "<thead>\n<tr>\n";
        echo "<th>Kod</th>\n<th>Nama</th>\n";
        echo "</tr>\n</thead>\n";
        echo "<tbody>\n";
        while($row = $stmt->fetch()) {
          echo "<tr>\n";
          echo "<td>" . $row['kod'] . "</td>\n";
          echo "<td>" . $row['nama'] . "</td>\n";
          echo "</tr>\n";
        }
        echo "</tbody>\n</table>";
      } else {
        echo "Tiada peringatan risiko.";
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();  
    }
    ?>
    </div>
  </section>
  <section id="students-section">
    <div id="students-selection"><h2>Prestasi</h2>
    <div class="dropdown">
      <select class="dropdown-filter" name="year" onchange="filterYear(this.value);">
      <option value="0" selected="selected">Semua</option>
      <optgroup label="Tahun">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </optgroup>
      </select>
    </div></div>
    <i>Sila pilih prestasi semester <?php echo $_SESSION['acad_session'];?> di Bahagian Prestasi untuk analisis.</i>
    <div id="table-container">
      <script>filterYear(document.getElementsByClassName('dropdown-filter')[0].value);</script>
    </div>
  </section>
  <section id="alerts-section"><h2>Peringatan</h2>
    <div>
    <?php
    try {
      $sql1 = "SELECT e.no AS n, r.kod AS k, r.pelajar AS p, e.masa AS m FROM peringatan AS e, ";
      $sql2 = "prestasi AS r WHERE e.prestasi = r.kod AND r.kursus = 'PNG' AND r.sesi = :sesi ORDER BY e.no ASC";
      $stmt1 = $conn->prepare($sql1 . $sql2);
      $stmt1->bindParam(':sesi', $_SESSION['acad_session']);
      $stmt1->execute();
      if ($stmt1->rowCount() > 0) {
        echo "<table>\n<caption>Amaran risiko awal</caption>\n";
        echo "<thead>\n<tr>\n";
        echo "<th>No.</th>\n<th>Prestasi</th>\n<th>No. Matrik</th>\n<th>Nama Pelajar</th>\n<th>Masa</th>\n";
        echo "</tr>\n</thead>\n";
        echo "<tbody>\n";
        while($row = $stmt1->fetch()) {
          $sql3 = "SELECT nama FROM pengguna WHERE id = '" . $row['p'] . "'";
          $result = $conn->query($sql3);
          if ($result->rowCount() > 0) {
            $student = $result->fetch();
            echo "<tr>\n";
            echo "<td>" . $row['n'] . "</td>\n";
            echo "<td>" . $row['k'] . "</td>\n";
            echo "<td>" . $row['p'] . "</td>\n";
            echo "<td>" . $student['nama'] . "</td>\n";
            echo "<td>" . $row['m'] . "</td>\n";
            echo "</tr>\n";
          }
        }
        echo "</tbody>\n</table>\n";
      } else {
        echo "Tiada peringatan risiko.";
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();  
    }
    ?>
    </div>
  </section>
  <section id="plans-section"><h2>Pelan</h2>
    <div>
    <?php
    try {
      $sql = "SELECT * FROM pelan JOIN prestasi ON prestasi.kod = pelan.prestasi ORDER BY pelan.no ASC";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        echo "<table>\n<caption>Perancangan intervensi prestasi</caption>\n";
        echo "<thead>\n<tr>\n";
        echo "<th>No.</th>\n<th>Prestasi</th>\n<th>Pensyarah</th>\n<th>Pelajar</th>\n<th>Panduan</th>\n";
        echo "</tr>\n</thead>\n";
        echo "<tbody>\n";
        while($row = $stmt->fetch()) {
            echo "<tr>\n";
            echo "<td>" . $row['no'] . "</td>\n";
            echo "<td>" . $row['prestasi'] . "</td>\n";
            echo "<td>" . $row['pensyarah'] . "</td>\n";
            echo "<td>" . $row['pelajar'] . "</td>\n";
            echo "<td>" . categorize($row['panduan']) . "</td>\n";
            echo "</tr>\n";
        }
        echo "</tbody>\n</table>";
      } else {
        echo "Tiada rancangan intervensi.";
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();  
    }
    ?>
    </div>
  </section>
</body>
</html>