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
            <li class="nav-item active" style="margin:.5rem; border-radius: 6px; background-color:#ff9a8aff">
                <a class="nav-link" href="events.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-calendar-check" style="font-size: 1.2rem;"></i>
                    <span style="font-size:14px; font-weight: bold;">Event</span>
                </a>
            </li>



            <!-- Menu Clients -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="pic.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-people-fill" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">PIC</span>
                </a>
            </li>



            <!-- Menu Analythic -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="rating.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-star" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">Rating</span>
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

                    <h1 class="h3 mb-0 text-800" style="color:#FF7878; font-weight:bold">Event</h1>

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

                    $sql = mysqli_query($conn, "SELECT tb_event.*, tb_pic.nama_pic FROM tb_event LEFT JOIN tb_pic ON tb_event.id_pic = tb_pic.id_pic WHERE id_event = '$_GET[update]'");
                    $row = mysqli_fetch_array($sql);

                    $id_pic = $row['id_pic'] ?? ''; // Tampilkan kosong jika null
                    $nama_pic = $row['nama_pic'] ?? ''; // Tampilkan nama pic kosong jika tidak ada
                    $keterangan_event = $row['keterangan_event'] ?? '';
                    ?>

                    <div class="row ">
                        <div class="col ">

                            <!-- Form Tambah Modal -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <h3 class="text-center" style="margin-bottom:1rem;  font-weight:bold;">Form Ubah Data Event</h3>
                                <input type="hidden" name="id_event" value="<?php echo $row['id_event']; ?>">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:7px;">
                                                <label for="name" class="form-label">Nama Client</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="nama_client" class="form-control" value="<?php echo ucwords($row['nama_client']); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="noTlp" class="form-label">No.Telp / WA</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;;">
                                                <input type="text" name="no_tlp" class="form-control" value="<?php echo $row['no_tlp']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="hariTgl" class="form-label">Hari / Tanggal</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;;">
                                                <input type="date" name="hari_tgl" class="form-control" style="width: 9rem;" value="<?php echo isset($row['hari_tgl']) ? $row['hari_tgl'] : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="waktu" class="form-label">Waktu Mulai Acara</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="time" name="waktu_mulaiacara" class="form-control" style="width: 7rem;" value="<?php echo date('H:i', strtotime($row['waktu_mulaiacara'])); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="waktu" class="form-label">Waktu Selesai Acara</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="time" name="waktu_selesaiacara" class="form-control" style="width: 7rem;" value="<?php echo date('H:i', strtotime($row['waktu_selesaiacara'])); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="lokasi" class="form-label">Lokasi</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="lokasi_event" class="form-control" value="<?php echo ucwords($row['lokasi_event']); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="arealokasi" class="form-label">Area</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="arealokasi_event" class="form-control" value="<?php echo ucwords($row['arealokasi_event']); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="jenis" class="form-label">Jenis Event</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="jenis_event" class="form-control" value="<?php echo ucwords($row['jenis_event']); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Tema</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="tema_event" class="form-control" value="<?= ucwords($row['tema_event']); ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="jumlahTamu" class="form-label">Jumlah Tamu</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px; ">
                                                <input type="number" name="jumlah_tamu" min="2" class="form-control" style="width: 5rem;" value="<?= $row['jumlah_tamu']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="listTamu" class="form-label">List Tamu</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px; color:grey;">
                                                <textarea class="form-control" name="list_tamu" rows="10" style="border-radius: 5px; color:grey; height: 130px;"><?php echo ucwords($row['list_tamu']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Email Client</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="email_client" class="form-control" value="<?php echo $row['email_client']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="tema" class="form-label">Nama PIC</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px;">
                                                <input type="text" name="nama_pic" class="form-control" value="<?php echo $row['nama_pic']; ?>">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 align-items-center" style="margin-top:1rem;">
                                                <label for="keterangan_event" class="form-label">Keterangan</label>
                                            </div>
                                            <div class="col-md-5" style="margin-top: 7px; color:grey;">
                                                <textarea class="form-control" name="keterangan_event" rows="10" style="border-radius: 5px; color:grey; height: 130px;"><?php echo ucwords($row['keterangan_event']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="mb-4" style="margin-top:1.5rem;">
                                        <?php if (!empty($row['dokumentasi_event'])): ?>
                                            <img src="img/dokumentasi/<?php echo $row['dokumentasi_event']; ?>" width="150">
                                        <?php endif; ?>
                                        <input type="hidden" name="lama" value="<?php echo $row['dokumentasi_event']; ?>">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-4 text-center" style=" margin-top:1rem;">
                                        <label class="form-label">Tambah / Ubah Dokumentasi</label>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="mb-4">
                                        <input type="file" name="baru" class="border" style="margin-top: 7px; border-radius:5px; background-color: white; color:grey" multiple>
                                    </div>
                                </div>
                                <div class="row justify-content-center" style="margin-bottom:1rem;">
                                    <div class="mb-4" style="margin-top:1.5rem;">
                                        <button type="submit" class="btn btn-primary" name="ubah" style="margin-right: 5px;">Simpan</button>
                                        <a href="events.php" type="button" class="btn btn-secondary" style="margin-left: 5px;">Close</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
if (isset($_POST['ubah'])) {
    // Ambil nilai dari form
    $hari_tgl = $_POST['hari_tgl'];
    $nama_client = $_POST['nama_client'];
    $jenis_event = $_POST['jenis_event'];
    $jumlah_tamu = $_POST['jumlah_tamu'];
    $waktu_mulaiacara = $_POST['waktu_mulaiacara'];
    $tema_event = $_POST['tema_event'];
    $lokasi_event = $_POST['lokasi_event'];
    $arealokasi_event = $_POST['arealokasi_event'];
    $no_tlp = $_POST['no_tlp'];
    $list_tamu = $_POST['list_tamu'];
    $keterangan_event = $_POST['keterangan_event'];
    $waktu_selesaiacara = $_POST['waktu_selesaiacara'];
    $email_client = $_POST['email_client'];
    $nama_pic = $_POST['nama_pic'];

    // Cari id_pic berdasarkan nama_pic
    $query_pic = "SELECT id_pic FROM tb_pic WHERE nama_pic = '$nama_pic'";
    $result_pic = mysqli_query($conn, $query_pic);
    $id_pic = null; // Default null value

    // Jika nama PIC ditemukan, ambil id_pic
    if ($result_pic && mysqli_num_rows($result_pic) > 0) {
        $id_pic = mysqli_fetch_assoc($result_pic)['id_pic'];
    } else {
        // Jika nama PIC tidak ditemukan, tambahkan data baru ke tb_pic
        $query_insert_pic = "INSERT INTO tb_pic (nama_pic) VALUES ('$nama_pic')";
        if (mysqli_query($conn, $query_insert_pic)) {
            // Ambil id_pic yang baru saja dimasukkan
            $id_pic = mysqli_insert_id($conn);
        } else {
            echo "<script>
            alert('Gagal menambahkan PIC baru!');
            document.location='events.php';
        </script>";
            exit; // Jika gagal menambahkan, hentikan eksekusi
        }
    }

    // Ambil data asli dari database untuk perbandingan
    $query_original = "SELECT * FROM tb_event WHERE id_event = $_GET[update]";
    $result_original = mysqli_query($conn, $query_original);
    $data_original = mysqli_fetch_assoc($result_original);

    // Jika file baru diunggah, proses upload dan hapus file lama
    if ($_FILES['baru']['name'] !== '') {
        $baru = $_FILES['baru']['name'];
        unlink("img/dokumentasi/" . $_POST['lama']);
        move_uploaded_file($_FILES['baru']['tmp_name'], "img/dokumentasi/" . $_FILES['baru']['name']);
    } else {
        $baru = $data_original['dokumentasi_event']; // Gunakan data lama
    }

    // Buat query update dinamis hanya untuk kolom yang diubah
    $update_fields = [];

    if ($hari_tgl !== $data_original['hari_tgl']) $update_fields[] = "hari_tgl = '$hari_tgl'";
    if ($nama_client !== $data_original['nama_client']) $update_fields[] = "nama_client = '$nama_client'";
    if ($jenis_event !== $data_original['jenis_event']) $update_fields[] = "jenis_event = '$jenis_event'";
    if ($jumlah_tamu !== $data_original['jumlah_tamu']) $update_fields[] = "jumlah_tamu = '$jumlah_tamu'";
    if ($waktu_mulaiacara !== $data_original['waktu_mulaiacara']) $update_fields[] = "waktu_mulaiacara = '$waktu_mulaiacara'";
    if ($tema_event !== $data_original['tema_event']) $update_fields[] = "tema_event = '$tema_event'";
    if ($lokasi_event !== $data_original['lokasi_event']) $update_fields[] = "lokasi_event = '$lokasi_event'";
    if ($arealokasi_event !== $data_original['arealokasi_event']) $update_fields[] = "arealokasi_event = '$arealokasi_event'";
    if ($no_tlp !== $data_original['no_tlp']) $update_fields[] = "no_tlp = '$no_tlp'";
    if ($list_tamu !== $data_original['list_tamu']) $update_fields[] = "list_tamu = '$list_tamu'";
    if ($keterangan_event !== $data_original['keterangan_event']) $update_fields[] = "keterangan_event = '$keterangan_event'";
    if ($waktu_selesaiacara !== $data_original['waktu_selesaiacara']) $update_fields[] = "waktu_selesaiacara = '$waktu_selesaiacara'";
    if ($email_client !== $data_original['email_client']) $update_fields[] = "email_client = '$email_client'";
    if ($id_pic !== $data_original['id_pic']) $update_fields[] = "id_pic = $id_pic";
    if ($baru !== $data_original['dokumentasi_event']) $update_fields[] = "dokumentasi_event = '$baru'";

    // Jika ada field yang berubah, lakukan update
    if (!empty($update_fields)) {
        $query_update = "UPDATE tb_event SET " . implode(", ", $update_fields) . " WHERE id_event = $_GET[update]";
        $ubah = mysqli_query($conn, $query_update);

        if ($ubah) {
            echo "<script>
        alert('Berhasil Ubah Data Event!');
        document.location='events.php';
    </script>";
        } else {
            echo "<script>
        alert('Gagal Ubah Data Event!');
        document.location='events.php';
    </script>";
        }
    } else {
        echo "<script>
    alert('Tidak ada perubahan pada data!');
    document.location='events.php';
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