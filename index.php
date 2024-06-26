<?php
include 'header.php';
?>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h2 class="sitename"><i>e-SimpanKara</i></h2><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Tabel Surat</a></li>
          <li class="dropdown"><a href="#features"><span>Portfolio</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#portfolio">Visi & Misi </a></li>
              <li><a href="#pricing">Struktur Organisasi</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="login/login.php">Login Admin</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/bg-lg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <img data-aos="fade-up" data-aos-delay="900" src="assets/img/Logo-1.png" alt="" style="width: 100px; height: 100px; margin-top: -10px; margin-left: 100px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">
        <img data-aos="fade-up" data-aos-delay="900" src="assets/img/Logo-2.png" alt="" style="width: 100px; height: 100px; margin-top: -10px; margin-left: 1130px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">
        <div class="row">
          <div class="text-center ">
            <h2 data-aos="fade-up" class="fs-1" data-aos-delay="800" style=" text-shadow: 2px 2px 4px #000000;">Selamat Datang Di Sistem <i style="color:aqua;">e-SimpanKara</i></h2>
            <p><strong>
                <h1 data-aos="fade-up" data-aos-delay="900" style="color: 	#FFD700; text-shadow: 2px 2px 4px #000; text-decoration: underline;">OTMIL IV-19 AMBON</h1>
                <h4 data-aos="fade-up" data-aos-delay="900">Dapatkan informasi terbaru seputar kegiatan dan program di sini. Kami selalu berusaha untuk memberikan update terkini bagi masyarakat.</h4>
              </strong></p>
          </div>
          <!-- <div class="text-center">
            <form action="#" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
              <input type="text" class="form-control" placeholder="Contoh Pencarian Nomor Surat dan Nama Surat">
              <input type="submit" class="btn btn-primary" value="Sign up">
            </form>
          </div> -->
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-8">
          <h1 class="text-center">
            <h1 class="animated-text bg-success" style="color: #FFD700;">Tabel Surat</h1>
            <style>
              .animated-text {
                text-align: center;
                font-weight: bold;
                text-shadow: 2px 2px 4px #000000;
                animation: textAnimation 3s infinite;
              }

              @keyframes textAnimation {
                0% {
                  opacity: 0;
                }

                50% {
                  opacity: 1;
                }

                100% {
                  opacity: 0;
                }
              }
            </style>
          </h1>
          <!-- <a class="btn btn-primary" href="login/login.php">Tambah Data</a> -->
          <div class="row">
            <table id="example" class="table caption-top table-responsive-lg tabel table-bordered border-black">
              <thead class="table-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">No Surat</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Surat Dari</th>
                  <th scope="col">Tanggal Upload</th>
                  <th scope="col">Perihal</th>
                  <th scope="col">Action</th>
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
                    echo "<td><a href='/admin/uploads/" . htmlspecialchars($row['file_surat']) . "' class='btn btn-success'><i class='bi bi-arrow-down-circle-fill'>Download</i></a></td>"; // Tambahkan tombol untuk delete
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

    </section><!-- /About Section -->



    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container">


        <div class="row gy-4 align-items-stretch justify-content-between features-item ">
          <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
            <img src="assets/img/1.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex justify-content-right flex-column" data-aos="fade-up">
            <strong>
              <h5>KAOTMIL IV-19 AMBON <br></h5>
              <h2>Kolonel Kum R. Kurniadi, S.H.</h2>
            </strong>
            <p>Assalamualaikum Warahmatullahibarakatuh. Salam sejahtera bagi kita semua.Puji syukur ke hadirat Allah SWT atas terwujudnya e-SimpanKara. Situs ini merupakan media informasi e-SimpanKara Untuk satuan TNI Ops.Lainya yang berada Di Wilayah Maluku dan Maluku Utara dapat dimanfaatkan tidak hanya di lingkungan TNI yang berada di Wilayah Maluku dan Maluku Utara. </p>
            <ul>
              <li><i class="bi bi-check"></i> <span>Visi & Misi</span></li>
              <li><i class="bi bi-check"></i><span> Struktur Organisasi</span></li>
            </ul>
            <!-- <a href="#" class="btn btn-get-started align-self-start">Get Started</a> -->
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Features Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Visi dan Misi</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container text-center">

        <h3>Visi</h3>
        <p>
          <li>Menjadi lembaga yang profesional, transparan, dan akuntabel dalam penegakan hukum dan keadilan di lingkungan militer.</li>
        </p>

        <h3>Misi</h3>
        <li>Melaksanakan penuntutan dan penyidikan dalam perkara pidana yang Tersangkanya termasuk wewenang Pengadilan Militer (Dilmil);</li>
        <li>Memberikan pendapat hukum kepada Perwira Penyerah Perkara (Papera) dalam penyelesaian perkara;</li>
        <li>Melaksanakan Penetapan dan hakim (eksekusi);</li>
        <li>Pengawasan terhadap Narapidana Militer yang menjalani pidana bersyarat dan yang memperoleh pembebasan bersyarat;</li>
        <li>Melaksanakan riset kriminal dan pelanggaran HAM untuk memperoleh data guna kepentingan pembinaan pencegahan dan pendidikan;</li>
        <li>Menyelenggarakan pembinaan, pengendalian, dan pengawasan teknis yustisial terhadap tugas Otmil di daerah hukumnya;</li>
        <li>Melaksanakan pengolahan dan penyelesaian perkara khusus; dan</li>
        <li>Melaksanakan kebijakan Badan Pembinaan Hukum (Babinkum) TNI mengenai pembinaan penyelenggaraan Oditurat.</li>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Struktur Organisasi</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container" data-aos="zoom-in" data-aos-delay="100">

        <img src="assets/img/struktur.jpg" width="100%" alt="">

      </div>

    </section><!-- /Pricing Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <img src="assets/img/bg-lg.jpg" alt="" style="box-shadow: 2px 2px 5px black;">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Slogan </h3>
              <p>Jujur Benar dan Adil adalah prinsip utama yang kami pegang teguh dalam setiap tindakan dan keputusan. <br> Dengan kejujuran, kami membangun kepercayaan dengan kebenaran, kami menegakkan integritas dan dengan keadilan, kami memastikan kesetaraan bagi semua.</p>
              <a class="cta-btn" href="#about">Tabel surat</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <?php
    include 'footer.php';
    ?>