<div class="container mt-5">
  <h2 class="text-center mb-4">Responsive Table with Complete Features</h2>
  <div class="table-responsive">
    <table id="example" class="table table-hover table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>No</th>
          <th>No Surat</th>
          <th>Judul</th>
          <th>Surat Dari</th>
          <th>Tanggal Upload</th>
          <th>Perihal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Ambil data dari database
        include 'koneksi.php';
        $query = "SELECT * FROM tb_simpan";
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
            echo "<td><a href='/admin/uploads/" . htmlspecialchars($row['file_surat']) . "' class='btn btn-success'><i class='bi bi-arrow-down-circle-fill'></i> Download</a></td>";
            echo "</tr>";
            $no++;
          }
        } else {
          echo "<tr><td colspan='7' class='text-center'>Tidak ada data surat.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>