<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "db_partyplanner"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari request POST
$namaReviewer = $_POST['nama_reviewer'];
$noTlpReviewer = $_POST['notlp_reviewer'];
$tglReview = $_POST['tgl_review'];
$penilaianSatu = $_POST['penilaian_satu'];
$penilaianDua = $_POST['penilaian_dua'];
$penilaianTiga = $_POST['penilaian_tiga'];
$penilaianEmpat = $_POST['penilaian_empat'];
$penilaianLima = $_POST['penilaian_lima'];
$komentarReviewer = $_POST['komentar_reviewer'];
$emailReviewer = $_POST['email_reviewer'];
$kodeEvent = $_POST['kode_event'];

// SQL Insert
$sql = "INSERT INTO tb_rating (nama_reviewer, notlp_reviewer, tgl_review, penilaian_satu, penilaian_dua, penilaian_tiga, penilaian_empat, penilaian_lima, komentar_reviewer, email_reviewer, kode_event)
VALUES ('$namaReviewer', '$noTlpReviewer', '$tglReview', '$penilaianSatu', '$penilaianDua', '$penilaianTiga', '$penilaianEmpat', '$penilaianLima', '$komentarReviewer', '$emailReviewer', '$kodeEvent')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
