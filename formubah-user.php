<?php
session_start();

include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location='login.php';
        </script>";
    exit;
}

$id_user = $_SESSION['id_user'];

// Fungsi untuk cek hak akses
function cekHakAkses($posisi)
{
    // Menu sidebar
    $menu = [];

    // Hak akses untuk pimpinan dan admin
    if ($posisi === 'Pimpinan' || $posisi === 'Admin') {
        $menu = [
            'index.php' => 'Dashboard',
            'events.php' => 'Event',
            'pic.php' => 'PIC',
            'rating.php' => 'Rating',
            'user.php' => 'User'
        ];
    }
    // Hak akses untuk PIC
    elseif ($posisi === 'PIC') {
        $menu = [
            'events.php' => 'Event',
            'user.php' => 'User'
        ];
    }

    return $menu;
}

// Ambil posisi pengguna dari sesi
$posisi = $_SESSION['posisi'];

// Cek menu yang boleh diakses berdasarkan posisi pengguna
$menuSidebar = cekHakAkses($posisi);

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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

    <!-- Custom style for Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        li:hover {
            background-color: #ffefec;
        }

        a.none {
            border-style: none;
        }

        a.none:hover {
            background-color: #ffefec;
            ;
        }

        #overflowTest {

            width: 100%;
            height: 400px;
            overflow: hidden;
            border: none;
        }

        #overflowTest:hover {
            padding: 5px;
            width: 100%;
            overflow: auto;
            border: none;
        }

        .sidebar-dark #sidebarToggle {
            background-color: rgb(255 214 207);
        }

        .sidebar-dark #sidebarToggle:hover {
            background-color: rgb(235 235 235);
            ;
        }

        .sidebar-dark #sidebarToggle::after {
            color: rgb(255 154 138);
        }

        .sidebar-dark.toggled #sidebarToggle::after {
            color: rgb(255 154 138);
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->

    <div id="wrapper">

        <!-- ======================================================================== Sidebar ======================================================================== -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Brand/Logo -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center" style="padding:0; margin-top:1rem; margin-bottom:1rem;">
                <div class="sidebar-brand-icon">
                    <img src="img/Logo-PartyPlanner.png" width="50%">
                </div>
            </div>

            <?php if (isset($menuSidebar['index.php'])): ?>
                <!-- Menu Dashboard -->
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="index.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-house-door-fill" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                        <span style="font-weight:bold; font-size:14px; color:#ff9a8aff">Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['events.php'])): ?>
                <!-- Menu Events -->
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="events.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-calendar-check" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                        <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">Event</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['pic.php'])): ?>
                <!-- Menu PIC -->
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="pic.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-people-fill" style="font-size: 1.2rem; color:#ff9a8aff;"></i>
                        <span style="font-size:14px; font-weight: bold; color:#ff9a8aff;">PIC</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['rating.php'])): ?>
                <!-- Menu Rating -->
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="rating.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-star" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                        <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">Rating</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['user.php'])): ?>
                <!-- Menu Users -->
                <li class="nav-item active" style="margin:.5rem; border-radius: 6px; background-color:#ff9a8aff;">
                    <a class="nav-link" href="user.php" style="width:auto; padding:0.5rem;">
                        <i class="bi bi-person-fill-gear" style="font-size: 1.2rem; "></i>
                        <span style="font-size:14px; font-weight: bold; ">User</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline" style="color:#ff9a8aff; margin-top: 1rem;">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- ======================================================================== Batas Sidebar ======================================================================== -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color:#ffefec">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #f8f9fc;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle">
                        <i class="fa fa-bars" style="color:#FF7878;"></i>
                    </button>

                    <h1 class="h3 mb-0 text-800" style="color:#FF7878; font-weight:bold">User</h1>

                    <!-- Topbar Navbar -->
                    <!-- Nav Item - Messages -->
                    <ul class="navbar-nav ml-auto align-items-center" style="flex-direction:row">

                        <li class="nav-item dropdown no-arrow">
                            <span class="mr-2 d-none d-lg-inline text-600" style="color:#FF7878; font-weight:bold; font-size: 14px;"><?php echo ucwords($_SESSION['nama']); ?></span>
                        </li>
                        <div class="topbar-divider d-none d-sm-block" style="width: 0;border-right: 1px solid #c6c6c6;height: calc(4.375rem - 2rem);margin: auto 1rem;"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-fill-gear" style="font-size:1.8rem; color:#FF7878;"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="formubah-user.php?update=<?php echo $id_user; ?>">
                                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 "></i>
                                    Edit Profile

                                </a>
                                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                                    Logout
                                </a>
                            </div>
                            <!-- Logout Modal-->
                            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah Anda Yakin Ingin Keluar?</div>
                                        <div class="modal-footer">
                                            <a class="btn btn-primary" href="login.php">Iya</a>
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- ######################################################################## Page Content ######################################################################### -->
                <div class="container-fluid">

                    <!-- ======================================================================== Content Row - Table ======================================================================== -->

                    <?php

                    // Cek apakah parameter 'update' ada
                    if (isset($_GET['update'])) {
                        $id_user = $_GET['update'];

                        // Query untuk mengambil data user berdasarkan id_user
                        $sql = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_user = '$id_user'");

                        // Cek apakah ada data yang ditemukan
                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_array($sql);
                        } else {
                            echo "<script>
            alert('Data tidak ditemukan!');
            document.location='user.php';
            </script>";
                            exit;
                        }
                    } else {
                        echo "<script>
        alert('ID user tidak ditemukan!');
        document.location='user.php';
        </script>";
                        exit;
                    }

                    ?>

                    <div class="row">
                        <div class="col">

                            <form action="" method="POST">
                                <h3 class="text-center" style="margin-bottom:1rem; font-weight:bold;">Form Ubah Data User</h3>
                                <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:7px;">
                                                <label for="name" class="form-label">Nama</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="" class="form-label">Username</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top:7px;">
                                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="" class="form-label">No.Telp / WA</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top:7px;">
                                                <input type="text" name="notlp_user" class="form-control" value="<?php echo $row['notlp_user']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="" class="form-label">Posisi</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top:7px;">
                                                <select name="posisi" class="form-control" style="margin-bottom:1rem;" id="posisiSelect">
                                                    <option <?php echo ($row['posisi'] == 'Pimpinan') ? "selected" : ""; ?>>Pimpinan</option>
                                                    <option <?php echo ($row['posisi'] == 'Admin') ? "selected" : ""; ?>>Admin</option>
                                                    <option <?php echo ($row['posisi'] == 'PIC') ? "selected" : ""; ?>>PIC</option>
                                                </select>
                                            </div>
                                        </div>

                                            
                                    </div>
                                </div>

                                <h3 class="text-center" style="margin-bottom:1rem; font-weight:bold; margin-top:3rem;">Ganti Password</h3>

                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:7px;">
                                                <label for="password_lama" class="form-label">Masukan Password Lama</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="password" id="password_lama" name="password_lama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="password_baru" class="form-label">Masukan Password Baru</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top:7px;">
                                                <input type="password" id="password_baru" name="password_baru" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="password_konfirmasi" class="form-label">Konfirmasi Password Baru</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top:7px;">
                                                <input type="password" id="password_konfirmasi" name="password_konfirmasi" class="form-control">
                                                <input type="checkbox" id="show_password" onclick="togglePassword()" style="margin-top: 1.3rem; margin-bottom:1rem;"> Tampilkan Password
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center" style=" margin-bottom:1rem;">
                                    <div class="md-4" style="margin-top:1rem;">
                                        <button type="submit" class="btn btn-primary" name="ubah" style="margin-right: 5px;">Simpan</button>
                                        <a href="javascript:history.back()" type="button" class="btn btn-secondary" style="margin-left: 5px;">Batal</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <?php

                if (isset($_POST['ubah'])) {
                    $password_lama = $_POST['password_lama'];
                    $password_baru = $_POST['password_baru'];
                    $konfirmasi_password = $_POST['password_konfirmasi'];
                    $posisi = $_POST['posisi'];
                    $id_user = $_POST['id_user'];

                    $sql = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_user = '$id_user'");
                    $result = mysqli_fetch_assoc($sql);

                    // Proses update password jika form password diisi
                    if (!empty($password_lama) && !empty($password_baru) && !empty($konfirmasi_password)) {
                        // Cek apakah password lama sesuai dengan yang ada di database
                        if (password_verify($password_lama, $result['password'])) {
                            // Cek apakah password baru sama dengan konfirmasi password
                            if ($password_baru == $konfirmasi_password) {
                                // Hash password baru
                                $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                            } else {
                                echo "<script>
                    alert('Konfirmasi password tidak sesuai!');
                    document.location='formubah-akun.php?update=$id_user';
                </script>";
                                exit;
                            }
                        } else {
                            // Jika password lama salah
                            echo "<script>
                alert('Password lama salah!');
                document.location='formubah-akun.php?update=$id_user';
            </script>";
                            exit;
                        }
                    } else {
                        // Jika form password tidak diisi, gunakan password yang lama
                        $password_hash = $result['password'];
                    }

                    // Ambil posisi pengguna yang login
                    $posisi = $_POST['posisi'];

                    // Update data pengguna tanpa mengubah posisi jika PIC
                    $update = mysqli_query($conn, "UPDATE tb_users SET 
                                nama = '$_POST[nama]', 
                                username = '$_POST[username]', 
                                password = '$password_hash', 
                                notlp_user = '$_POST[notlp_user]',
                                posisi = '$posisi' 
                                WHERE id_user = '$id_user'");

                    if ($update) {
                        echo "<script>
                        alert('Berhasil Ubah Data User!');
                        document.location='user.php';
                    </script>";
                    } else {
                        echo "<script>
                        alert('Gagal Ubah Data User!');
                        document.location='formubah-akun.php?update=$id_user';
                    </script>";
                    }
                }
                ?>
                <!-- Batas Form Tambah Modal -->

            </div>
        </div>

        <!-- ======================================================================== Batas Content Row - Table ======================================================================== -->

    </div>
    <!-- ######################################################################## Batas Page Content ######################################################################### -->

    </div>
    <!-- Batas Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profileImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Fungsi untuk menampilkan atau menyembunyikan password
        function togglePassword() {
            var passwordLama = document.getElementById("password_lama");
            var passwordBaru = document.getElementById("password_baru");
            var passwordKonfirmasi = document.getElementById("password_konfirmasi");
            var checkbox = document.getElementById("show_password");

            // Mengubah tipe input password berdasarkan checkbox
            if (checkbox.checked) {
                passwordLama.type = "text";
                passwordBaru.type = "text";
                passwordKonfirmasi.type = "text";
            } else {
                passwordLama.type = "password";
                passwordBaru.type = "password";
                passwordKonfirmasi.type = "password";
            }
        }

        window.onload = function() {
            var posisi = "<?php echo $_SESSION['posisi']; ?>";
            if (posisi === 'PIC') {
                document.getElementById('posisiSelect').disabled = true;
            }
        };
    </script>

</body>

</html>