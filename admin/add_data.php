<?php
// Termasuk file koneksi
include '../koneksi.php';

// Ambil data dari form
$no_surat = $_POST['no_surat'];
$jdl_surat = $_POST['jdl_surat'];
$surat_dari = $_POST['surat_dari'];
$tgl_upload = $_POST['tgl_upload'];
$perihal = $_POST['perihal'];

// Proses unggah file
$upload_directory = "uploads/"; // Ubah sesuai dengan struktur folder Anda

$file_surat = $_FILES['file_surat'];
$nama_file = $file_surat['name'];
$nama_file_tmp = $file_surat['tmp_name'];
$path = $upload_directory . $nama_file;

// Cek apakah nomor surat sudah ada di database
$cek_query = "SELECT * FROM tb_simpan WHERE no_surat = '$no_surat'";
$result = $conn->query($cek_query);

if ($result->num_rows > 0) {
    // Jika nomor surat sudah ada
    $error_message = "Nomor surat sudah ada dalam database.";
    echo "<script>
            window.location.href = '../admin/tabel.php?pesan_error=" . urlencode($error_message) . "';
          </script>";
    exit();
} else {
    // Jika nomor surat belum ada, lanjutkan proses tambah data
    // Pindahkan file ke direktori tujuan
    if (move_uploaded_file($nama_file_tmp, $path)) {
        // File berhasil diunggah, simpan informasi ke database
        $query = "INSERT INTO tb_simpan (no_surat, jdl_surat, surat_dari, tgl_upload, perilah, file_surat) 
                  VALUES ('$no_surat', '$jdl_surat', '$surat_dari', '$tgl_upload', '$perihal', '$nama_file')";

        if ($conn->query($query) === TRUE) {
            // Data berhasil ditambahkan
            $success_message = "Data berhasil ditambahkan.";
            echo "<script>
                    window.location.href = '../admin/tabel.php?pesan_success=" . urlencode($success_message) . "';
                  </script>";
            exit();
        } else {
            // Jika terjadi kesalahan dalam query
            $error_message = "Gagal menambahkan data: " . $conn->error;
            echo "<script>
                    window.location.href = '../admin/tabel.php?pesan_error=" . urlencode($error_message) . "';
                  </script>";
            exit();
        }
    } else {
        // Jika gagal mengunggah file
        $error_message = "Maaf, terjadi kesalahan saat mengunggah file.";
        echo "<script>
                window.location.href = '../admin/tabel.php?pesan_error=" . urlencode($error_message) . "';
              </script>";
        exit();
    }
}

// Tutup koneksi
$conn->close();
