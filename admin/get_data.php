<?php
// Termasukkan file koneksi
include '../koneksi.php';

// Ambil data ID dari request
$id = $_GET['id'];

// Query untuk mengambil data
$query = "SELECT * FROM tb_simpan WHERE id = '$id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode([]);
}
