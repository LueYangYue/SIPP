<?php 
session_start();
$_SESSION['id'] = "P000002";
$_SESSION['role'] = 2;
$_SESSION['stud_year'] = 3;
$_SESSION['acad_session'] = "2/20252026";
$_SESSION['stud_year']= 3;
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Percubaan</title>
  <link rel="icon" type="image/x-icon" href="https://ukmsipp.me/SIPP/images/university.png">
  <link rel="stylesheet" href="https://ukmsipp.me/src/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ukmsipp.me/src/visualize_perf.js"></script>
  <script src="https://ukmsipp.me.src/intervene_perf.js"></script>
  <style>
    :root {
      --orange: #ff8c00;
      --light-gray: #d3d3d3;
    }

    canvas {
      min-width: 600px;
      min-height: 400px;
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
    button {
      color: #fff;
      padding: 0.5rem 1rem;
      font-family: serif;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    form {
      place-self: center;
      box-sizing: border-box;
      box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2), 3px 6px 18px rgba(0, 0, 0, 0.18);
      max-width: 80vw;
      max-height: 80vh;
      padding: 2rem;
    }
    h1 {
      font-size: xx-large;
      font-weight: bold;
      text-align: center;
    } 
    h3 {
      font-weight: bold;
    }
    input {
      width: 90%;
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
      font: 1.5rem monospace;
      margin: 0;
      width: 90%;
      line-height: 1.5rem;
      background-color: inherit;
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
    canvas {
      align-self: center;
    }
    #selection {
      min-width: 50%;
      max-width: 50%;
    }
    #suggestion {
      min-width: 50%;
      max-width: 50%;
    } 

    /* --- NOTIFICATION DROPDOWN --- */
    .navbar-menu {
      justify-content: right;
      /*min-width: 35%;*/
    }
    .notification-dropdown {
      position: relative;
      width: 50%;
    }
    .notifications {
      background-color: #000;
      color: #fff;
      padding: 0.5rem 1rem;
      font-size: 1rem;
      border: none;
      cursor: pointer;
    }
    .notification-list {
      display: none; /*Hide the dropdown content by default*/
      position: absolute;
      opacity: 0.9;
      min-width: 100%;
      border-radius: 10px;
      background-color: var(--light-gray);
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
    .notification-list button {
      width: 100%;
      padding: 0.5rem 1rem;
      border-radius: 10px;
      text-decoration: none;
      background-color: var(--light-gray);
      color: black;
      display: block;
    }
    .notification-list button:hover {
      background-color: #fff;
    }
    .notification-dropdown:hover .notification-list {
      display: block; /*Show the dropdown content on hover*/
    }
    .notification-dropdown:hover .notifications {
      background-color: var(--blue-hover);
    }
  </style>
</head>
<body>
<div class="navbar text-center">
  <a class="logo" href="landing.html">
    <img src="https://ukmsipp.me/SIPP/images/university.png" alt="University Logo" style="width: 32px; height: 32px;">
  </a>
  <h1>Pendaftaran Percubaan</h1>
  <nav class="navbar-menu">
    <button onclick="document.location='/src/logout.php'" style="width: 95px; height: 32px; font-size: small">Log Keluar</button>
  </nav>
</div>
<div id="chart-container" class="container-fluid">
  <div class="row"><canvas id="pngChart"></canvas></div>
  <script>visualizePNG();</script>
</div>
<form>
<div class="container-fluid">
  <div class="container-fluid text-center">
    <div class="row">
      <div class="col-md-5 col-md-offset-1"><h3>Pendaftaran</h3></div>
    </div>
  </div>
  <!-- <div id="user-info" class="row"> -->
  <div class="row">
    <div class="col-sm-6 form-group">
      <label for="username">ID</label>
      <input type="text" id="username" name="student" value="T000001" required="required" readonly="readonly" autofocus>
    </div>
    <div class="col-sm-6 form-group">
      <label for="name">Nama</label>
      <input type="text" id="name" name="stud_name" placeholder="Nama" required="required">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 form-group">
      <label for="pw">Kata Laluan</label>
      <input type="password" id="pw" name="pw" placeholder="Kata Laluan" required="required">
    </div>
    <div class="col-sm-6 form-group">
      <label for="vpw">Kata Laluan Sah</label>
      <input type="password" id="vpw" name="vpw" placeholder="Kata Laluan Sah" required="required">
    </div>
  </div>
  <div id="role" class="row">
    <div id="selection" class="col-sm-6">
      <select class="form-control" name="lecturer" autofocus="autofocus">
        <option value="Tiada pilihan" selected="selected">--Sila pilih kategori pelan--</option>
        <option value="1">Kaedah pembelajaran</option>
        <option value="2">Aliran pengajian</option>
        <option value="3">Kaunseling akademik</option>
      </select><br />
      <select class="form-control" name="category" multiple="multiple">
        <optgroup label="Kursus">
          <option value="TTTT3013">Komputer, Etika dan Sosial</option>
          <option value="TTTS0001">Sistem Pengurusan Maklumat</option>
          <option value="LMCK0001">Kaunseling</option>
          <option value="TTTA0001">Antara Muka Pengguna</option>
          <option value="LMCB0001">Bola Sepak</option>
        </optgroup>
      </select><br />
    </div>
    <div id="comment" class="col-sm-6">
      <label class="text-center" for="intro">Cadangan</label><br />
      <textarea id="intro" class="form-control align-center" name="intro_comment" rows="5" cols="50" 
      placeholder="Pengenalan" autocomplete="on"></textarea>
      <br /><input type="hidden" name="intro_filled" value="true" readonly="readonly"/>
    </div>
  </div>
  <div class="col-sm-12 form-group"><input type="submit" value="Daftar"/></div>
</div>
</form>
</body>
</html>
<!-- <script>
  const bcrypt = require('bcrypt');
  async function registerUser(password) {
    const saltRounds = 10;
    const hashedPassword = await bcrypt.hash(password, saltRounds);
    return hashedPassword;
  }
</script> -->
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
try {
  /*//Provide user data
  $sql = "SELECT MAX(id) AS max_no FROM pengguna WHERE id LIKE 'T%'";
  $result = $conn->query($sql);
  $row = $result->fetch();
  $next_r = $row['max_no'] + 1;
  $sql = "SELECT id FROM pengguna WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_POST['username']]);
  $status = $stmt->fetchColumn();
  if ($status === "Berisiko") {exit($status);}
  $sql = "UPDATE prestasi SET prestasi.status = \"Berisiko\" WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $sql = "UPDATE pelajar SET pelajar.status = \"Berisiko\" WHERE pelajar.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id']]);

  $sql = "SELECT kod FROM prestasi WHERE kursus = 'PNG' AND pelajar = ? AND sesi = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_GET['stud_id'], trim($_GET['session'])]);
  $perf = $stmt->fetchColumn();
  $sql = "INSERT INTO pengguna (id, kataLaluan) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$next_r, $perf]);*/
} catch (Exception $e) {
  exit($e->getMessage());
}
}