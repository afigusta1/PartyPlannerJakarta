<?php
// Fungsi untuk menghubungkan ke MySQL
function getConnection() {
    $servername = "localhost"; 
    $username = "root";         
    $password = "";             
    $dbname = "db_partyplanner"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Ambil data dari form yang dikirim via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tglPesan = $_POST['tgl_pesan'];
    $namaClient = $_POST['nama_client'];
    $noTlp = $_POST['no_tlp'];
    $hariTgl = $_POST['hari_tgl'];
    $waktuAcara = $_POST['waktu_mulaiacara'];
    $waktuSelesaiAcara = $_POST['waktu_selesaiacara'];
    $lokasiEvent = $_POST['lokasi_event'];
    $arealokasiEvent = $_POST['arealokasi_event'];
    $jenisEvent = $_POST['jenis_event'];
    $temaEvent = $_POST['tema_event'];
    $jumlahTamu = $_POST['jumlah_tamu'];
    $listTamu = $_POST['list_tamu'];
    $emailClient = $_POST['email_client'];

    // Konversi tanggal dan waktu ke format MySQL
    $hariTgl = date('Y-m-d', strtotime($hariTgl));

    // Generate 
    $kodeEvent =  "E/" . date("Y") . "/" . sprintf("%03d", rand(0, 999));

    // Simpan ke database MySQL
    $conn = getConnection();
    $sql = "INSERT INTO `tb_event` (`kode_event`, `tgl_pesan`, `nama_client`, `no_tlp`, `hari_tgl`, `waktu_mulaiacara`, `waktu_selesaiacara`, `lokasi_event`, `arealokasi_event`, `jenis_event`, `tema_event`, `jumlah_tamu`, `list_tamu`, `email_client`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $kodeEvent, $tglPesan, $namaClient, $noTlp, $hariTgl, $waktuAcara, $waktuSelesaiAcara, $lokasiEvent, $arealokasiEvent, $jenisEvent, $temaEvent, $jumlahTamu, $listTamu, $emailClient);

    if ($stmt->execute()) {
        echo "Data successfully inserted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

