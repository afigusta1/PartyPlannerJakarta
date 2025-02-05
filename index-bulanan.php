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

// FUNCTION UNTUK BAR CHART BULANAN //

// Ambil tahun dari parameter URL, jika tidak ada, default ke tahun ini
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Query untuk mendapatkan semua tahun unik dari data event
$queryYears = "SELECT DISTINCT YEAR(hari_tgl) as year FROM tb_event ORDER BY year DESC";
$resultYears = mysqli_query($conn, $queryYears);
$years = [];

while ($row = mysqli_fetch_assoc($resultYears)) {
    $years[] = $row['year']; // Menyimpan daftar tahun ke dalam array
}

// Query data event per bulan berdasarkan tahun yang dipilih
function getDataByMonth($conn, $year, $month)
{
    $query = "SELECT * FROM `tb_event` WHERE DATE_FORMAT(hari_tgl, '%Y-%m') = '$year-$month';";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

// Data bulanan untuk tahun yang dipilih
$monthlyData = [];
for ($i = 1; $i <= 12; $i++) {
    $month = str_pad($i, 2, '0', STR_PAD_LEFT); // Format bulan jadi 2 digit
    $monthlyData[] = getDataByMonth($conn, $selectedYear, $month);
}

// // // // // // // // // // // // //

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link href="css/bintang.css" rel="stylesheet"> -->

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
            padding: 1px;
            width: 100%;
            overflow: auto;
            border: none;
        }

        .dropbtn {
            background-color: #ff9a8aff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 87px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content a {
            color: black;
            padding: 6px 11px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ffefec;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #ff7964;
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
            margin-right: 0.5rem;
            display: flex;
            align-items: center;
            column-gap: 0.4rem;
            height: 2rem;
            justify-content: end;
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
            <li class="nav-item active" style="margin:.5rem; border-radius: 6px; background-color:#ff9a8aff">
                <a class="nav-link" href="index.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-house-door-fill" style="font-size: 1.2rem; "></i>
                    <span style="font-weight:bold; font-size:14px">Dashboard</span>
                </a>
            </li>



            <!-- Menu Events -->
            <li class="nav-item" style="margin:.5rem; border-radius: 6px;">
                <a class="nav-link" href="events.php" style="width:auto; padding:0.5rem;">
                    <i class="bi-calendar-check" style="font-size: 1.2rem; color:#ff9a8aff"></i>
                    <span style="font-size:14px; font-weight: bold; color:#ff9a8aff">Event</span>
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

                    <h1 class="h3 mb-0 text-800" style="color:#FF7878; font-weight:bold">Dashboard</h1>

                    <!-- Topbar Navbar -->
                    <!-- Nav Item - Messages -->
                    <ul class="navbar-nav ml-auto" style="flex-direction:row">
                        <li class="nav dropdown no-arrow mx-1">
                            <button class="btn rounded-circle" style="padding: 0;" data-toggle="modal" data-target="#Modal" data-toggle="tooltip" data-placement="bottom" title="Informasi">
                                <i class="bi bi-info-circle-fill" style="color:#ff7878; font-size:1.5rem"></i>
                            </button>
                            <!-- Counter - Messages -->
                            <div class="modal" id="Modal">
                                <div class="modal-dialog" style="max-width:1133px;">
                                    <div class="modal-content">
                                        <div class="modal-header border-0" style="background-color:#ff9a8aff">
                                            <h5 class="modal-title text-white" style="font-weight:bold">INFORMASI</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="color:white">×</span>
                                            </button>
                                        </div>
                                        <div class="card-body" style="padding-left:1rem; padding:0;" id="body">

                                            <div style="margin-left:20px; margin-top:22px; margin-right:20px;">

                                                <div class="row justify-content-center">
                                                    <h2 class="text-center" style="font-weight: bold; color:black">Laporan Kinerja Bisnis Tahun <?php $year = date("Y");
                                                                                                                                                echo $year; ?></h2>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <span class="text-center" style="margin-bottom:.9rem">Analisis KPI Event dan Performa Tahunan</span>
                                                </div>

                                                <div class="row" style="margin-bottom:1rem; margin-right:0rem; margin-left:0rem;">
                                                    <div class="col mb-4">
                                                        <div class="card border-0 shadow" style="background-color:#a1ccd1; color:white;">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="text-center font-weight-bold text-uppercase" style="margin-bottom:.9rem;">Total Event</div>
                                                                        <div class="h3 text-center font-weight-bold"><i class="bi bi-calendar-event-fill"></i>
                                                                            <?php
                                                                            $totalModEvents = mysqli_query($conn, "SELECT * FROM tb_event
                                                                                                    WHERE YEAR(hari_tgl) = YEAR(CURDATE())");
                                                                            echo mysqli_num_rows($totalModEvents);
                                                                            ?>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-4">
                                                        <div class="card border-0 shadow" style="background-color:#B5CDA3; color:white;">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="text-center font-weight-bold text-uppercase" style="margin-bottom:.9rem;">Total Client</div>
                                                                        <div class="h3 text-center font-weight-bold"><i class="bi bi-people-fill"></i>
                                                                            <?php
                                                                            $totalModClients = mysqli_query($conn, "SELECT DISTINCT nama_client FROM tb_event
                                                                                                    WHERE YEAR(hari_tgl) = YEAR(CURDATE())");
                                                                            echo mysqli_num_rows($totalModClients);
                                                                            ?>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-4">
                                                        <div class="card border-0 shadow" style="background-color:#EEC373; color:white;">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="text-center font-weight-bold text-uppercase" style="margin-bottom:.9rem;">Kepuasan Client</div>
                                                                        <div class="h3 text-center font-weight-bold"><i class="bi bi-star-fill"></i>
                                                                            <?php
                                                                            $sql = mysqli_query($conn, "SELECT SUM(penilaian_satu + penilaian_dua + penilaian_tiga + penilaian_empat + penilaian_lima) / 
                                                                                                (COUNT(penilaian_satu) + COUNT(penilaian_dua) + COUNT(penilaian_tiga) + COUNT(penilaian_empat) + COUNT(penilaian_lima))
                                                                                        AS total FROM tb_rating WHERE YEAR(tgl_review) = YEAR(CURDATE());");
                                                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                                                $totalModKepuasan = round($row['total'], 1);

                                                                                echo $totalModKepuasan;
                                                                            }
                                                                            ?>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php

                                                $sql = mysqli_query($conn, "SELECT YEAR(hari_tgl) AS tahun, COUNT(*) AS jumlah_event
                                FROM tb_event
                                GROUP BY YEAR(hari_tgl)
                                ORDER BY tahun DESC
                                ");

                                                $data = [];

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    $data[] = $row;
                                                }

                                                // Hitung persentase perubahan antara tahun-tahun sebelumnya
                                                function calculate_change($current, $previous)
                                                {
                                                    if ($previous == 0) {
                                                        return "N/A"; // Hindari pembagian dengan nol
                                                    }
                                                    $change = (($current - $previous) / $previous) * 100;
                                                    return round($change, 1);
                                                }

                                                // Mengambil data yang tersedia, maksimal 3 tahun terakhir
                                                $available_years = count($data);
                                                $filtered_events = array_slice($data, 0, min(3, $available_years));

                                                // Mengambil jumlah event dari tahun sebelumnya (tahun ke-4)
                                                $previous_year_event = $available_years > 3 ? $data[3]['jumlah_event'] : 0;
                                                ?>

                                                <div class="row justify-content-center" style="margin-bottom:1rem;">
                                                    <div class="col">
                                                        <div class="card border-0" style="margin: 5px 0px 5px 0px; box-shadow: 0px 1px 30px rgba(0, 0, 0, 0.1);">
                                                            <div class="row justify-content-center" style="border-radius: 5px;">
                                                                <h5 style="margin-top:0rem; margin-top:.5rem; font-weight:bold;">Data KPI Event per Tahun</h5>
                                                            </div>
                                                            <div class="row justify-content-center">
                                                                <div class="col">
                                                                    <ul class="list-group">

                                                                        <?php
                                                                        // Cek jika data event kosong
                                                                        if (empty($data)) {
                                                                            echo '<li class="list-group-item border-0 text-center" style="border-radius:0px; padding:0;">
                                                                    <span>Belum terdapat data event sampai saat ini</span>
                                                                </li>';
                                                                        } else {
                                                                            // Loop melalui data dan tampilkan hasilnya jika data ada
                                                                            for ($i = 0; $i < count($filtered_events); $i++) {
                                                                                $tahun = $filtered_events[$i]['tahun'];
                                                                                $jumlah_event = $filtered_events[$i]['jumlah_event'];
                                                                                $current_year = date("Y"); // Mendapatkan tahun saat ini

                                                                                // Untuk tahun pertama, gunakan jumlah event dari tahun ke-4 jika ada
                                                                                $previous_event = ($i == 2 && $available_years > 3) ? $previous_year_event : $filtered_events[$i + 1]['jumlah_event'] ?? 0;

                                                                                $status = "";
                                                                                $status_class = "";
                                                                                $change = calculate_change($jumlah_event, $previous_event);

                                                                                // Tentukan status berdasarkan perbandingan
                                                                                if ($change > 0) {
                                                                                    $status = "Meningkat";
                                                                                    $statusChange = "+" . $change . "%";
                                                                                    $ketClass = "up";
                                                                                    $keterangan = "Tahun ini, jumlah event yang telah dikerjakan mengalami peningkatan dibandingkan tahun sebelumnya";
                                                                                } elseif ($change < 0) {
                                                                                    $status = "Menurun";
                                                                                    $statusChange = $change . "%";
                                                                                    $ketClass = "down";
                                                                                    $keterangan = "Tahun ini, jumlah event yang telah dikerjakan mengalami penurunan dibandingkan tahun sebelumnya";
                                                                                } else {
                                                                                    $status = "Mencapai Target";
                                                                                    $statusChange = "" . $change . "";
                                                                                    $ketClass = "equal";
                                                                                    $keterangan = "Tahun ini, jumlah event yang telah dikerjakan sudah mencapai target atau sama dengan tahun sebelumnya";
                                                                                }

                                                                                // Tampilkan card dengan kalimat gabungan
                                                                                echo '<li class="list-group-item d-flex justify-content-between align-items-center" style="border-radius:0px; padding:.5rem 0 .5rem 0;">
                                                                    <div class="col" style="text-align:center;">
                                                                        <span>Jumlah Event ' . $tahun . '</span>
                                                                        <h5 style="margin-top:.5rem; font-weight:bold;">' . $jumlah_event . '</h4>
                                                                    </div>
                                                                    <div class="col" style="text-align:center;">
                                                                        <h5 class="' . $ketClass . '">' . $statusChange . '</h4>
                                                                        <span>' . $status . '</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <span>' . $keterangan . '</span>
                                                                    </div>
                                                                </li>';

                                                                                // Cek apakah tahun ini adalah tahun saat ini, untuk menampilkan alert
                                                                                if ($tahun == $current_year) {
                                                                                    $current_status = $status; // Simpan status untuk alert setelah list-group
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                if (isset($current_status)) {
                                                    echo '<div class="row justify-content-center">
                                    <div class="alert alert-' . ($current_status == "Meningkat" ? 'success' : ($current_status == "Menurun" ? 'danger' : 'warning')) . '" role="alert" style="width:88%;">
                                        <p><strong>Keterangan: Jumlah event tahun ini telah <b class="text-uppercase">' . $current_status . '</b>.</strong></p>
                                        <p><strong>Saran:</strong></p>';
                                                    if ($current_status == "Meningkat") {
                                                        echo '<ul>
                                        <li>Evaluasi strategi sukses.</li>
                                        <li>Perkuat relasi klien.</li>
                                        <li>Tambahkan layanan baru.</li>
                                        <li>Optimalkan kapasitas operasional.</li>
                                    </ul>';
                                                    } elseif ($current_status == "Menurun") {
                                                        echo '<ul>
                                        <li>Analisis penyebab penurunan.</li>
                                        <li>Reevaluasi strategi pemasaran.</li>
                                        <li>Tinjau kembali harga dan paket layanan.</li>
                                        <li>Fokus pada inovasi layanan.</li>
                                        <li>Jangkau pasar baru.</li>
                                    </ul>';
                                                    } else {
                                                        echo '<ul>
                                        <li>Pertahankan kualitas layanan.</li>
                                        <li>Tingkatkan branding dan visibilitas.</li>
                                        <li>Eksplorasi inovasi ringan.</li>
                                        <li>Diversifikasi layanan.</li>
                                        <li>Perkuat hubungan dengan klien.</li>
                                    </ul>';
                                                    }
                                                    echo '
                                    </div>
                                </div>';
                                                }
                                                ?>




                                                <?php
                                                function tentukanStatus($jumlah_event_periode1, $jumlah_event_periode2, $rata_kepuasan_periode1, $rata_kepuasan_periode2)
                                                {
                                                    if ($jumlah_event_periode2 > $jumlah_event_periode1) {
                                                        if ($rata_kepuasan_periode2 > $rata_kepuasan_periode1 || $rata_kepuasan_periode2 == $rata_kepuasan_periode1) {
                                                            return 'Meningkat';
                                                        } else {
                                                            return 'Menurun';
                                                        }
                                                    } elseif ($jumlah_event_periode2 == $jumlah_event_periode1) {
                                                        if ($rata_kepuasan_periode2 > $rata_kepuasan_periode1) {
                                                            return 'Meningkat';
                                                        } elseif ($rata_kepuasan_periode2 == $rata_kepuasan_periode1) {
                                                            return 'Tetap';
                                                        } else {
                                                            return 'Menurun';
                                                        }
                                                    } else { // $jumlah_event_periode2 < $jumlah_event_periode1
                                                        if ($rata_kepuasan_periode2 > $rata_kepuasan_periode1) {
                                                            return 'Tetap';
                                                        } elseif ($rata_kepuasan_periode2 == $rata_kepuasan_periode1) {
                                                            return 'Menurun';
                                                        } else {
                                                            return 'Menurun';
                                                        }
                                                    }
                                                }

                                                $sql = mysqli_query($conn, "SELECT tb_event.arealokasi_event,
                                        SUM(CASE WHEN YEAR(tb_event.hari_tgl) = YEAR(CURDATE()) - 1 THEN 1 ELSE 0 END) AS jumlah_event_periode1,
                                        SUM(CASE WHEN YEAR(tb_event.hari_tgl) = YEAR(CURDATE()) THEN 1 ELSE 0 END) AS jumlah_event_periode2,
                                        AVG(CASE WHEN YEAR(tb_event.hari_tgl) = YEAR(CURDATE()) - 1 THEN r1.penilaian_empat ELSE NULL END) AS rata_kepuasan_periode1,
                                        AVG(CASE WHEN YEAR(tb_event.hari_tgl) = YEAR(CURDATE()) THEN r2.penilaian_empat ELSE NULL END) AS rata_kepuasan_periode2
                                    FROM tb_event
                                    LEFT JOIN tb_rating r1 ON tb_event.kode_event = r1.kode_event AND YEAR(tb_event.hari_tgl) = YEAR(CURDATE()) - 1
                                    LEFT JOIN tb_rating r2 ON tb_event.kode_event = r2.kode_event AND YEAR(tb_event.hari_tgl) = YEAR(CURDATE())
                                    WHERE YEAR(tb_event.hari_tgl) IN (YEAR(CURDATE()) - 1, YEAR(CURDATE()))
                                    GROUP BY tb_event.arealokasi_event");

                                                $kpi_data = [];
                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    // Tentukan status berdasarkan jumlah event
                                                    $jumlah_event_periode1 = $row['jumlah_event_periode1'];
                                                    $jumlah_event_periode2 = $row['jumlah_event_periode2'];
                                                    $rata_kepuasan_periode1 = $row['rata_kepuasan_periode1'];
                                                    $rata_kepuasan_periode2 = $row['rata_kepuasan_periode2'];

                                                    // Panggil fungsi untuk menentukan status
                                                    $status = tentukanStatus($jumlah_event_periode1, $jumlah_event_periode2, $rata_kepuasan_periode1, $rata_kepuasan_periode2);

                                                    // Tambahkan keterangan sesuai kondisi
                                                    if ($row['jumlah_event_periode2'] > $row['jumlah_event_periode1']) {
                                                        if ($row['rata_kepuasan_periode2'] > $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini lebih besar dari tahun sebelumnya dan rata-rata kepuasan tahun ini lebih besar dari tahun sebelumnya";
                                                        } elseif ($row['rata_kepuasan_periode2'] == $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini lebih besar dari tahun sebelumnya dan rata-rata kepuasan tahun ini tetap atau sama dengan tahun sebelumnya";
                                                        } else {
                                                            $keterangan = "Jumlah event tahun ini lebih besar dari tahun sebelumnya dan rata-rata kepuasan tahun ini lebih kecil dari tahun sebelumnya";
                                                        }
                                                    } elseif ($row['jumlah_event_periode2'] == $row['jumlah_event_periode1']) {
                                                        if ($row['rata_kepuasan_periode2'] > $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini tetap atau sama dengan tahun sebelumnya dan rata-rata kepuasan tahun ini lebih besar dari tahun sebelumnya";
                                                        } elseif ($row['rata_kepuasan_periode2'] == $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini tetap atau sama dengan tahun sebelumnya dan rata-rata kepuasan tahun ini tetap atau sama dengan tahun sebelumnya";
                                                        } else {
                                                            $keterangan = "Jumlah event tahun ini tetap atau sama dengan tahun sebelumnya dan rata-rata kepuasan tahun ini lebih kecil dari tahun sebelumnya";
                                                        }
                                                    } else {
                                                        if ($row['rata_kepuasan_periode2'] > $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini lebih kecil dari tahun sebelumnya dan rata-rata kepuasan tahun ini lebih besar dari tahun sebelumnya";
                                                        } elseif ($row['rata_kepuasan_periode2'] == $row['rata_kepuasan_periode1']) {
                                                            $keterangan = "Jumlah event tahun ini lebih kecil dari tahun sebelumnya dan rata-rata kepuasan tahun ini tetap atau sama dengan tahun sebelumnya";
                                                        } else {
                                                            $keterangan = "Jumlah event tahun ini lebih kecil dari tahun sebelumnya dan rata-rata kepuasan tahun ini lebih kecil dari tahun sebelumnya";
                                                        }
                                                    }

                                                    $row['status'] = $status;
                                                    $row['keterangan'] = $keterangan;
                                                    $kpi_data[] = $row;
                                                }

                                                // Urutkan berdasarkan kepuasan tertinggi periode 2
                                                usort($kpi_data, function ($a, $b) {
                                                    return $b['rata_kepuasan_periode2'] <=> $a['rata_kepuasan_periode2'];
                                                });

                                                // Ambil top 3
                                                $top_3_areas = array_slice($kpi_data, 0, 3);

                                                // Menyusun saran berdasarkan status
                                                $saran = [
                                                    'Meningkat' => [
                                                        "Optimalkan Sumber Daya: Pastikan tim, venue, dan logistik siap untuk menangani volume event yang lebih tinggi.",
                                                        "Tingkatkan Engagement: Tawarkan pengalaman baru di setiap event, seperti teknologi interaktif, tema yang lebih kreatif, atau layanan tambahan.",
                                                        "Diversifikasi Event: Jika event terus meningkat, coba eksplorasi tipe event baru (misalnya, festival musik, konferensi, atau acara amal) yang mungkin sesuai dengan area tersebut.",
                                                        "Perkuat Hubungan dengan Klien: Manfaatkan momentum untuk mempererat hubungan dengan klien yang ada dan menawarkan paket atau diskon untuk event berikutnya.",
                                                        "Kolaborasi dengan Sponsor: Cari sponsor tambahan untuk mendukung pertumbuhan event dan meningkatkan pendapatan dari pihak ketiga.",
                                                        "Tingkatkan Promosi: Kembangkan strategi pemasaran digital dan media sosial yang lebih agresif untuk menjangkau audiens yang lebih luas.",
                                                        "Kembangkan Mitra Lokal: Bangun kemitraan dengan bisnis lokal untuk memperluas jaringan dan memperkuat penawaran event.",
                                                        "Evaluasi Harga: Dengan meningkatnya permintaan, pertimbangkan untuk meninjau ulang harga layanan atau event."
                                                    ],
                                                    'Menurun' => [
                                                        "Lakukan Riset Pasar: Analisis ulang target pasar di area ini. Apakah ada perubahan demografi, kebutuhan, atau preferensi yang memengaruhi jumlah event?",
                                                        "Tinjau Ulang Pemasaran: Tinjau kembali strategi pemasaran. Mungkin perlu pendekatan baru, seperti kampanye lebih spesifik untuk segmen audiens tertentu atau melalui media yang lebih efektif.",
                                                        "Perbaiki Kualitas Layanan: Cek apakah ada masalah dengan kualitas layanan yang diberikan. Misalnya, apakah klien atau peserta event merasa puas? Apakah ada masalah operasional yang perlu diperbaiki?",
                                                        "Rebranding Event: Pertimbangkan untuk merubah konsep atau tema event agar lebih relevan dengan tren pasar terbaru.",
                                                        "Strategi Diskon atau Insentif: Berikan diskon atau penawaran khusus untuk menarik kembali klien lama atau menarik klien baru di area tersebut.",
                                                        "Kembangkan Program Loyalitas: Bangun program loyalitas untuk menjaga klien yang ada agar terus menggunakan layanan Anda, seperti memberikan bonus untuk event kedua atau ketiga.",
                                                        "Amankan Testimoni Positif: Kumpulkan testimoni dari event yang sukses dan gunakan sebagai alat pemasaran untuk menunjukkan kualitas dan menarik klien baru.",
                                                        "Reevaluasi Lokasi Event: Jika memungkinkan, pertimbangkan untuk mengganti atau menambah venue event di area yang menurun guna meningkatkan daya tarik."
                                                    ],
                                                    'Tetap' => [
                                                        "Audit Efisiensi Operasional: Periksa apakah ada area operasional yang bisa lebih efisien sehingga Anda bisa mempertahankan stabilitas sambil meningkatkan margin keuntungan.",
                                                        "Cari Peluang Pertumbuhan Baru: Analisis apakah ada peluang pasar baru yang belum digarap, seperti segmen industri atau jenis event tertentu yang bisa berkembang.",
                                                        "Tingkatkan Nilai Event: Coba tambahkan fitur baru atau peningkatan kualitas, seperti dekorasi lebih menarik, pembicara lebih terkenal, atau hiburan tambahan untuk meningkatkan pengalaman peserta.",
                                                        "Uji Pendekatan Baru: Uji coba perubahan kecil dalam penyelenggaraan event atau cara promosi untuk melihat apakah bisa memancing peningkatan partisipasi atau klien baru.",
                                                        "Perkuat Relasi dengan Klien Setia: Buat hubungan yang lebih kuat dengan klien yang setia dengan memberikan layanan yang lebih personal atau penawaran khusus untuk mereka.",
                                                        "Optimalkan Feedback: Dapatkan feedback lebih mendalam dari peserta event dan gunakan untuk memperbaiki aspek yang kurang terlihat selama ini.",
                                                        "Analisis Tren Kompetitor: Bandingkan dengan kompetitor di area yang sama. Pelajari apa yang mereka lakukan untuk meningkatkan jumlah event dan apakah ada yang bisa diterapkan.",
                                                        "Segmentasi Pasar Lebih Dalam: Lakukan segmentasi lebih detail pada target audiens untuk melihat apakah ada segmen yang belum ditargetkan secara optimal.",
                                                        "Lakukan Penilaian Jangka Panjang: Jika area tetap stabil dalam jangka panjang, periksa apakah ada risiko stagnasi yang bisa dicegah dengan perubahan strategis."
                                                    ]
                                                ];

                                                // Mengambil saran yang sudah disimpan dalam sesi jika tersedia
                                                if (isset($_SESSION['saran'])) {
                                                    $grouped_saran = $_SESSION['saran'];
                                                } else {
                                                    // Mengelompokkan saran berdasarkan status area
                                                    $grouped_saran = [];
                                                    foreach (['Meningkat', 'Menurun', 'Tetap'] as $status) {
                                                        if (in_array($status, array_column($kpi_data, 'status'))) {
                                                            $grouped_saran[$status] = pilihSaranAcak($saran[$status]);
                                                        }
                                                    }
                                                    // Simpan saran yang dihasilkan dalam sesi
                                                    $_SESSION['saran'] = $grouped_saran;
                                                }

                                                // Fungsi untuk memilih 3 saran acak
                                                function pilihSaranAcak($saran_list)
                                                {
                                                    shuffle($saran_list); // Mengacak daftar saran
                                                    return array_slice($saran_list, 0, 3); // Mengambil 3 saran acak
                                                }

                                                ?>

                                                <div class="row justify-content-center" style="margin-bottom:1rem;">
                                                    <div class="col">
                                                        <div class="card border-0" style="margin: 5px 0px 5px 0px; box-shadow: 0px 1px 30px rgba(0, 0, 0, 0.1);">
                                                            <h5 class="text-center" style="margin-top:.5rem; font-weight:bold">Data KPI Event per Area</h5>
                                                            <div class="table-responsive">
                                                                <table class="table table-hover small">
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th>Area Lokasi</th>
                                                                            <th>Jumlah Event (Tahun Sebelumnya)</th>
                                                                            <th>Jumlah Event (Tahun Ini)</th>
                                                                            <th>Rata-rata Kepuasan (Tahun Sebelumnya)</th>
                                                                            <th>Rata-rata Kepuasan (Tahun Ini)</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if (empty($kpi_data)): ?>
                                                                            <!-- Jika tidak ada data, tampilkan pesan dalam tabel -->
                                                                            <tr>
                                                                                <td colspan="6" class="text-center">Belum terdapat data event sampai saat ini.</td>
                                                                            </tr>
                                                                        <?php else: ?>
                                                                            <!-- Jika ada data, tampilkan baris data KPI -->
                                                                            <?php foreach ($kpi_data as $data): ?>
                                                                                <tr class="text-center">
                                                                                    <td><?= ucwords($data['arealokasi_event']) ?></td>
                                                                                    <td><?= $data['jumlah_event_periode1'] ?></td>
                                                                                    <td><?= $data['jumlah_event_periode2'] ?></td>
                                                                                    <td><?= number_format($data['rata_kepuasan_periode1'], 1) ?></td>
                                                                                    <td><?= number_format($data['rata_kepuasan_periode2'], 1) ?></td>
                                                                                    <td class="<?= $data['status'] === 'Meningkat' ? 'up' : ($data['status'] === 'Menurun' ? 'down' : 'equal') ?>">
                                                                                        <?= $data['status'] ?>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <?php foreach ($top_3_areas as $area): ?>
                                                        <div class="col" style="margin-bottom:1rem;">
                                                            <div class="card border-0" style="padding:20px; box-shadow: 0px 1px 30px rgba(0, 0, 0, 0.1);">
                                                                <h5>KPI Area <?= $area['arealokasi_event'] ?></h5>
                                                                <p>Status: <span class="<?= $area['status'] === 'Meningkat' ? 'up' : ($area['status'] === 'Menurun' ? 'down' : 'equal') ?>">
                                                                        <?= $area['status'] ?>
                                                                    </span></p>
                                                                <p>Jumlah Event (Tahun Ini): <?= $area['jumlah_event_periode2'] ?></p>
                                                                <p>Rata-rata Kepuasan (Tahun Ini): <?= number_format($area['rata_kepuasan_periode2'], 2) ?></p>
                                                                <p style="margin-bottom:0rem;">Keterangan: <?= $area['keterangan'] ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <!-- Alert gabungan berdasarkan status area -->
                                                    <?php if (!empty($grouped_saran['Meningkat'])): ?>
                                                        <div class="alert alert-success" style="width:89%;">
                                                            <h4>Area Meningkat:</h4>
                                                            <ul>
                                                                <?php foreach ($grouped_saran['Meningkat'] as $saran): ?>
                                                                    <li><?php echo $saran; ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($grouped_saran['Menurun'])): ?>
                                                        <div class="alert alert-danger" style="width:89%;">
                                                            <h4>Area Menurun:</h4>
                                                            <ul>
                                                                <?php foreach ($grouped_saran['Menurun'] as $saran): ?>
                                                                    <li><?php echo $saran; ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($grouped_saran['Tetap'])): ?>
                                                        <div class="alert alert-warning" style="width:89%;">
                                                            <h4>Area Tetap:</h4>
                                                            <ul>
                                                                <?php foreach ($grouped_saran['Tetap'] as $saran): ?>
                                                                    <li><?php echo $saran; ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block" style="width: 0;border-right: 1px solid #c6c6c6;height: calc(4.375rem - 2rem);margin: auto 1rem;"></div>

                        <li class="nav dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="login.php" data-toggle="modal" data-target="#logoutModal" style="padding:0;" data-toggle="tooltip" data-placement="bottom" title="Logout">
                                <i class="bi-box-arrow-right" style="color:#ff7878; font-size:1.5rem"></i>
                            </a>
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

                    <!-- Button Tahunan / Bulanan -->
                    <div class="row" style="margin-bottom:1rem;">
                        <div class="col">
                            <div class="row justify-content-center">
                                <div class="card border-0" style="background-color:#ffefec">
                                    <div class="row justify-content-center">
                                        <a href="index.php" class="btn btn-sm" style="background-color:#fff; font-size: 14px">Tahunan</a>
                                        <a href="index-bulanan.php" class="btn btn-sm text-white" style="background-color:#ff9a8aff; font-size:14px">Bulanan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ======================================================================== Content Row - Earnings ======================================================================== -->
                    <div class="row" style="margin-top:1rem">

                        <!-- Total Events Tahun ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" style="border:0">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-uppercase mb-1" style="color:#A1CCD1">
                                                Total Event</div>
                                            <div class="h5 mb-0 font-weight-bold" style="margin-top:7px">
                                                <?php
                                                // Ambil tahun saat ini secara dinamis
                                                $currentYear = date('Y');

                                                // Query untuk mengambil total event berdasarkan tahun saat ini
                                                $totalevents = mysqli_query($conn, "SELECT * FROM `tb_event` WHERE DATE_FORMAT(hari_tgl, '%Y') = '$currentYear';");

                                                // Menampilkan jumlah event
                                                echo mysqli_num_rows($totalevents);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-calendar-event-fill fa-2x" style="color:#A1CCD1;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Clients Tahun ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" style="border:0">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-uppercase mb-1" style="color:#B5CDA3;">
                                                Total Client</div>
                                            <div class="h5 mb-0 font-weight-bold" style="margin-top:7px">
                                                <?php
                                                // Ambil tahun saat ini secara dinamis
                                                $currentYear = date('Y');

                                                // Query untuk mengambil total event berdasarkan tahun saat ini
                                                $totalclients = mysqli_query($conn, "SELECT DISTINCT `nama_client` FROM `tb_event` WHERE DATE_FORMAT(hari_tgl, '%Y') = '$currentYear';");

                                                // Menampilkan jumlah event
                                                echo mysqli_num_rows($totalclients);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-people-fill fa-2x" style="color:#B5CDA3;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Locations Tahun ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" style="border:0">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-uppercase mb-1" style="color:#EEC373;">
                                                Total Location</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold" style="margin-top:7px">
                                                        <?php
                                                        // Ambil tahun saat ini secara dinamis
                                                        $currentYear = date('Y');

                                                        // Query untuk mengambil total event berdasarkan tahun saat ini
                                                        $totalclients = mysqli_query($conn, "SELECT DISTINCT `lokasi_event` FROM `tb_event` WHERE DATE_FORMAT(hari_tgl, '%Y') = '$currentYear';");

                                                        // Menampilkan jumlah event
                                                        echo mysqli_num_rows($totalclients);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-geo-alt-fill fa-2x" style="color:#EEC373;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Akun Dashboard -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" style="border:0">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="margin-bottom:3px; margin-left:10px;">
                                            <span class="mr-2 d-lg-inline text-600" style="color:#FF7878; font-weight:bold; font-size: 22px;"><?php echo ucwords($_SESSION['nama']); ?></span>
                                            <div class="h6 mb-0 font-weight-bold" style="margin-top:7px"><?php echo $_SESSION['posisi']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-person-fill fa-2x" style="color:#FF7878;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- ======================================================================== Batas Content Row - Earnings ======================================================================== -->


                    <!-- ======================================================================== Content Row - Table ======================================================================== -->
                    <div class="row">
                        <!-- Bar Chart Data Bulanan Tahun ini -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card border-0 mb-4">
                                <!-- Card Body -->
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878;">Grafik Total Event</h6>
                                </div>
                                <div class="card-body" style="padding:0rem; padding-top:0.5rem; padding-left:1rem; padding-right:1rem; padding-bottom:2rem;">
                                    <div class="row justify-content-end" style="margin-right: 0rem;">
                                        <div class="dropdown" style="position: absolute;">
                                            <!-- Dropdown untuk memilih tahun -->
                                            <form method="GET" action="">
                                                <select class="form-select border-0" style="background-color:#FF9a8aff; color: white;" id="year" name="year" onchange="this.form.submit()">
                                                    <?php
                                                    // Loop untuk menampilkan semua tahun yang ditemukan di database
                                                    foreach ($years as $year) {
                                                        echo "<option value='$year' " . ($selectedYear == $year ? 'selected' : '') . ">$year</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="chart">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- List Grup All Event -->
                        <div class="col">
                            <div class="card border-0 mb-4">
                                <?php
                                // Array nama hari dan bulan dalam bahasa Indonesia
                                $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                // Query untuk mengambil event upcoming dari tahun saat ini
                                $query = "SELECT e.*, 
                                            p.nama_pic,
                                            CASE 
                                                WHEN CONCAT(e.hari_tgl, ' ', e.waktu_selesaiacara) >= NOW() AND e.hari_tgl = CURDATE() THEN 'ongoing' 
                                                WHEN CONCAT(e.hari_tgl, ' ', e.waktu_selesaiacara) >= NOW() THEN 'upcoming' 
                                                WHEN CONCAT(e.hari_tgl, ' ', e.waktu_selesaiacara) < NOW() THEN 'completed'
                                            END AS status 
                                        FROM tb_event e
                                        LEFT JOIN tb_pic p ON e.id_pic = p.id_pic
                                        WHERE YEAR(e.hari_tgl) = YEAR(CURDATE()) 
                                        AND (e.hari_tgl >= CURDATE() OR (e.hari_tgl = CURDATE() AND CONCAT(e.hari_tgl, ' ', e.waktu_selesaiacara) < NOW())) 
                                        ORDER BY e.hari_tgl ASC, e.waktu_mulaiacara ASC;";
                                $sql = mysqli_query($conn, $query);
                                // Array untuk menyimpan event upcoming
                                $data_upcoming = [];
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    // Format hari dan tanggal acara
                                    $tanggal = strtotime($row['hari_tgl']);
                                    $hariTgl = $hari[date('w', $tanggal)] . ', ' . date('d', $tanggal) . ' ' . $bulan[date('n', $tanggal) - 1] . ' ' . date('Y', $tanggal);
                                    // Menambahkan data ke array $data_upcoming untuk digunakan di frontend
                                    $row['hariTgl'] = $hariTgl;
                                    $data_upcoming[] = $row;
                                }
                                ?>
                                <!-- Card Body -->
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878">Update Event</h6>
                                </div>
                                <div class="card-body" style="height:454px; padding:2px;">
                                    <div id="overflowTest" class="list-group">
                                        <?php if (!empty($data_upcoming)): ?>
                                            <?php foreach ($data_upcoming as $row): ?>
                                                <div class="list-group-item border-0">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-0" style="color:#a1ccd1; font-weight:bold"><?php echo $row['hariTgl']; ?></h6>
                                                        <small><?php echo date('H:i', strtotime($row['waktu_mulaiacara'])); ?> - <?php echo date('H:i', strtotime($row['waktu_selesaiacara'])); ?></small>
                                                    </div>
                                                    <p class="mb-0"><?php echo ucwords($row['nama_pic']); ?> - <?php echo ucwords($row['tema_event']); ?> - <?php echo ucwords($row['lokasi_event']); ?>, <?php echo $row['arealokasi_event']; ?></p>
                                                    <!-- Menampilkan status dengan warna yang sesuai -->
                                                    <?php if ($row['status'] == 'ongoing'): ?>
                                                        <p class="mb-0" style="color:orange; font-weight:bold;">Ongoing</p>
                                                    <?php elseif ($row['status'] == 'upcoming'): ?>
                                                        <p class="mb-0" style="color:blue; font-weight:bold;">Upcoming</p>
                                                    <?php elseif ($row['status'] == 'completed'): ?>
                                                        <p class="mb-0" style="color:green; font-weight:bold;">Completed</p>
                                                    <?php endif; ?>
                                                    <hr style=" margin-bottom: 0rem;">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-center">Tidak ada acara yang akan datang</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ======================================================================== Content Row - Table ======================================================================== -->

                    <div class="row">
                        <!-- List Grup Best Locations -->
                        <div class="col">
                            <div class="card border-0 mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878">Best Location</h6>
                                </div>
                                <div class="card-body" style="height:415px; padding:0px 0px 0px 0.5px" id="overflowTest">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col">Location</th>
                                                <th scope="col" class="text-center">Area</th>
                                                <th scope="col" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="small">
                                            <?php
                                            $no = 1;
                                            $query = "SELECT COUNT(*) AS total, lokasi_event, arealokasi_event 
                                                    FROM tb_event 
                                                    WHERE DATE_FORMAT(hari_tgl, '%Y') = YEAR(CURDATE()) 
                                                    GROUP BY lokasi_event, arealokasi_event 
                                                    ORDER BY total DESC;
                                                    ";
                                            $sql = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_assoc($sql)) {

                                            ?>
                                                <tr>
                                                    <th scope="row" class="text-center"><?= $no++ ?></th>
                                                    <td><?php echo ucwords($row['lokasi_event']); ?></td>
                                                    <td class="text-center"><?php echo ucwords($row['arealokasi_event']); ?></td>
                                                    <td class="text-center"><?php echo $row['total']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Grafik Donut Sales Area -->
                        <div class="col">
                            <div class="card border-0 mb-4">
                                <!-- Card Body -->
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878;">Sales Area</h6>
                                </div>
                                <div class="card-body" style="padding: 0;">
                                    <div class="chart-doughnut" style="height:369px; margin-top:1.5rem; margin-bottom:1.5rem;">
                                        <canvas id="myDoughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rating Reviews Tahun ini-->
                        <div class="col">
                            <div class="card border-0 mb-4 text-center">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-center" style="color:#FF7878;">Average Rating</h6>
                                </div>
                                <div class="card-body" style="height: 422px; align-items: center; padding:0;">
                                    <!-- Angka Rating -->
                                    <div class="row justify-content-center" style="margin-top: 1rem">
                                        <span class="rating">
                                            <?php
                                            $query = "SELECT SUM(penilaian_satu + penilaian_dua + penilaian_tiga + penilaian_empat + penilaian_lima) / 
                                                        (COUNT(penilaian_satu) + COUNT(penilaian_dua) + COUNT(penilaian_tiga) + COUNT(penilaian_empat) + COUNT(penilaian_lima)) AS total 
                                                    FROM tb_rating 
                                                    WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";

                                            $sql = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_assoc($sql)) {

                                                $total = round($row['total'], 1);

                                                echo $total;
                                            }
                                            ?>
                                        </span>
                                        <i class="fas fa-star text-warning" style="font-size: 52px; margin-top:32px; margin-left:7px"></i>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-size:23px; font-weight:bold; margin-bottom:5px;">Out of 5</div>
                                    </div>
                                    <!-- Total Reviewers -->
                                    <div class="row justify-content-center align-items-center" style="margin-bottom: 1rem;">
                                        <i class="fas fa-user" style="color: grey; margin-right:8px"></i>
                                        <span style="color:#FF7878; font-weight:bold; margin-right:3px;">
                                            <?php
                                            $query = "SELECT COUNT(*) AS totalUserReview FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $sql = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_assoc($sql)) {

                                                echo $row['totalUserReview'];
                                            }
                                            ?>
                                        </span>
                                        <a href="rating.php" style="color:#FF7878; font-weight:bold;"> Reviews</a>
                                    </div>
                                    <div class="row" style="margin:auto;">
                                        <!-- Rating Komunikasi -->
                                        <div class="progres">
                                            <p style="margin-top:8px;">Komunikasi</p>
                                        </div>
                                        <div>
                                            <?php
                                            function displayKomunikasi($komunikasi)
                                            {
                                                $stars = '';
                                                for ($i = 1; $i <= $komunikasi; $i++) {
                                                    // Menggunakan icon bintang Font Awesome
                                                    $stars .= '<i class="fas fa-star text-warning"></i> ';
                                                }
                                                return $stars;
                                            }
                                            $query = "SELECT AVG(penilaian_satu) AS komunikasi FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $result = $conn->query($query);
                                            // Cek apakah ada hasil
                                            if ($result->num_rows > 0) {
                                                // Ambil nilai rating
                                                $row = $result->fetch_assoc();
                                                $komunikasi = round($row['komunikasi'], 1);
                                                // Tampilkan bintang
                                                echo displayKomunikasi($komunikasi);
                                            } else {
                                                echo "Rating tidak ditemukan.";
                                            }
                                            ?>
                                        </div>
                                        <!-- Rating Perencanaan -->
                                        <div class="progres">
                                            <p style="margin-top:8px;">Perencanaan </p>
                                        </div>
                                        <div>
                                            <?php
                                            function displayPerencanaan($perencanaan)
                                            {
                                                $stars = '';
                                                for ($i = 1; $i <= $perencanaan; $i++) {
                                                    // Menggunakan icon bintang Font Awesome
                                                    $stars .= '<i class="fas fa-star text-warning"></i> ';
                                                }
                                                return $stars;
                                            }
                                            $query = "SELECT AVG(penilaian_dua) AS perencanaan FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $result = $conn->query($query);
                                            // Cek apakah ada hasil
                                            if ($result->num_rows > 0) {
                                                // Ambil nilai rating
                                                $row = $result->fetch_assoc();
                                                $perencanaan = round($row['perencanaan'], 1);
                                                // Tampilkan bintang
                                                echo displayPerencanaan($perencanaan);
                                            } else {
                                                echo "Rating tidak ditemukan.";
                                            }
                                            ?>
                                        </div>
                                        <!-- Rating Pelaksanaan -->
                                        <div class="progres">
                                            <p style="margin-top:8px;">Pelaksanaan</p>
                                        </div>
                                        <div>
                                            <?php
                                            function displayPelaksanaan($pelaksanaan)
                                            {
                                                $stars = '';
                                                for ($i = 1; $i <= $pelaksanaan; $i++) {
                                                    // Menggunakan icon bintang Font Awesome
                                                    $stars .= '<i class="fas fa-star text-warning"></i> ';
                                                }
                                                return $stars;
                                            }
                                            $query = "SELECT AVG(penilaian_tiga) AS pelaksanaan FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $result = $conn->query($query);
                                            // Cek apakah ada hasil
                                            if ($result->num_rows > 0) {
                                                // Ambil nilai rating
                                                $row = $result->fetch_assoc();
                                                $pelaksanaan = round($row['pelaksanaan'], 1);
                                                // Tampilkan bintang
                                                echo displayPelaksanaan($pelaksanaan);
                                            } else {
                                                echo "Rating tidak ditemukan.";
                                            }
                                            ?>
                                        </div>
                                        <!-- Rating Kepuasan -->
                                        <div class="progres">
                                            <p style="margin-top:8px;">Kepuasan</p>
                                        </div>
                                        <div>
                                            <?php
                                            function displayKepuasan($kepuasan)
                                            {
                                                $stars = '';
                                                for ($i = 1; $i <= $kepuasan; $i++) {
                                                    // Menggunakan icon bintang Font Awesome
                                                    $stars .= '<i class="fas fa-star text-warning"></i> ';
                                                }
                                                return $stars;
                                            }
                                            $query = "SELECT AVG(penilaian_empat) AS kepuasan FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $result = $conn->query($query);
                                            // Cek apakah ada hasil
                                            if ($result->num_rows > 0) {
                                                // Ambil nilai rating
                                                $row = $result->fetch_assoc();
                                                $kepuasan = round($row['kepuasan'], 1);
                                                // Tampilkan bintang
                                                echo displayKepuasan($kepuasan);
                                            } else {
                                                echo "Rating tidak ditemukan.";
                                            }
                                            ?>
                                        </div>
                                        <!-- Rating Rekomendasi -->
                                        <div class="progres">
                                            <p style="margin-top:8px;">Rekomendasi</p>
                                        </div>
                                        <div>
                                            <?php
                                            function displayRekomendasi($rekomendasi)
                                            {
                                                $stars = '';
                                                for ($i = 1; $i <= $rekomendasi; $i++) {
                                                    // Menggunakan icon bintang Font Awesome
                                                    $stars .= '<i class="fas fa-star text-warning"></i> ';
                                                }
                                                return $stars;
                                            }
                                            $query = "SELECT AVG(penilaian_lima) AS rekomendasi FROM tb_rating WHERE DATE_FORMAT(tgl_review, '%Y') = YEAR(CURDATE());";
                                            $result = $conn->query($query);
                                            // Cek apakah ada hasil
                                            if ($result->num_rows > 0) {
                                                // Ambil nilai rating
                                                $row = $result->fetch_assoc();
                                                $rekomendasi = round($row['rekomendasi'], 1);
                                                // Tampilkan bintang
                                                echo displayRekomendasi($rekomendasi);
                                            } else {
                                                echo "Rating tidak ditemukan.";
                                            }
                                            ?>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/script.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                    label: "Total Data",
                    backgroundColor: "#ff9a8aff",
                    hoverBackgroundColor: "#a1ccd1",
                    data: [
                        <?= implode(', ', $monthlyData) ?> // Ambil data dari PHP
                    ],
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Data Bulanan Tahun <?= $selectedYear ?>'
                    }
                }
            },
        });
    </script>

    <script>
        <?php
        // Tahun berjalan
        $currentYear = date('Y');

        // Ambil lokasi unik dari tabel tb_event berdasarkan tahun saat ini
        $queryLocations = mysqli_query($conn, "SELECT DISTINCT arealokasi_event FROM `tb_event` WHERE DATE_FORMAT(hari_tgl, '%Y') = '$currentYear' ORDER BY arealokasi_event ASC;");
        $locations = [];
        $eventCounts = [];

        // Loop untuk mendapatkan setiap lokasi unik dan hitung jumlah event di tiap lokasi untuk tahun saat ini
        while ($row = mysqli_fetch_assoc($queryLocations)) {
            // Format nama lokasi menjadi besar kecil (ucwords)
            $formattedLocation = ucwords(strtolower($row['arealokasi_event']));
            $locations[] = $formattedLocation;

            // Hitung jumlah event berdasarkan lokasi dan tahun berjalan
            $location = $row['arealokasi_event'];
            $queryCount = mysqli_query($conn, "SELECT * FROM `tb_event` WHERE arealokasi_event = '$location' AND DATE_FORMAT(hari_tgl, '%Y') = '$currentYear';");
            $eventCounts[] = mysqli_num_rows($queryCount);
        }

        // Konversi array PHP ke JavaScript
        $xValues = json_encode($locations); // Konversi array lokasi ke format JS
        $yValues = json_encode($eventCounts); // Konversi array jumlah event ke format JS
        ?>

        // Gunakan data yang sudah diambil dari PHP untuk xValues dan yValues di JavaScript
        const xValues = <?php echo $xValues; ?>;
        const yValues = <?php echo $yValues; ?>;

        // Fungsi untuk menghasilkan warna acak secara dinamis
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Array warna default, dan tambahkan warna otomatis jika ada lokasi baru
        let dColors = [
            "#a1ccd1", "#b5cda3", "#eec373", "#f46060", "#B784B7", "#638889",
            "#70AF85", "#9E7676", "#D0C9C0", "#ffb347", "#ffa07a", "#ff7373"
        ];

        // Jika jumlah lokasi lebih banyak daripada warna yang disediakan, buat warna acak tambahan
        if (xValues.length > dColors.length) {
            for (let i = dColors.length; i < xValues.length; i++) {
                dColors.push(getRandomColor());
            }
        }

        var ctx = document.getElementById("myDoughnutChart");
        var myPieChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    data: yValues,
                    backgroundColor: dColors.slice(0, xValues.length), // Batasi warna sesuai jumlah lokasi
                    borderColor: dColors.slice(0, xValues.length),
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    pointStyle: 'circle',
                    displayColors: true,
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                    },
                },
                cutoutPercentage: 50,
            }
        });
    </script>


</body>

</html>