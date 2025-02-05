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

// Fungsi untuk menentukan hak akses tombol
function cekHakAksesTombol($posisi)
{
    $akses = [];

    // Hak akses untuk pimpinan dan admin
    if ($posisi === 'Pimpinan' || $posisi === 'Admin') {
        $akses = [
            'formtambah-akun' => true
        ];
    } elseif ($posisi === 'PIC') {
        $akses = [
            'formtambah-akun' => false
        ];
    }

    return $akses;
}

// Ambil posisi pengguna dari sesi
$posisi = $_SESSION['posisi'];

// Cek menu yang boleh diakses berdasarkan posisi pengguna
$menuSidebar = cekHakAkses($posisi);

// Cek hak akses tombol berdasarkan posisi pengguna
$aksesTombol = cekHakAksesTombol($posisi);

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
            background-color: #f2f2f2;
        }

        a.none {
            border-style: none;
        }

        a.none:hover {
            background-color: #f2f2f2;

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
                <!-- Menu Clients -->
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

                    <?php if ($aksesTombol['formtambah-akun']) : ?>
                        <a href="formtambah-user.php" class="btn btn-xl shadow-0" style="background-color:#FF9A8A; margin-bottom:1rem;">
                            <i class="bi-plus-lg" style="color: white; font-weight:bold"></i>
                            <span style="font-size: 13px; font-weight:bold; color:white">Tambah</span>
                        </a>
                    <?php endif; ?>

                    <!-- ======================================================================== Content Row - Table ======================================================================== -->

                    <div class="row justify-content-center">

                        <div class="col">

                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878;">Tabel User</h6>
                            </div>
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-bordered small" id="dataTable" width="100%" style="color: black;">
                                            <thead>
                                                <tr style="background-color: grey;">
                                                    <th class="text-center">ID User</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Username</th>
                                                    <th class="text-center">Password</th>
                                                    <th class="text-center">No. Tlp</th>
                                                    <th class="text-center">Posisi</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
    
                                                $no = 1;
                                                $posisi = $_SESSION['posisi']; // Ambil posisi pengguna dari session
                                                $namaUserLogin = $_SESSION['nama']; // Ambil nama pengguna yang sedang login
    
                                                // Cek posisi pengguna
                                                if ($posisi === 'PIC') {
                                                    // Jika posisi pengguna adalah pic, hanya tampilkan data pengguna yang sedang login
                                                    $query = "SELECT * FROM tb_users WHERE nama = '$namaUserLogin'";
                                                } else {
                                                    // Jika admin atau pimpinan, tampilkan seluruh data
                                                    $query = "SELECT * FROM tb_users";
                                                }
    
                                                $sql = mysqli_query($conn, $query);
    
                                                while ($row = mysqli_fetch_assoc($sql)) {
    
                                                    $idUser = $row['id_user'];
                                                    $nama = ucwords($row['nama']);
                                                    $username = $row['username'];
                                                    $notlpUser = $row['notlp_user'];
                                                    // Jangan hash ulang password yang sudah diambil dari database
                                                    $password = $row['password'];
                                                    $posisi = $row['posisi'];
    
                                                    echo "
                                                        <tr>
                                                            <td class='text-center'>$idUser</td>
                                                            <td>$nama</td>
                                                            <td class='text-center'>$username</td>
                                                            <td class='text-center'>Password Ter-Enkripsi</td>
                                                            <td class='text-center'>$notlpUser</td>
                                                            <td class='text-center'>$posisi</td>
                                                            <td class='text-center'>
                                                                <a href='formubah-user.php?update=$idUser' class='btn btn-warning' style='padding: 6px; font-size: 20px; margin-right:1px;'><i class='bi-pencil-fill'></i></a>";
                                                    // Hanya tampilkan tombol hapus jika Admin atau Pimpinan yang login
                                                    if ($_SESSION['posisi'] !== 'PIC') {
                                                        echo "
                                                                                <a href='?hapus=$idUser' class='btn btn-secondary' style='padding: 6px; font-size: 20px; margin-left:1px;' onClick=\"return confirm('Hapus Data User?');\"><i class='bi-trash-fill'></i></a>";
                                                    }
    
                                                    echo "
                                                                            </td>
                                                                        </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    if (isset($_GET['hapus'])) {

                                        $delete = mysqli_query($conn, "DELETE FROM tb_users WHERE id_user = '$_GET[hapus]'");

                                        if ($delete) {
                                            echo "<script>
                                                    alert('Berhasil Hapus Data User!');
                                                    document.location='user.php';
                                                </script>";
                                        } else {
                                            echo "<script>
                                                    alert('Gagal Hapus Data User!');
                                                    document.location='user.php';
                                                </script>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Batas Form Tambah Modal -->

            </div>
        </div>

        <!-- ======================================================================== Batas Content Row - Table ======================================================================== -->

    </div>
    <!-- ######################################################################## Batas Page Content ######################################################################### -->

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
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            table = $('#dataTable').DataTable({
                destroy: true,
                ordering: false,
            });
        });
    </script>

</body>

</html>