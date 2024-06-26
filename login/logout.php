<?php
// Mulai session
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman lain setelah logout
header("Location: ../index.php"); // Ganti index.php dengan halaman login atau halaman lain yang sesuai
exit();
