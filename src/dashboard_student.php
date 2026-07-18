<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 3) {
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
  <link rel="icon" type="image/x-icon" href="/SIPP/images/university.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
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

    /* --- NOTIFICATION DROPDOWN --- */
    .navbar-menu {
      justify-content: right;
      min-width: 35%;
    }
    .notification-dropdown {
      position: relative;
      min-width: 500px;
      width: 50%;
    }
    .notifications {
      place-self: end;
      display: block;
      color: #000;
      background-color: var(--light-gray);
      padding: 0.5rem 1rem;
      font-size: 1rem;
      border: none;
      cursor: pointer;
    }
    .notifications-list {
      display: none; /*Hide the dropdown content by default*/
      position: absolute;
      overflow: auto;
      min-width: 100%;
      max-height: 100px;
      border-radius: 10px;
      background-color: var(--light-gray);
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
    .notification {
      width: 100%;
      padding: 0.5rem 1rem;
      border-radius: 10px;
      text-align: left;
      text-decoration: none; 
      background-color: var(--light-gray);
      color: black;
      display: block;
      font-weight: bold;
    }
    .notification:hover, .notification:focus {
      background-color: white;
      font-weight: normal;
    }
    .notifications:hover {
      color: white;
    }
    .notifications:hover + .notifications-list, .notifications:focus + .notifications-list, .notifications-list:hover/*, 
    .notifications-list:focus, .notification:hover, .notification:focus*/ {
      display: block; /*Show the dropdown content on hover*/
    }

    @media (min-width: 945px) {
      #guides-section {
        margin-left: 15%;
      }
    }
  </style>
</head>
<body>
  <a class="home-logo" href="landing.html">
    <img src="/SIPP/images/university.png" alt="University Logo" style="width: 32px;height: 32px;">
  </a>
  <aside class="sidebar">
    <div class="aside-links">
      <a href="#table-section"><i class="fas fa-th-list"></i> Prestasi</a>
      <a href="#analytics-section"><i class="fas fa-chart-line"></i> Analitik</a>
      <a href="#guides-section"><i class="fas fa-envelope-square"></i> Intervensi</a>
    </div>
  </aside>
  <div class="navbar">
    <h1>Pelajar</h1>
    <nav class="navbar-menu">
      <div class="notification-dropdown">
        <button class="notifications" onmouseover="notifyRisk('<?php echo $_SESSION['id'];?>');">
          <i class="fas fa-bell"></i></button>
        <div class="notifications-list"></div>
      </div>
      <button onclick="document.location='logout.php'">Log Keluar</button>
    </nav>
  </div>
  <section id="table-section">
    <div class="container">
      <h2>Prestasi</h2>
      <i>Selamat datang, <?php echo $_SESSION['name']; ?>!</i>
    </div>
    <?php 
    try {
      $sql = "SELECT pelajar.* FROM pelajar WHERE id = '" . $_SESSION['id'] . "'";
      $result = $conn->query($sql);
      $result = $result->fetch();
      $_SESSION['year'] = $result['tahun'];
      $_SESSION['semester'] = $result['semester'];
      $_SESSION['perf_status'] = $result['status'];

      //list all student performances except PNG
      $sql = $conn->prepare("SELECT * FROM prestasi WHERE pelajar = :id AND NOT kursus = 'PNG' ORDER BY prestasi.kod ASC");
      $sql->bindParam(':id', $_SESSION['id']);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        echo "<table>\n<caption>Prestasi berdasarkan kursus</caption>\n";
        echo "<tr><th>Kursus</th><th>Nilai Gred</th><th>Sesi</th><th>Status Prestasi</th></tr>";
        while($row = $sql->fetch()) {
          echo "<tr>\n";
          echo "<td>" . $row['kursus'] . "</td>\n";
          echo "<td>" . $row['mata'] . "</td>\n";
          echo "<td>" . $row['sesi'] . "</td>\n";
          echo "<td>" . $row['status'] . "</td>\n";
          echo "</tr>";
        }
        echo "</table>\n";
      } else {
        echo "Tiada rekod.";
      }

      $sql = $conn->prepare("SELECT * FROM prestasi WHERE pelajar = :id AND kursus = 'PNG' ORDER BY prestasi.kod ASC");
      $sql->bindParam(':id', $_SESSION['id']);
      $sql->execute();  
      $points = [];
      $sessions = [];

      if ($sql->rowCount() > 0) {
        while ($perf = $sql->fetch()) {
          $sessions[] = $perf['sesi'];
          $points[] = $perf['mata'];
        }
      }
    }
    catch(PDOException $e) {
    die("Query failed: " . $e->getMessage());
    }
    ?>
  </section>
  <section id="analytics-section">
    <div class="container">
      <div class="chart-container">
        <canvas id="pngChart"></canvas>
        <script>
          const session = "<?php echo $_SESSION['acad_session'];?>";
          const semester = <?php echo $_SESSION['semester'];?>;
          const name = "<?php echo $_SESSION['name'];?>";
          const points = <?php echo json_encode($points);?>;
          const sessions = <?php echo json_encode($sessions);?>;
          visualizePNG(session, semester, name, points, sessions);
        </script>
      </div>
    </div>
  </section>
  <section id="guides-section">
    <div><h2>Panduan</h2>
      <?php 
      try {
        $sql1 = "SELECT p.no, p.pensyarah, p.panduan, r.kod, r.sesi, r.mata FROM pelan AS p JOIN prestasi AS r ON r.kod = p.prestasi ";
        $sql2 = "WHERE p.pelajar = :id ORDER BY p.no ASC";
        $stmt = $conn->prepare($sql1 . $sql2);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          echo "<table>\n<caption>Panduan prestasi berisiko</caption>\n";
          echo "<thead>\n<tr>\n";
          echo "<th>Prestasi</th>\n<th>Mata</th>\n<th>Sesi</th>\n<th>Pensyarah</th>\n<th>Panduan</th>\n";
          echo "</tr>\n</thead>\n";
          echo "<tbody>\n";
          while($row = $stmt->fetch()) {
            echo "<tr>\n";
            echo "<td>" . $row['kod'] . "</td>\n";
            echo "<td>" . $row['mata'] . "</td>\n";
            echo "<td>" . $row['sesi'] . "</td>\n";
            echo "<td>" . $row['pensyarah'] . "</td>\n";
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
      $conn = null;
      ?>
    </div>
  </section>
</body>
</html>