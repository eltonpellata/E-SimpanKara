<?php

// Mulai session
session_start();

// Sertakan file koneksi
include '../koneksi.php';

// Periksa apakah session 'username' sudah diset
if (!isset($_SESSION['username'])) {
  // Jika tidak, redirect ke halaman login
  header("Location: ../login/login.php"); // Ganti index.php dengan halaman login yang sesuai
  exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM tb_simpan WHERE no_surat LIKE '%$search%' OR jdl_surat LIKE '%$search%'";
$result = $conn->query($query);

// Ambil data pengguna dari session
$username = $_SESSION['username'];

// Tampilkan halaman admin di sini
?>

<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard Admin e-SimpanKara </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <!-- <link rel="icon" type="image/x-icon" href="../assets/assets/img/favicon/favicon.ico" /> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- jQuery -->
    <!-- tabel  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <!-- DataTables CSS -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/assets/js/config.js"></script>
  </head>


  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">

      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">e -SimpanKara</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item ">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <!-- Tables -->
            <li class="menu-item active">
              <a href="tabel.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Tables</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="../login/logout.php" class="menu-link">
                <i class="menu-icon tf-icons bx bi bi-arrow-bar-left"></i>
                <div data-i18n="Tables">logout</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>


          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                <h5 class="card-header">Bordered Table</h5>
                            
                <div class="card-body">
                    <div class="row align-items-xl-center gy-8">
                    <div class="container mt-5">

     
<!-- Alert untuk pesan berhasil atau gagal edit -->
<?php
if (isset($_GET['edit_success'])) {
  echo "<div id='alertEditSuccess' class='alert alert-success alert-dismissible fade show' role='alert'>
                Data berhasil diubah.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
}

if (isset($_GET['edit_error'])) {
  echo "<div id='alertEditError' class='alert alert-danger alert-dismissible fade show' role='alert'>
                {$_GET['edit_error']}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
}
?>

    <!-- Alert untuk pesan berhasil atau gagal hapus -->
    <?php
    if (isset($_GET['delete_success'])) {
      echo "<div id='alertDeleteSuccess' class='alert alert-danger alert-dismissible fade show' role='alert'>
                Data berhasil dihapus.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }

    if (isset($_GET['delete_error'])) {
      echo "<div id='alertDeleteError' class='alert alert-danger alert-dismissible fade show' role='alert'>
                {$_GET['delete_error']}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

                      <!-- Tampilkan pesan jika ada -->
      <!-- Tampilkan pesan jika ada -->
      <?php if (isset($_GET['pesan_success'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_GET['pesan_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['pesan_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_GET['pesan_error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2>Modal Bootstrap untuk Tambah Data</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Data
    </button>
    <div class="container mt-5">
    <!-- Form Pencarian -->
    <form method="GET" action="tabel.php">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari berdasarkan No Surat atau Judul" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

 
                        <div class="row">
                            <table id="example2" class="table caption-top table-responsive-lg tabel table-bordered border-black">
                              <thead class="table-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">No Surat</th>
                                  <th scope="col">Judul</th>
                                  <th scope="col">Surat Dari</th>
                                  <th scope="col">Tanggal Upload</th>
                                  <th scope="col">Perihal</th>
                                  <th scope="col">Foto Surat</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              // Ambil data dari database
                              include '../koneksi.php';
                              $search = isset($_GET['search']) ? $_GET['search'] : '';
                              $query = "SELECT * FROM tb_simpan WHERE no_surat LIKE '%$search%' OR jdl_surat LIKE '%$search%'";
                              $result = $conn->query($query);

                              if ($result->num_rows > 0) {
                                $no = 1;
                                while ($row = $result->fetch_assoc()) {
                                  echo "<tr>";
                                  echo "<th scope='row'>" . $no . "</th>";
                                  echo "<td>" . htmlspecialchars($row['no_surat']) . "</td>";
                                  echo "<td>" . htmlspecialchars($row['jdl_surat']) . "</td>";
                                  echo "<td>" . htmlspecialchars($row['surat_dari']) . "</td>";
                                  echo "<td>" . htmlspecialchars($row['tgl_upload']) . "</td>";
                                  echo "<td>" . htmlspecialchars($row['perilah']) . "</td>";
                                  echo "<td><a href='uploads/" . htmlspecialchars($row['file_surat']) . "' class='btn btn-success'><i class='bi bi-arrow-down-circle-fill'>Download</i></a></td>";
                                  echo "<td>
                                          <a href='../admin/dalate_data.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='bi bi-trash3'></i></a>
                                          |
                                          <button class='btn btn-warning edit-button' data-id='{$row['id']}' data-no_surat='{$row['no_surat']}' data-jdl_surat='{$row['jdl_surat']}' data-surat_dari='{$row['surat_dari']}' data-tgl_upload='{$row['tgl_upload']}' data-perilah='{$row['perilah']}' data-file_surat='{$row['file_surat']}' data-bs-toggle='modal' data-bs-target='#editModal'><i class='bi bi-pencil-square'></i></button>
                                        </td>";
                                  echo "</tr>";
                                  $no++;
                                }
                              } else {
                                echo "<tr><td colspan='8'>Tidak ada data surat.</td></tr>";
                              }
                              ?>
                              </tbody>
                            </table>
                          </div>
                          
                    </div>
                </div>
              </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with by
                  <a href="#" target="_blank" class="footer-link fw-bolder">e-SimpanKara</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

       <!-- Modal -->
       <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah data -->
                    <form method="post" action="../admin/add_data.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="no_surat" class="form-label">No Surat</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                        </div>
                        <div class="mb-3">
                            <label for="jdl_surat" class="form-label">Judul Surat</label>
                            <input type="text" class="form-control" id="jdl_surat" name="jdl_surat" required>
                        </div>
                        <div class="mb-3">
                            <label for="surat_dari" class="form-label">Surat Dari</label>
                            <input type="text" class="form-control" id="surat_dari" name="surat_dari" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_upload" class="form-label">Tanggal Upload</label>
                            <input type="date" class="form-control" id="tgl_upload" name="tgl_upload" required>
                        </div>
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <textarea class="form-control" id="perihal" name="perihal" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file_surat" class="form-label">File Surat</label>
                            <input type="file" class="form-control" id="file_surat" name="file_surat" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form edit data -->
                <form id="editForm" method="post" action="edit_data.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="edit_no_surat" class="form-label">No Surat</label>
                        <input type="text" class="form-control" id="edit_no_surat" name="edit_no_surat" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jdl_surat" class="form-label">Judul Surat</label>
                        <input type="text" class="form-control" id="edit_jdl_surat" name="edit_jdl_surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_surat_dari" class="form-label">Surat Dari</label>
                        <input type="text" class="form-control" id="edit_surat_dari" name="edit_surat_dari" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tgl_upload" class="form-label">Tanggal Upload</label>
                        <input type="date" class="form-control" id="edit_tgl_upload" name="edit_tgl_upload" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_perihal" class="form-label">Perihal</label>
                        <textarea class="form-control" id="edit_perihal" name="edit_perihal" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_file_surat" class="form-label">File Surat</label>
                        <input type="file" class="form-control" id="edit_file_surat" name="edit_file_surat">
                    </div>
                    <input type="hidden" id="edit_id" name="edit_id">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script untuk menampilkan data pada modal -->
<script>
    // Fungsi untuk menampilkan data pada modal saat tombol edit diklik
    $('.edit-button').click(function() {
        var id = $(this).data('id');
        var no_surat = $(this).data('no_surat');
        var jdl_surat = $(this).data('jdl_surat');
        var surat_dari = $(this).data('surat_dari');
        var tgl_upload = $(this).data('tgl_upload');
        var perilah = $(this).data('perilah');
        var file_surat = $(this).data('file_surat');

        // Set nilai input pada form modal edit
        $('#edit_id').val(id);
        $('#edit_no_surat').val(no_surat);
        $('#edit_jdl_surat').val(jdl_surat);
        $('#edit_surat_dari').val(surat_dari);
        $('#edit_tgl_upload').val(tgl_upload);
        $('#edit_perihal').val(perilah);
        $('#current_file_surat').val(file_surat);
    });
</script>




<!-- Script untuk menampilkan data pada modal -->
<script>
    // Fungsi untuk menampilkan data pada modal edit saat tombol edit diklik
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button yang diklik
        var id = button.data('id'); // Ambil data-id dari button

        // Gunakan AJAX untuk mengambil data dari server dan mengisi form
        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                // Isi form dengan data yang diterima
                var data = JSON.parse(response);
                $('#edit_no_surat').val(data.no_surat);
                $('#edit_jdl_surat').val(data.jdl_surat);
                $('#edit_surat_dari').val(data.surat_dari);
                $('#edit_tgl_upload').val(data.tgl_upload);
                $('#edit_perihal').val(data.perihal);
                $('#edit_id').val(data.id);
            }
        });
    });

    // // Fungsi untuk mengisi data ID pada modal delete saat tombol delete diklik
    // $('#deleteModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget); // Button yang diklik
    //     var id = button.data('id'); // Ambil data-id dari button

    //     // Set nilai input hidden dengan ID
    //     $('#delete_id').val(id);
        
    // });
     // Fungsi untuk menyembunyikan alert setelah tombol close diklik
    //  $('.alert .btn-close').on('click', function() {
    //     $(this).closest('.alert').fadeOut('fast');
    // });
</script>
<script>
    $(document).ready(function() {
        $('#example2').DataTable(); // Pastikan ID tabel sesuai
    });
</script>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
   
  </body>
</html>