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
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

        .rating {
            font-size: 70px;
            color: #ff9a8aff;
            font-weight: bold;
        }

        .text-warning {
            color: gold !important
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
                    <div class="row">
                        <div class="col">
                            <div class="card border-0">
                                <div class="row" style="margin-bottom:2rem;">
                                    <div class="col">
                                        <div class="card-header" style="margin-bottom:1rem;">
                                            <h5 class="font-weight-bold text-center" style="color:#FF7878;margin-bottom:0rem">Total Average Rating</h5>
                                        </div>
                                        <div class="card border-0">
                                            <div class="row" style="padding: 0px 10px 0 10px;">
                                                <div class="col">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <div class="row justify-content-center">
                                                            <span class="rating">
                                                                <?php
                                                                // Query untuk memvalidasi id_event
                                                                $query = "
                        SELECT 
                            SUM(CASE 
                                WHEN r.kode_event IN (SELECT kode_event FROM tb_event) 
                                THEN (r.penilaian_satu + r.penilaian_dua + r.penilaian_tiga + r.penilaian_empat + r.penilaian_lima)
                                ELSE 0 
                            END) / 
                            SUM(CASE 
                                WHEN r.kode_event IN (SELECT kode_event FROM tb_event) 
                                THEN 5 
                                ELSE 0 
                            END) AS total
                        FROM tb_rating r";
    
                                                                $sql = mysqli_query($conn, $query);
    
                                                                if ($row = mysqli_fetch_assoc($sql)) {
                                                                    // Hitung total dan tampilkan dengan pembulatan 1 desimal
                                                                    $total = round($row['total'], 1);
                                                                    echo $total;
                                                                } else {
                                                                    echo "0.0"; // Default jika tidak ada data
                                                                }
                                                                ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 44px; margin-top:28px; margin-left:7px"></i>
                                                        </div>
                                                        <div style="text-align: center;">
                                                            <div style="font-size:25px; font-weight:bold;">Out of 5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <div class="row justify-content-center">
                                                            <i class="fas fa-user" style="color: grey; font-size: 44px; margin-top:28px; margin-right:10px"></i>
                                                            <span class="rating">
                                                                <?php
                                                                // Query untuk menghitung jumlah review valid
                                                                $query = "
                        SELECT COUNT(*) AS totalUserReview 
                        FROM tb_rating r
                        WHERE r.kode_event IN (SELECT kode_event FROM tb_event)";
                                                                $sql = mysqli_query($conn, $query);
    
                                                                if ($row = mysqli_fetch_assoc($sql)) {
                                                                    // Tampilkan jumlah user review
                                                                    echo $row['totalUserReview'];
                                                                } else {
                                                                    echo "0"; // Default jika tidak ada data
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                        <div style="text-align:center;">
                                                            <div style="font-size:25px; font-weight:bold;">Reviews</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <?php

                                    $query = "SELECT 
        AVG(CASE WHEN r.kode_event IN (SELECT kode_event FROM tb_event) THEN r.penilaian_satu ELSE NULL END) AS komunikasi, 
        AVG(CASE WHEN r.kode_event IN (SELECT kode_event FROM tb_event) THEN r.penilaian_dua ELSE NULL END) AS perencanaan, 
        AVG(CASE WHEN r.kode_event IN (SELECT kode_event FROM tb_event) THEN r.penilaian_tiga ELSE NULL END) AS pelaksanaan, 
        AVG(CASE WHEN r.kode_event IN (SELECT kode_event FROM tb_event) THEN r.penilaian_empat ELSE NULL END) AS kepuasan, 
        AVG(CASE WHEN r.kode_event IN (SELECT kode_event FROM tb_event) THEN r.penilaian_lima ELSE NULL END) AS rekomendasi 
    FROM tb_rating r";

                                    $sql = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($sql)) {

                                        $komunikasi = round($row['komunikasi'], 1);
                                        $perencanaan = round($row['perencanaan'], 1);
                                        $pelaksanaan = round($row['pelaksanaan'], 1);
                                        $kepuasan = round($row['kepuasan'], 1);
                                        $rekomendasi = round($row['rekomendasi'], 1);
                                    ?>

                                        <div class="col">
                                            <div class="row" style="padding: 0 10px 0 10px;">
                                                <div class="col" style="margin-bottom:.5rem;">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <h5 class=" font-weight-bold text-center" style="color:#FF7878; margin-top:1rem;">Average Komunikasi</h5>
                                                        <div class="row justify-content-center">
                                                            <span class="rating" style="font-size:50px;">
                                                                <?php echo $komunikasi; ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 30px; margin-top:19px; margin-left:4px"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="margin-bottom:.5rem;">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <h5 class=" font-weight-bold text-center" style="color:#FF7878; margin-top:1rem;">Average Perencanaan</h5>
                                                        <div class="row justify-content-center">
                                                            <span class="rating" style="font-size:50px;">
                                                                <?php echo $perencanaan; ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 40px; margin-top:26px; margin-left:4px"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="margin-bottom:.5rem;">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <h5 class=" font-weight-bold text-center" style="color:#FF7878; margin-top:1rem;">Average Pelaksanaan</h5>
                                                        <div class="row justify-content-center">
                                                            <span class="rating" style="font-size:50px;">
                                                                <?php echo $pelaksanaan; ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 30px; margin-top:19px; margin-left:4px"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="margin-bottom:.5rem;">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <h5 class=" font-weight-bold text-center" style="color:#FF7878; margin-top:1rem;">Average Kepuasan</h5>
                                                        <div class="row justify-content-center">
                                                            <span class="rating" style="font-size:50px;">
                                                                <?php echo $kepuasan; ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 30px; margin-top:19px; margin-left:4px"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="margin-bottom:.5rem;">
                                                    <div class="card border-0" style="background-color:#f8f9fc;">
                                                        <h5 class=" font-weight-bold text-center" style="color:#FF7878; margin-top:1rem;">Average Rekomendasi</h5>
                                                        <div class="row justify-content-center">
                                                            <span class="rating" style="font-size:50px;">
                                                                <?php echo $rekomendasi; ?>
                                                            </span>
                                                            <i class="fas fa-star text-warning" style="font-size: 30px; margin-top:19px; margin-left:4px"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col" style="margin-top: 1rem;">
                            <div class="card border-0">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-header">
                                            <h5 class="font-weight-bold text-center" style="color:#FF7878;margin-bottom:0rem">Rating and Review Client</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group">
                                                <?php
        
                                                // Fungsi untuk menghasilkan warna berdasarkan nama
                                                function generateColorFromName($name)
                                                {
                                                    // Mengambil hash dari nama untuk mendapatkan warna yang konsisten
                                                    $hash = md5($name);
        
                                                    // Mengambil 6 karakter pertama dari hash untuk menghasilkan kode warna heksadesimal
                                                    $color = substr($hash, 0, 6);
        
                                                    // Menambahkan tanda '#' di depan untuk menjadi format warna heksadesimal yang valid
                                                    return '#' . $color;
                                                }
        
                                                $query = "
        WITH LatestData AS (
            SELECT 
                kode_event, 
                MIN(id_rating) AS id_rating_pertama
            FROM tb_rating
            GROUP BY kode_event
        )
        SELECT 
            SUM(r.penilaian_satu + r.penilaian_dua + r.penilaian_tiga + r.penilaian_empat + r.penilaian_lima) / 
            (COUNT(r.penilaian_satu) + COUNT(r.penilaian_dua) + COUNT(r.penilaian_tiga) + COUNT(r.penilaian_empat) + COUNT(r.penilaian_lima)) AS bintang, 
            r.id_rating, 
            r.nama_reviewer, 
            r.notlp_reviewer, 
            r.tgl_review, 
            r.komentar_reviewer,
            r.email_reviewer,
            r.kode_event AS kode_rating,
            e.kode_event AS kode_event,
            e.hari_tgl,
            e.jenis_event,
            e.waktu_mulaiacara,
            e.waktu_selesaiacara,
            e.lokasi_event,
            e.arealokasi_event,
            CASE 
                WHEN l.id_rating_pertama = r.id_rating THEN 'lama'
                ELSE 'baru'
            END AS status_data
        FROM tb_rating r
        LEFT JOIN tb_event e ON r.kode_event = e.kode_event
        LEFT JOIN LatestData l ON r.kode_event = l.kode_event
        GROUP BY r.tgl_review
        ORDER BY r.tgl_review DESC";
        
                                                $sql = mysqli_query($conn, $query);
        
                                                $html = '';
        
                                                if ($sql->num_rows > 0) {
        
                                                    $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
                                                    while ($row = mysqli_fetch_assoc($sql)) {
                                                        $idRating = $row['id_rating'];
                                                        $kodeEvent = $row['kode_event'];
                                                        $namaR = ucwords($row['nama_reviewer']);
                                                        $initials = '';
                                                        $nameParts = explode(' ', $namaR);
                                                        foreach ($nameParts as $part) {
                                                            $initials .= strtoupper(substr($part, 0, 1));
                                                        }
        
                                                        $bgColor = generateColorFromName($namaR);
        
                                                        $notlpR = $row['notlp_reviewer'];
                                                        $tglR = date('d M Y H:i', strtotime($row['tgl_review']));
                                                        $komenR = $row['komentar_reviewer'];
                                                        $lokasi = ucwords($row['lokasi_event']);
                                                        $areaLokasi = ucwords($row['arealokasi_event']);
                                                        
        
                                                        $tanggal = strtotime($row['hari_tgl']);
                                                        $hariTgl = $hari[date('w', $tanggal)] . ', ' . date('d', $tanggal) . ' ' . $bulan[date('n', $tanggal) - 1] . ' ' . date('Y', $tanggal);
        
                                                        $waktuMulai = isset($row['waktu_mulaiacara']) ? date('H:i', strtotime($row['waktu_mulaiacara'])) : 'N/A';
                                                        $waktuSelesai = isset($row['waktu_selesaiacara']) ? date('H:i', strtotime($row['waktu_selesaiacara'])) : 'N/A';
        
                                                        // Periksa apakah ID Event ada di tb_event
                                                        if (empty($row['kode_event'])) {
                                                            $alertMessage = '<div class="alert alert-danger">
                                        <p style="margin-bottom:0rem;">ID Event Tidak Ditemukan : ' . htmlspecialchars($kodeEvent) . '</p>
                                        <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
                                        <p style="margin-bottom:0rem;">Data event tidak ada</p>
                                     </div>';
                                                        } elseif ($row['status_data'] === 'lama') {
                                                            $alertMessage = '<div class="alert alert-success">
                                        <p style="margin-bottom:0rem;">ID Event Sesuai : ' . htmlspecialchars($kodeEvent) . '</p>
                                        <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
                                        <p style="margin-bottom:0rem;">Event : ' . htmlspecialchars($hariTgl) . ' - ' . htmlspecialchars($row['jenis_event']) . '</p>
                                        <p style="margin-bottom:0rem;">Waktu Acara : ' . htmlspecialchars($waktuMulai) . ' - ' . htmlspecialchars($waktuSelesai) . '</p>
                                        <p style="margin-bottom:0rem;">Lokasi : ' . htmlspecialchars($lokasi) . ', ' . htmlspecialchars($areaLokasi) . '</p>
                                     </div>';
                                                        } else {
                                                            $alertMessage = '<div class="alert alert-danger">
                                        <p style="margin-bottom:0rem;">ID Event Tidak Sesuai : ' . htmlspecialchars($kodeEvent) . '</p>
                                        <hr style="margin-top:0.5rem; margin-bottom:0.5rem;">
                                        <p style="margin-bottom:0rem;">ID Event ini sudah ada sebelumnya</p>
                                     </div>';
                                                        }
        
        
                                                        $html .= '<div>';
                                                        $html .= '<div class="col-12" style="margin-top:.5rem; padding: 0 3rem 0 3rem;">';
        
                                                        $html .= '<div class="row justify-content-between">';
                                                        $html .= '<div class="d-flex align-items-center mb-3">';
                                                        $html .= '<div class="profile-circle" style="height: 50px; width: 50px; background-color: ' . $bgColor . ';">' . $initials . '</div>';
                                                        $html .= '<h4 style="margin-bottom:0px; margin-left:10px;"><span>' . htmlspecialchars($namaR) . '</span></h4>';
                                                        $html .= '</div>';
                                                        $html .= '<a href="formubah-rating.php?update=' . $idRating . '" class="btn btn-warning" style="font-size: 15px; margin-top:3px; margin-bottom:1.5rem;"><i class="bi-pencil-fill"></i></a>';
                                                        $html .= '</div>';
        
                                                        $html .= '<small style="margin-bottom: 0;">';
                                                        $html .= '<div class="icon-section text-warning" id="section-' . htmlspecialchars($row['id_rating']) . '" style="margin-bottom:2px;"></div>';
                                                        $html .= '</small>';
        
                                                        $html .= '<p class="card-text">' . htmlspecialchars($komenR) . '</p>';
                                                        $html .= $alertMessage; // Tambahkan alert di bawah komentar
                                                        $html .= '<small>' . htmlspecialchars($tglR) . '</small>';
                                                        $html .= '</div>';
                                                        $html .= '</div>';
        
        
                                                        $html .= '<hr style="width: 100%;">';
                                                    }
                                                } else {
                                                    $html = '<div class="col-12"><div class=" text-center alert alert-info">Belum ada rating penilaian.</div></div>';
                                                }
                                                $conn->close();
        
                                                $id_data = [];
                                                $bintangCount = [];
        
                                                foreach ($sql as $row) {
                                                    $id_data[] = $row['id_rating'];
                                                    $bintangCount[] = round($row['bintang']);
                                                }
        
                                                $id_data_json = json_encode($id_data);
                                                $bintangCount_json = json_encode($bintangCount);
                                                ?>
        
                                                <?php echo $html; ?>
        
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->

    <script src="js/script.js"></script>

    <script>
        const sections = <?php echo $id_data_json; ?>;
        const bintangCount = <?php echo $bintangCount_json; ?>;

        function displayIcons(sections, bintangCount) {
            sections.forEach((sectionId, index) => {
                const bintangContainer = document.getElementById(`section-${sectionId}`);

                for (let i = 0; i < bintangCount[index]; i++) {
                    const newIcon = document.createElement("i");
                    newIcon.className = "fas fa-star";
                    bintangContainer.appendChild(newIcon);
                }
            });
        }

        displayIcons(sections, bintangCount);
    </script>
</body>

</html>