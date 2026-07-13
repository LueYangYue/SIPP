<?php 
session_start();
/*$sql = "SELECT kursus.pensyarah FROM kursus JOIN prestasi ON kursus.kod = prestasi.kursus WHERE prestasi.pelajar = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET['stud_id']]);
$lecturers = $stmt->fetch();//print_r($lecturers);
$sql = "SELECT prestasi.mata FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
$png = $stmt->fetchColumn();
$id = $_GET['stud_id'];
$session = $_GET['session'];*/
//test
$id = "A000001"; 
$session = "2/20252026";
$png = "1.32";
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Percubaan</title>
  <link rel="icon" type="image/x-icon" href="images/university.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="visualize_perf.js"></script>
  <script src="intervene_perf.js"></script>
  <style>
    :root {
      --orange: #ff8c00;
      --light-gray: #d3d3d3;
    }

    body {
      font-family: serif;
    }
    button {
      color: #fff;
    }
    canvas {
      min-width: 600px;
      min-height: 400px;
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
      width: default;
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
<div class="navbar text-center">
  <a class="logo" href="landing.html">
    <img src="images/university.png" alt="University Logo" style="width: 32px; height: 32px;">
  </a>
  <h1>Intervensi Percubaan</h1>
  <nav class="navbar-menu">
    <button onclick="document.location='logout.php'" style="width: 95px; height: 32px; font-size: small">Log Keluar</button>
  </nav>
</div>
<div id="chart-container" class="container-fluid">
  <div class="row"><canvas id="pngChart"></canvas></div>
  <script>
    visualizePNG();
    //markRisk("T000001");
  </script>
</div>
<form action="/src/plan_intervention.php" target="_self" method="POST">
  <div id="intervention" class="container-fluid text-center"><h3>Merancang Intervensi</h3>
  <div class="caption">
  <h4>Sila pilih kategori intervensi dan mencadangkan panduan pengajian berdasarkan butiran prestasi di bawah.</h4><br />
</div>
<div id="perf" class="row">
  <div class="col-sm-4 form-group">
    <h4>No. Matrik</h4>
    <input type="text" id="student" name="student" value="<?php echo $id;?>" readonly="readonly">
  </div>
  <div class="col-sm-4 form-group">
    <h4>Sesi</h4>
    <input type="text" id="session" name="session" value="<?php echo $session;?>" readonly="readonly">
  </div>
  <div class="col-sm-4 form-group">
    <h4>PNG</h4>
    <input type="number" id="png" name="png" value="<?php echo $png;?>" readonly="readonly">
  </div>
</div>
<div id="guidance" class="row">
  <div id="selection" class="col-sm-6">
    <select class="form-control" name="lecturer" autofocus="autofocus">
      <option value="Tiada pilihan" selected="selected">--Sila pilih pensyarah--</option>
      <option value="P000006">Pensyarah Satu</option>
      <option value="P000007">Pensyarah Dua</option>
      <option value="P000008">Pensyarah Tiga</option>
      <option value="P000009">Pensyarah Empat</option>
      <option value="P000010">Pensyarah Lima</option>
    </select><br />
    <select class="form-control" name="category" multiple="multiple">
      <optgroup label="Kategori">
        <option value="1">Kaedah pembelajaran</option>
        <option value="2">Aliran pengajian</option>
        <option value="3">Kaunseling akademik</option>
      </optgroup>
    </select><br />
  </div>
  <div id="suggestion" class="col-sm-6">
    <label class="text-center" for="guide">Cadangan</label><br />
    <textarea id="guide" class="form-control align-center" name="guide_suggestion" rows="5" cols="50"
    placeholder="Panduan pengajian" autocomplete="on"></textarea><br />
    <input type="hidden" name="plan_filled" value="true" readonly="readonly"/>
  </div>
</div>
<div class="col-sm-12 form-group"><input type="submit" value="Merancang"/></div>
</div></form>
<?php 
/*try {
$sql = "SELECT MAX(no) AS max_no FROM pelan";
$result = $conn->query($sql);
$row = $result->fetch();
$next_r = $row['max_no'] + 1;
$sql = "SELECT kod FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['student'], $_POST['session']]);
$perf = $stmt->fetchColumn();
$suggestion = $_POST['category'] . "; " . $_POST['guidance'];
$sql = "INSERT INTO pelan (no, pelajar, pensyarah, prestasi, panduan) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$next_r, $_POST['student'], $_SESSION['id'], $perf, $suggestion]);
//header("Location: analysis_perf.php");
} catch (Exception $e) {
echo "Error: " . $e->getMessage();  
}*/
?>
</body>
</html>