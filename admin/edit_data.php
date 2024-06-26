<?php
// Termasukkan file koneksi
include '../koneksi.php';

// Ambil data dari form
$edit_id = $_POST['edit_id'];
$edit_no_surat = $_POST['edit_no_surat'];
$edit_jdl_surat = $_POST['edit_jdl_surat'];
$edit_surat_dari = $_POST['edit_surat_dari'];
$edit_tgl_upload = $_POST['edit_tgl_upload'];
$edit_perihal = $_POST['edit_perihal'];

// Cek apakah ada file baru yang diunggah
if ($_FILES['edit_file_surat']['size'] > 0) {
    // Hapus file lama jika ada
    $query_select_file = "SELECT file_surat FROM tb_simpan WHERE id = '$edit_id'";
    $result = $conn->query($query_select_file);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_lama = $row['file_surat'];
        unlink("uploads/" . $file_lama); // Hapus file lama dari direktori
    }

    // Proses unggah file baru
    $upload_directory = "uploads/"; // Sesuaikan dengan struktur folder Anda
    $edit_file_surat = $_FILES['edit_file_surat'];
    $nama_file = $edit_file_surat['name'];
    $nama_file_tmp = $edit_file_surat['tmp_name'];
    $path = $upload_directory . $nama_file;

    if (move_uploaded_file($nama_file_tmp, $path)) {
        // Jika file berhasil diunggah, update informasi ke database
        $query = "UPDATE tb_simpan SET 
                  no_surat = '$edit_no_surat',
                  jdl_surat = '$edit_jdl_surat',
                  surat_dari = '$edit_surat_dari',
                  tgl_upload = '$edit_tgl_upload',
                  perilah = '$edit_perihal',
                  file_surat = '$nama_file'
                  WHERE id = '$edit_id'";

        if ($conn->query($query) === TRUE) {
            // Jika berhasil, arahkan kembali ke halaman tabel.php dengan pesan sukses
            header("Location: ../admin/tabel.php?success=1");
            exit;
        } else {
            // Jika query tidak berhasil
            $error_message = "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        // Jika gagal mengunggah file
        $error_message = "Maaf, terjadi kesalahan saat mengunggah file.";
    }
} else {
    // Jika tidak ada perubahan pada file surat, hanya update data kecuali file surat
    $query = "UPDATE tb_simpan SET 
              no_surat = '$edit_no_surat',
              jdl_surat = '$edit_jdl_surat',
              surat_dari = '$edit_surat_dari',
              tgl_upload = '$edit_tgl_upload',
              perilah = '$edit_perihal'
              WHERE id = '$edit_id'";

    if ($conn->query($query) === TRUE) {
        // Jika berhasil, arahkan kembali ke halaman tabel.php dengan pesan sukses
        header("Location: ../admin/tabel.php?edit_success=1");
        exit;
    } else {
        // Jika query tidak berhasil
        $error_message = "Error: " . $query . "<br>" . $conn->error;
    }
}

// Jika ada error, arahkan kembali ke halaman sebelumnya dengan pesan error
header("Location: ../admin/tabel.php?edit_error=" . urlencode($error_message));
exit;
