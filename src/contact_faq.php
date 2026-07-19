<!DOCTYPE html>
<html lang="en">
<head>
  <title>FAQ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="https://ukmsipp.me/SIPP/images/university.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .bg-1 {
      background-color: #f4511e; /* Orange */
      color: #ffffff;
    }
    .bg-2 {
      background-color: #333399; /* Dark Blue */
      color: #ffffff;
    }
    .bg-3 {
        background-color: #ffffff; /* White */
        color: #555555;
    }
    .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
    padding-left: 50px;
    padding-right: 50px;
    }
    .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 14px;
    letter-spacing: 3px;
    }
    .bg-4 {
        background-color: #2f2f2f;
        color: #ffffff;
    }
    footer .glyphicon {
        font-size: 20px;
        margin-bottom: 20px;
        color: #f4511e;
    }
    img {
      opacity: 0.87;
    }
    body {
      font: 14px "Montserrat", sans-serif;
      line-height: 1.8;
    }
  </style>
</head>
<body id="pageFAQ">
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#barNav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="header-logo" href="https://ukmsipp.me/SIPP/src/landing.html">
        <img src="https://ukmsipp.me/SIPP/images/university.png" alt="University Logo" style="width: 32px;height: 32px;">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="barNav">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://ukmsipp.me/SIPP/src/landing.html">Hi</a></li>
        <li><a href="https://www.youtube.com/@UKMYangYue">Tentang Kami</a></li>
        <li><a href="mailto:a202211@siswa.ukm.edu.my">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid bg-1 text-center" id="hello">
  <h3>Hi</h3>
  <img src="https://ukmsipp.me/SIPP/images/3d_school.png" class="img-circle" width="300" height="300"alt="logo">
  <h3>Kami A202211</h3>
</div>

<div class="container-fluid bg-2 text-center" id="who">
  <h3>Siapakah kami?</h3>
  <div class="row">
    <div class="col-sm-4">
      <p>Adakah anda sudah mendaftar akaun siswa sebelum log masuk ke dalam SIPP? Jika tidak, hubungilah pentadbir sekarang!</p>
      <img src="/SIPP/images/feature1.png" class="img-responsive" alt="Image" style="display:inline">
    </div>
    <div class="col-sm-4">
      <p>Ada pertanyaan tentang analitik prestasi pelajar? Tanyalah dengan borang di bawah!</p>
      <img src="/SIPP/images/feature2.png" class="img-responsive" alt="Image" style="display:inline">
    </div>
    <div class="col-sm-4">
      <p>Hadapi masalah ketika menggunakan fungsi lain SIPP? Mintalah bantuan di sini!</p>
      <img src="/SIPP/images/feature3.png" class="img-responsive" alt="Image" style="display:inline">
    </div>
</div>
<div class="container-fluid bg-3 text-center" id="where">
  <h3>Di manakah pusat pentadbiran bagi SIPP?</h3>
  <p>Fakulti Teknologi & Sains Maklumat Universiti Kebangsaan Malaysia</p>
  <a href="#" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Search
  </a>
</div>

<div class="container-fluid" style="background-color: #000000" id="contact">
  <h3 class="text-center">Hubungilah Kami</h3>
  <div class="row">
    <div class="col-sm-5">
      <p>Hubungilah pentadbir dan respon akan diberikan dalam <b>24 jam.</b></p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Bangi, Selangor</p>
      <p><span class="glyphicon glyphicon-phone"></span> +6012 3456789</p>
      <p><span class="glyphicon glyphicon-envelope"></span> a202211@siswa.ukm.edu.my</p>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Nama" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Emel" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comment-question" name="question" placeholder="Soalan" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Hantar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="container-fluid bg4 text-center">
  <a href="#pageFAQ" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>:D Copyright © SIPP 2026</p>
</footer>

</body>
</html>