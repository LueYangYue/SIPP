<?php 
session_start();
require_once 'database.php';

header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Proxy caching, the browser is forced to request a fresh copy every time to prevent the page from being cached.
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Sets the expiration date to a time far in the past, the browser treats the page as already expired to prevent the page from being cached.

function getCount($query) {
  $sql = $query;
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_SESSION['id']]);
  $total = $stmt->fetchColumn();
  return $total;
}

$_SESSION['id'] = 'P000002';
$totalPending = getCount("SELECT COUNT(*) FROM prestasi INNER JOIN kursus ON prestasi.kursus=kursus.kod WHERE prestasi.status='B' AND kursus.pensyarah  = ? AND NOT kursus.kod = 'PNG' ");
$totalChecked = getCount("SELECT COUNT(*) FROM prestasi INNER JOIN kursus ON prestasi.kursus=kursus.kod WHERE prestasi.status='D' AND kursus.pensyarah = ?");
$totalMarked = getCount("SELECT COUNT(*) FROM prestasi INNER JOIN kursus ON prestasi.kursus=kursus.kod WHERE (prestasi.status='R' OR prestasi.status='P') AND kursus.pensyarah = ?");
$totalPlanned = getCount("SELECT COUNT(*) FROM prestasi INNER JOIN kursus ON prestasi.kursus=kursus.kod WHERE prestasi.status='P' AND kursus.pensyarah = ?");
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analysis</title>
  <link rel="icon" type="image/x-icon" href="https://ukmsipp.me/SIPP/images/university.png">
  <link rel="stylesheet" href="https://ukmsipp.me/SIPP/assets/css/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ukmsipp.me/SIPP/assets/js/visualize_perf.js"></script>
  <script src="https://ukmsipp.me/SIPP/assets/js/intervene_perf.js"></script>
  <style>
    body {
      letter-spacing: 0.05rem;
      font-family: serif;
    }
    button {
      color: #fff;
    }
    canvas {
      align-self: center;
    }
    form {
      overflow: auto;
      place-self: center;
      box-sizing: border-box;
      box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2), 3px 6px 18px rgba(0, 0, 0, 0.18);
      min-width: 600px;
      min-height: 400px;
      max-width: 80vw;
      max-height: 80vh;
      padding: 2rem;
    }
    h1 {
      font-size: xx-large;
      font-weight: bold;
      text-align: center;
    } h3 {font-weight: bold;}
    h4 {
      font: 1rem monospace;
      margin: 0;
      line-height: 1.5rem;
      background-color: inherit;
      color: gray;
      width: auto;
      display: inline;
    }
    input[type=submit] {
      font-family: serif;
      width: 40%;
      margin: auto;
      color: white;
      background-color: black;
      transition: background-color 0.2s ease;
    }
    input[readonly] {
      font: 1rem monospace;
      margin: 0;
      width: 60%;
      line-height: 1.5rem;
      background-color: inherit;
      text-align: center;
      display: inline;
    }
    select, label {
      overflow: auto;
      min-width: 90%;
      font-weight: bold;
      font-family: monospace; 
      line-height: 1.5;
      letter-spacing: 0.05rem;
    }
    option {
      font-family: sans-serif;
      letter-spacing: 0.05rem;
    }
    textarea {
      place-self: center;
      max-width: 90%;
    }

    .container {
      overflow: auto;
      text-align: center;
    }
    .intervention-container {
      justify-content: center;
      align-items: center;
      margin: 1.5rem;
    }

    #selection {
      min-width: 50%;
      max-width: 50%;
    }
    #suggestion {
      min-width: 50%;
      max-width: 50%;
    } 
  </style>
</head>
<body>
  <nav class="navbar">
    <a class="navbar-logo" href="landing.html">
      <img src="https://ukmsipp.me/SIPP/images/university.png" alt="University Logo" style="width: 32px;height: 32px;">
    </a><h1>Analitik</h1>
  <nav class="navbar-menu">
    <button onclick="document.location='logout.php'" style="width: 95px; height: 32px; font-size: small">Log Keluar</button>
  </nav>
  </nav><br />
  <div class="cards">
    <div class="card">
      <h3>Prestasi Belum Dinilai</h3>
      <p><?php echo $totalPending; ?></p>
    </div>
    <div class="card">
      <h3>Prestasi Telah Dinilai</h3>
      <p><?php echo $totalChecked; ?></p>
    </div>
    <div class="card">
      <h3>Prestasi Telah Ditanda</h3>
      <p><?php echo $totalMarked; ?></p>
    </div>
    <div class="card">
      <h3>Prestasi Telah Dirancang</h3>
      <p><?php echo $totalPlanned; ?></p>
    </div>
  </div>
  <div class="container"><b>Status prestasi pelajar: <?php echo $student['status'];?></b> 
    <div class="chart-container"><canvas id="pngChart"></canvas></div>
    <div class="intervention-container"></div>
    <script>
      const session = "<?php echo $_SESSION['acad_session'];?>";
      const semester = <?php echo $student['semester'];?>;
      const name = "<?php echo $student['nama'];?>";
      const points = <?php echo json_encode($points);?>;
      const sessions = <?php echo json_encode($sessions);?>;
      visualizePNG(session, semester, name, points, sessions);
      const role = <?php echo $_SESSION['role'];?>;
      const id = "<?php echo $student['id'];?>";
      const gp = "<?php echo $gp;?>";
      if (role == 1) {planIntervention(id, gp);} else if (role == 2) {markRisk(id, gp);}
    </script><small><strong>Panduan Penandaan Risiko Kegagalan Berdasarkan Kumpulan (Nilai gred KURANG DARIPADA) <br />
    </strong>[K1 < Gred C (2.00) | K2 < Gred D+ (1.33) | K3 < Gred D (1.00)]</small>
  </div>
</body>
</html>