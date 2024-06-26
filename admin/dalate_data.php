<?php
// Termasukkan file koneksi
include '../koneksi.php';

// Ambil data ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM tb_simpan WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../admin/tabel.php?delete_success=1");
        exit;
    } else {
        header("Location: ../admin/tabel.php?delete_error=Gagal menghapus data.");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin/tabel.php?delete_error=ID tidak ditemukan.");
    exit;
}
