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

// Fungsi untuk cek hak akses
function cekHakAkses($posisi)
{
    // Menu sidebar
    $menu = [];

    // Hak akses untuk pimpinan dan admin
    if ($posisi === 'Pimpinan' || $posisi === 'Admin') {
        $menu = [
            'index.php' => 'Dashboard',
            'events.php' => 'Events',
            'pic.php' => 'PIC',
            'rating.php' => 'Ratings',
            'user.php' => 'Users'
        ];
    }
    // Hak akses untuk PIC
    elseif ($posisi === 'PIC') {
        $menu = [
            'events.php' => 'Events',
            'user.php' => 'Users'
        ];
    }

    return $menu;
}

// Ambil posisi pengguna dari sesi
$posisi = $_SESSION['posisi'];

// Cek menu yang boleh diakses berdasarkan posisi pengguna
$menuSidebar = cekHakAkses($posisi);

// Fungsi untuk menentukan hak akses tombol
function cekHakAksesTombol($posisi)
{
    $akses = [];

    // Hak akses untuk pimpinan dan admin
    if ($posisi === 'Pimpinan' || $posisi === 'Admin') {
        $akses = [
            'formtambah-events' => true
        ];
    } elseif ($posisi === 'PIC') {
        $akses = [
            'formtambah-events' => false
        ];
    }

    return $akses;
}

