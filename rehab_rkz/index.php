<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\index.php
session_start();
require_once 'config/database.php';
require_once 'includes/auth.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Handle Logout
if ($page === 'logout') {
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

// Handle Login POST
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['username'];
    $password = $_POST['password']; 
    
    $stmt = $pdo->prepare("SELECT * FROM hrd.datadasar WHERE NIP = ? AND password = ?");
    $stmt->execute(array($nip, $password));
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['user_id'] = $user['NIP'];
        
        $isDokter = (strtoupper($user['jeniskyw']) === 'DOKTER' || strpos(strtolower($user['Nama']), 'dr.') !== false);
        $_SESSION['role'] = $isDokter ? 'dokter' : 'admin';
        $_SESSION['nama_lengkap'] = $user['Nama'];
        
        header("Location: index.php?page=dashboard");
        exit;
    } else {
        $error = "NIP atau password salah!";
    }
}

// Routing Logic
if (!isset($_SESSION['user_id'])) {
    $page = 'login'; // Force login
}

// Load Header
require 'includes/header.php';

// Load Main Content (Modul)
switch ($page) {
    case 'login':
        require 'views/login.php';
        break;
    case 'dashboard':
        if ($_SESSION['role'] === 'admin') {
            require 'views/dashboard_admin.php';
        } else if ($_SESSION['role'] === 'dokter') {
            require 'views/dashboard_dokter.php';
        } else {
            echo "<h2>Dashboard Pasien</h2><p>Selamat datang, " . $_SESSION['nama_lengkap'] . "</p>";
        }
        break;
    case 'anamnesis':
        check_role('dokter');
        require 'views/anamnesis.php';
        break;
    case 'pasien':
        check_role('admin');
        require 'views/pasien.php';
        break;
    case 'kunjungan':
        check_role('admin');
        require 'views/kunjungan.php';
        break;
    case 'laporan':
        require 'views/laporan.php';
        break;
    default:
        echo "<h2>Halaman tidak ditemukan</h2>";
        break;
}

// Load Footer
require 'includes/footer.php';
?>
