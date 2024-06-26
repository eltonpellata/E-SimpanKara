<?php
session_start();
include '../koneksi.php';

$error = ""; // Tambahkan ini untuk menghindari kesalahan jika tidak ada kesalahan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    $stmt = $conn->prepare("INSERT INTO tb_user (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../login/regisrasi.php?regisrasi_success=1");
        exit();
    } else {
        $error = "Gagal mendaftar. Silakan coba lagi.";
    }

    $stmt->close();
}
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body class="main-bg">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="background: linear-gradient(to bottom, green, gold);">
            <div class="text-center mb-4">
                <h1 class="logo-badge text-primary"><i class="fa fa-user-circle">
                        <div class="text-center mb-4">
                            <img src="../assets/img/Logo-1.png" alt="logo" style="width: 50px; height: 50px; ">
                            <img src="../assets/img/Logo-2.png" alt="logo" style="width: 50px; height: 50px; ">
                        </div>
                    </i></h1>
                <h3 class="" style="font-size:  30px;color:white; border-radius: 40px; ">Regisrasi</h3>
                <h2 style="font-size: 50px; color: white; text-shadow:  2px 2px 4px #000000; border-radius: 40px; "><i>e-SimpanKara</i></h2>
            </div>
            <form method="post" action="../login/regisrasi.php">
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['regisrasi_success']) && $_GET['regisrasi_success'] == 1) : ?>
                    <div class="alert alert-success">Registrasi Anda telah berhasil!</div>
                <?php endif; ?>
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <p class="text-center mt-3"><small>Already have an account?</small> <a href="../login/login.php" class="text-primary"><small>Sign In</small></a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>