<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
    }
}

function check_role($allowed_role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $allowed_role) {
        die('Akses ditolak.');
    }
}
?>