// Ambil posisi pengguna dari sesi
$posisi = $_SESSION['posisi'];

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
                        <span style="font-weight:bold; font-size:14px;  color:#ff9a8aff">Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['events.php'])): ?>
                <!-- Menu Events -->
                <li class="nav-item active" style="margin:.5rem; border-radius: 6px; background-color:#ff9a8aff">
                    <a class="nav-link" href="events.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-calendar-check" style="font-size: 1.2rem;"></i>
                        <span style="font-size:14px; font-weight: bold;">Event</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($menuSidebar['pic.php'])): ?>
                <!-- Menu PIC -->
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="pic.php" style="width:auto; padding:0.5rem;">
                        <i class="bi-people-fill" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                        <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">PIC</span>
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
                <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                    <a class="nav-link" href="user.php" style="width:auto; padding:0.5rem;">
                        <i class="bi bi-person-fill-gear" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                        <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">User</span>
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

                    <div class="row justify-content-between">
                    <?php if ($aksesTombol['formtambah-events']) : ?>
                        <a href="formtambah-events.php" class="btn btn-xl shadow-0" style="background-color:#FF9A8A; margin-left:0.8rem; margin-bottom:0.5rem;">
                            <i class="bi-plus-lg" style="color: white; font-weight:bold"></i>
                            <span style="font-size: 13px; font-weight:bold; color:white">Tambah</span>
                        </a>
                        <button class="btn btn-xl shadow-0" id="downloadPDF" style="background-color: #70AF85; margin-right:0.8rem; margin-bottom:0.5rem; color:white; font-weight:bold;">
                            <i class="bi-download"></i>
                            <span style="font-size:13px;"> Download Data</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <!-- ======================================================================== Content Row - Table ======================================================================== -->
                    <div class="row">
                        <div class="col">

                            <!-- Table -->
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878;">Tabel Event</h6>
                            </div>
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-bordered small" id="dataTable" width="100%" style="color: black;">
                                            <thead>
                                                <tr style="background-color: grey;">

                                                    <th class="text-center">Kode Event</th>
                                                    <th class="text-center">Hari/Tanggal</th>
                                                    <th class="text-center">Nama Client</th>
                                                    <th class="text-center">Jenis Event</th>
                                                    <th class="text-center">Jumlah Tamu</th>
                                                    <th class="text-center">Waktu Acara</th>
                                                    <th class="text-center">Tema Event</th>
                                                    <th class="text-center">Lokasi Event</th>
                                                    <th class="text-center">Area Lokasi Event</th>
                                                    <th class="text-center">No.Tlp / WA</th>
                                                    <th class="text-center">Dokumentasi</th>
                                                    <th class="text-center">Nama PIC</th>
                                                    <th class="text-center">Tanggal Pesan</th>
                                                    <th class="text-center" style="width: 5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                // Array nama hari dan bulan dalam bahasa Indonesia
                                                $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                                                $query = "SELECT tb_event.*, tb_pic.nama_pic FROM tb_event LEFT JOIN tb_pic ON tb_event.id_pic = tb_pic.id_pic ORDER BY id_event DESC";
                                                $sql = mysqli_query($conn, $query);

                                                while ($row = mysqli_fetch_assoc($sql)) {

                                                    $tanggal = strtotime($row['hari_tgl']);
                                                    $hariTgl = $hari[date('w', $tanggal)] . ', ' . date('d', $tanggal) . ' ' . $bulan[date('n', $tanggal) - 1] . ' ' . date('Y', $tanggal);

                                                    $idEvent = $row['id_event'];
                                                    $kodeEvent = $row['kode_event'];
                                                    $namaClient = ucwords($row['nama_client']);
                                                    $jenisEvent = ucwords($row['jenis_event']);
                                                    $jumlahTamu = $row['jumlah_tamu'];
                                                    $waktuAcara = date('H:i', strtotime($row['waktu_mulaiacara']));
                                                    $waktuSelesaiAcara = date('H:i', strtotime($row['waktu_selesaiacara']));

                                                    $temaEvent = ucwords($row['tema_event']);
                                                    $lokasiEvent = ucwords($row['lokasi_event']);
                                                    $arealokasiEvent = ucwords($row['arealokasi_event']);
                                                    $noTlp = $row['no_tlp'];
                                                    $listTamu = ucwords($row['list_tamu']);
                                                    $namaPIC = ucwords($row['nama_pic']);
                                                    $email_client = $row['email_client'];

                                                    $tanggalPesan = strtotime($row['tgl_pesan']);
                                                    $tgl_pesan = $hari[date('w', $tanggalPesan)] . ', ' . date('d', $tanggalPesan) . ' ' . $bulan[date('n', $tanggalPesan) - 1] . ' ' . date('Y', $tanggalPesan) . ' ' . date('H:i', $tanggalPesan);

                                                    $dokumentasiEvent = $row['dokumentasi_event'];

                                                    $file_download = "img/dokumentasi/" . $row['dokumentasi_event'];

                                                    // Cek apakah dokumentasi_event kosong atau file tidak ditemukan
                                                    if (!empty($dokumentasiEvent) && file_exists($file_download)) {
                                                        $gambar_dokumentasi = "<img src='img/dokumentasi/$dokumentasiEvent' style='width:150px; height:118px; object-fit:cover;' alt='Dokumentasi'>";
                                                        $download_button = "<a href='$file_download' download class='btn btn-success' style='font-size: 15px;'><i class='fas fa-download'></i></a>";
                                                    } else {
                                                        $gambar_dokumentasi = "<span class='text-muted'>Tidak ada dokumentasi</span>";
                                                        $download_button = ""; // Jika tidak ada file, tidak tampilkan tombol download
                                                    }

                                                    echo "
                                                <tr>

                                                    <td class='text-center'>$kodeEvent</td>
                                                    <td class='text-center'>$hariTgl</td>
                                                    <td class='text-center'>$namaClient</td>
                                                    <td class='text-center'>$jenisEvent</td>
                                                    <td class='text-center'>$jumlahTamu</td>
                                                    <td class='text-center'>$waktuAcara - $waktuSelesaiAcara</td>
                                                    <td class='text-center'>$temaEvent</td>
                                                    <td >$lokasiEvent</td>
                                                    <td class='text-center'>$arealokasiEvent</td>
                                                    <td class='text-center'>$noTlp</td>
                                                    <td class='text-center'>$gambar_dokumentasi</td>
                                                    <td class='text-center'>$namaPIC</td>
                                                    <td class='text-center'>$tgl_pesan</td>
                                                    <td class='text-center' style='flex-direction: column; align-items: center;'>
                                                        $download_button
                                                        <a href='formubah-events.php?update=$idEvent' class='btn btn-warning' style='font-size: 15px; margin-top:3px; margin-bottom:3px;'><i class='bi-pencil-fill'></i></a>";
                                                    if ($_SESSION['posisi'] !== 'PIC') {
                                                        echo "<a href='?hapus=$idEvent' class='btn btn-secondary' style='font-size: 15px;' onClick=\"return confirm('Hapus Event $namaClient?');\"><i class='bi-trash-fill'></i></a>";
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

                                        $delete = mysqli_query($conn, "DELETE FROM tb_event WHERE id_event = '$_GET[hapus]'");

                                        if ($delete) {
                                            echo "<script>
                                                    alert('Berhasil Hapus Event!');
                                                    document.location='events.php';
                                                </script>";
                                        } else {
                                            echo "<script>
                                                    alert('Gagal Hapus Event!');
                                                    document.location='events.php';
                                                </script>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Batas Table -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.getElementById('downloadPDF').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF('landscape');

            // Dapatkan bulan dan tahun saat ini
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1; // Bulan (1 = Januari)
            const currentYear = currentDate.getFullYear();
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const currentMonthName = monthNames[currentMonth - 1];

            // Judul laporan
            doc.setFontSize(18);
            doc.text(`Laporan Data Event`, 148, 11, null, null, 'center');
            doc.setFontSize(16);
            doc.text(`${currentMonthName} ${currentYear}`, 148, 18, null, null, 'center');

            // Header tabel sesuai dengan <thead> (tanpa "List Tamu")
            const headers = [
                ['Kode Event', 'Hari/Tanggal', 'Nama Client', 'Jenis Event', 'Jumlah Tamu', 'Waktu Acara', 'Tema', 'Lokasi', 'Area', 'No.Tlp / WA', 'Nama PIC']
            ];

            // Ambil data dari <tbody> dan filter berdasarkan bulan dan tahun saat ini
            const rows = [];
            document.querySelectorAll('#dataTable tbody tr').forEach(function(row, index) {
                const cols = row.querySelectorAll('td');

                // Ambil tanggal dari kolom "Hari/Tanggal" dan ubah ke format Date
                const hariTgl = cols[1].innerText.trim();
                const dateParts = hariTgl.split(',')[1].trim().split(' ');
                const day = parseInt(dateParts[0]);
                const month = getMonthFromName(dateParts[1]);
                const year = parseInt(dateParts[2]);

                if (!isNaN(day) && !isNaN(month) && !isNaN(year)) {
                    const eventDate = new Date(year, month - 1, day);

                    // Filter hanya event yang sesuai dengan bulan dan tahun saat ini
                    if (month === currentMonth && year === currentYear) {
                        const data = [
                            cols[0].innerText.trim(), // Kode Event
                            cols[1].innerText.trim(), // Hari/Tanggal
                            cols[2].innerText.trim(), // Nama Client
                            cols[3].innerText.trim(), // Jenis Event
                            cols[4].innerText.trim(), // Jumlah Tamu
                            cols[5].innerText.trim(), // Waktu Acara
                            cols[6].innerText.trim(), // Tema
                            cols[7].innerText.trim(), // Lokasi
                            cols[8].innerText.trim(), // Area
                            cols[9].innerText.trim(), // No.Tlp/WA
                            cols[11].innerText.trim(), // Nama PIC
                        ];
                        rows.push(data);
                    }
                } else {
                    console.error("Gagal mem-parsing tanggal: ", hariTgl);
                }
            });

            // Jika tidak ada data yang sesuai, tambahkan "Data kosong"
            if (rows.length === 0) {
                rows.push([{
                    content: 'Belum ada Data Event saat ini',
                    colSpan: 11,
                    styles: {
                        halign: 'center'
                    }
                }]);
            }

            // Menggunakan autoTable untuk memasukkan data ke dalam PDF
            doc.autoTable({
                head: headers,
                body: rows,
                startY: 20,
                theme: 'grid',
                styles: {
                    fontSize: 9
                },
                headStyles: {
                    fillColor: [100, 100, 100]
                }, // Warna header tabel
                margin: {
                    top: 20
                }
            });

            // Simpan dan unduh file PDF
            doc.save(`Event_Report_${currentMonthName}_${currentYear}.pdf`);
        });

        // Fungsi untuk mendapatkan nomor bulan dari nama bulan (dalam Bahasa Indonesia)
        function getMonthFromName(monthName) {
            const months = {
                'Januari': 1,
                'Februari': 2,
                'Maret': 3,
                'April': 4,
                'Mei': 5,
                'Juni': 6,
                'Juli': 7,
                'Agustus': 8,
                'September': 9,
                'Oktober': 10,
                'November': 11,
                'Desember': 12
            };
            return months[monthName] || NaN;
        }
    </script>


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