<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location='login.php';
        </script>";
    exit;
}

$id_user = $_SESSION['id_user'];


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

        .rating {
            font-size: 80px;
            color: #ff9a8aff;
            font-weight: bold;
        }

        .text-warning {
            color: gold !important
        }

        .progres {
            width: 50%;
            margin-left: 1rem;
            display: flex;
            align-items: center;
            column-gap: 0.4rem;
            height: 2rem;
        }

        .up {
            color: #70AF85;
            font-weight: bold;
        }

        .equal {
            color: #EEC373;
            font-weight: bold;
        }

        .down {
            color: #FF7878;
            font-weight: bold;
        }

        .profile-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            text-transform: uppercase;
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



            <!-- Menu Dashboard -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="index.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-house-door-fill" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-weight:bold; font-size:14px;  color:#ff9a8aff">Dashboard</span>
                </a>
            </li>



            <!-- Menu Events -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="events.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-calendar-check" style="font-size: 1.2rem;  color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold;  color:#ff9a8aff">Event</span>
                </a>
            </li>



            <!-- Menu Clients -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="pic.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-people-fill" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">PIC</span>
                </a>
            </li>



            <!-- Menu Rating -->
            <li class="nav-item active" style="margin:.5rem; border-radius: 6px; background-color:#ff9a8aff">
                <a class="nav-link" href="rating.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-star" style="font-size: 1.2rem;"></i>
                    <span style="font-size:14px; font-weight: bold;">Rating</span>
                </a>
            </li>


            <!-- Menu Users -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="user.php" style="width:auto; padding:0.5rem;">
                    <i class="bi bi-person-fill-gear" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">User</span>
                </a>
            </li>


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

                    <h1 class="h3 mb-0 text-800" style="color:#FF7878; font-weight:bold">Review Ratings</h1>

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

                    $sql = mysqli_query($conn, "SELECT * FROM tb_rating WHERE id_rating = '$_GET[update]'");
                    $row = mysqli_fetch_array($sql);

                    ?>

                    <div class="row">
                        <div class="col">

                            <!-- Form Tambah Modal -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <h3 class="text-center" style="margin-bottom:1rem;  font-weight:bold;">Form Ubah Data Rating</h3>
                                <input type="hidden" name="id_rating" value="<?php echo $row['id_rating']; ?>">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:7px;">
                                                <label for="name" class="form-label">Nama Reviewer</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="nama_reviewer" class="form-control" value="<?php echo ucwords($row['nama_reviewer']); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="noTlp" class="form-label">No.Telp / WA</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="no_tlp" class="form-control" value="<?php echo $row['notlp_reviewer']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="hariTgl" class="form-label">Tanggal Review</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="tgl_review" class="form-control" value="<?php echo isset($row['tgl_review']) ? $row['tgl_review'] : ''; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="lokasi" class="form-label">Email Reviewer</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="email_reviewer" class="form-control" value="<?php echo $row['email_reviewer']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="arealokasi" class="form-label">Kode Event</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="kode_event" class="form-control" value="<?php echo ucwords($row['kode_event']); ?>">
                                            </div>
                                        </div>
                                        <hr style="width:0rem;">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="jenis" class="form-label">Penilaian Komunikasi</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="penilaian_satu" class="form-control" value="<?php echo ucwords($row['penilaian_satu']); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Penilaian Perencanaan</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="penilaian_dua" class="form-control" value="<?= ucwords($row['penilaian_dua']); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="jumlahTamu" class="form-label">Penilaian Pelaksanaan</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px; ">
                                                <input type="number" name="penilaian_tiga" min="2" class="form-control" value="<?= $row['penilaian_tiga']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Penilaian Kepuasan</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="penilaian_empat" class="form-control" value="<?php echo $row['penilaian_empat']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Penilaian Rekomendasi</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="penilaian_lima" class="form-control" value="<?php echo $row['penilaian_lima']; ?>" disabled>
                                            </div>
                                        </div>
                                        <hr style="width:0rem;">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="keterangan_event" class="form-label">Komentar</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <textarea class="form-control" name="komentar_reviewer" rows="10" style="border-radius: 5px; color:grey; height: 130px;" disabled><?php echo ucwords($row['komentar_reviewer']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row justify-content-center" style="margin-bottom:1rem;">
                                    <div class="mb-4" style="margin-top:1.5rem;">
                                        <button type="submit" class="btn btn-primary" name="ubah" style="margin-right: 5px;">Simpan</button>
                                        <a href="rating.php" type="button" class="btn btn-secondary" style="margin-left: 5px;">Close</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php

                    if (isset($_POST['ubah'])) {
                        $idRating = $_POST['id_rating'];
                        $kodeEvent = $_POST['kode_event'];

                        $update = mysqli_query($conn, "UPDATE tb_rating SET 
                                                                    kode_event = '$kodeEvent'
                                                                    WHERE id_rating = '$_GET[update]'");

                        if ($update) {
                            echo "<script>
                            alert('Berhasil Ubah Data Rating!');
                            document.location='rating.php';
                            </script>";
                        } else {
                            echo "<script>
                            alert('Gagal Ubah Data Rating!');
                            document.location='formubah-rating.php?update=$idRating';
                            </script>";
                        }
                    }

                    ?>
                </div>

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
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>