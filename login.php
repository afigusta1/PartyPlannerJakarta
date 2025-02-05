<?php
session_start();
include "koneksi.php";

// Fungsi untuk cek hak akses dan halaman default
function cekHakAkses($posisi) {
    // Menu sidebar
    $menu = [];

    // Hak akses untuk pimpinan dan admin
    if ($posisi === 'Pimpinan' || $posisi === 'Admin') {
        $menu = [
            'dashboard.php' => 'Dashboard',
            'events.php' => 'Events',
            'pic.php' => 'PIC',
            'rating.php' => 'Review Ratings',
            'login.php' => 'Logout'
        ];
        // Halaman default untuk pimpinan/admin adalah dashboard
        $default_page = 'index.php';
    } 
    // Hak akses untuk PIC
    elseif ($posisi === 'PIC') {
        $menu = [
            'events.php' => 'Events',
            'login.php' => 'Logout'
        ];
        // Halaman default untuk PIC adalah events.php
        $default_page = 'events.php';
    }

    return ['menu' => $menu, 'default_page' => $default_page];
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        // Menahan proses login di sisi server jika ada field yang kosong
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const usernameField = document.getElementById('username');
                const passwordField = document.getElementById('password');
                
                // Tampilkan popovers pada field yang kosong
                if (usernameField.value.trim() === '') {
                    new bootstrap.Popover(usernameField).show();
                }
                if (passwordField.value.trim() === '') {
                    new bootstrap.Popover(passwordField).show();
                }
            });
        </script>";
    } else {
        // Query untuk mendapatkan user berdasarkan username
        $sql = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");

        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        
            // Verifikasi password
            if (password_verify($password, $row['password'])) {
                // Set sesi pengguna
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['nama'] = ucwords($row['nama']);
                $_SESSION['posisi'] = $row['posisi'];
                $_SESSION['notlp_user'] = $row['notlp_user'];
        
                // Dapatkan hak akses dan halaman default
                $akses = cekHakAkses($row['posisi']);
                $default_page = $akses['default_page'];
        
                // Redirect pengguna ke halaman yang sesuai
                echo "<script>
                    alert('Berhasil Login, Selamat Datang $_SESSION[nama]');
                    document.location='$default_page';
                    </script>";
            } else {
                $login_failed = true; // Penanda untuk gagal login
            }
        } else {
            $login_failed = true; // Penanda untuk gagal login
        }
        
        // Tampilkan pesan jika login gagal
        if (isset($login_failed) && $login_failed) {
            echo "<script>
                alert('Gagal Login! Username atau Password Salah.');
                document.location='login.php';
                </script>";
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Party Planner Jakarta</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-dark">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card bg-secondary o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="img/Logo-PartyPlannerP.png" height="150" width="150" styles="margin">
                                </div>
                                <form action="" method="post" id="loginForm" class="user" style="margin-top:3rem">
                                    <div class="form-group">
                                        <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="Username" data-bs-toggle="popover" data-bs-content="Username harus diisi!" data-bs-placement="right">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control form-control-user" placeholder="Password" data-bs-toggle="popover" data-bs-content="Password harus diisi!" data-bs-placement="right">
                                    </div>
                                    <hr style="margin-top: 1.5rem; margin-bottom:0;">
                                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block" style="margin-top: 1.5rem;">Login</button>
                                </form>
                            </div>
                            <div class="text-center">
                                <small class="text-white">Skripsi Muhammad Afi Gustamal</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Inisialisasi Popovers
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, { trigger: 'manual' });
        });

        // Validasi form
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            let username = document.getElementById('username');
            let password = document.getElementById('password');
            let isValid = true;

            // Validasi username
            if (username.value.trim() === "") {
                username.classList.add('is-invalid');
                new bootstrap.Popover(username).show();
                isValid = false;
            } else {
                new bootstrap.Popover(username).hide();
                username.classList.remove('is-invalid');
            }

            // Validasi password
            if (password.value.trim() === "") {
                password.classList.add('is-invalid');
                new bootstrap.Popover(password).show();
                isValid = false;
            } else {
                new bootstrap.Popover(password).hide();
                password.classList.remove('is-invalid');
            }

            // Jika form tidak valid, cegah pengiriman
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>

</body>

</html>
