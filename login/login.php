<?php
session_start();
include '../koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: ../admin/index.php");
        exit();
    } else {
        $error = "Username atau password salah";
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
    <title>Login</title>
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
                <h2 style="font-size: 50px; color: white; text-shadow:  2px 2px 4px #000000; border-radius: 40px; "><i>e-SimpanKara</i></h2>
            </div>
            <?php if ($error) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" action="login.php">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                <p class="text-center mt-3"><small>Don't have an account?</small> <a href="../login/regisrasi.php" class="text-primary"><small>Sign Up</small></a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>