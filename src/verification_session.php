<?php
session_start();// Start session
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_SESSION['no'])) {$_SESSION['no'] = 0;}
  $id = $_POST['id'];
  $password = $_POST['pwd'];
  // Validate credentials against the database
  $stmt = $conn->prepare("SELECT * FROM sipp.pengguna WHERE id = :id AND kataLaluan = :password");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':password', $password);
  $stmt->execute();
  $result = $stmt->fetch();
  if ($result) {
    // Credentials are valid, set session variables
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $result['nama'];
    $_SESSION['acad_session'] = "2/20252026";
    // Check user role and redirect accordingly...
    $_SESSION['role'] = $result['peranan'];
    switch ($_SESSION['role']) {
      case 1:
        header("Location: dashboard_admin.php");
        break;
      case 2:
        header("Location: dashboard_lecturer.php");
        break;
      case 3:
        $_SESSION['last_session'] = $result['sesi'];
        header("Location: dashboard_student.php");
        break;
      default:
        echo "<script>alert('Peranan tidak dikenali. Sila hubungi pentadbir.');
        window.location.href='/src/login.html';</script>";
    } exit();
  } else {
    // Invalid credentials, redirect back to login page with error message
    $_SESSION['no'] = $_SESSION['no'] + 1;
    if ($_SESSION['no'] >= 3) {// Resets after browser restarts.
      echo "<script>alert('Nama pengguna atau kata laluan telah salah sekurang-kurangnya 3 kali. " . 
      "Hubungilah pentadbir untuk tukar kata laluan.'); window.location.href='/src/login.html';</script>";
    } else {
      echo "<script>alert('Nama pengguna atau kata laluan adalah salah. Sila cuba lagi.');  
      window.location.href='/src/login.html';</script>";
    } exit();
  }
}
?>