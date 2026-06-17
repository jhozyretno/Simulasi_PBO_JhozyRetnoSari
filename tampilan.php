<?php
require_once 'Database.php';
require_once 'pendaftaran_reguler.php';
require_once 'pendaftaran_prestasi.php';
require_once 'pendaftaran_kedinasan.php';

// Inisialisasi koneksi
$dbConnection = new Database();
$db = $dbConnection->getConnection();

if ($db === null) {
    die("Koneksi database gagal. Periksa konfigurasi di Database.php.");
}

// Mengambil data
$dataReguler = pendaftaran_reguler::getDaftarReguler($db);
$dataPrestasi = pendaftaran_prestasi::getDaftarPrestasi($db);
$dataKedinasan = pendaftaran_kedinasan::getDaftarKedinasan($db);

// Fungsi render tabel
function renderTabel($judul, $daftarData) {
    echo "<h2>$judul</h2>";
    echo "<table border='1' cellpadding='8' cellspacing='0' style='width:100%; border-collapse:collapse; margin-bottom:20px;'>";
    echo "<thead style='background-color: #9575cd;'>
            <tr>
                <th>Nama Calon</th>
                <th>Asal Sekolah</th>
                <th>Nilai</th>
                <th>Info Jalur</th>
                <th>Total Biaya</th>
            </tr>
          </thead>";
    echo "<tbody>";
    
    if (empty($daftarData)) {
        echo "<tr><td colspan='5'>Tidak ada data.</td></tr>";
    } else {
        foreach ($daftarData as $item) {
            echo "<tr>
                    <td>{$item->getNamaCalon()}</td>
                    <td>{$item->getAsalSekolah()}</td>
                    <td>{$item->getNilaiUjian()}</td>
                    <td>{$item->tampilkanInfoJalur()}</td>
                    <td>Rp " . number_format($item->hitungTotalBiaya(), 0, ',', '.') . "</td>
                  </tr>";
        }
    }
    echo "</tbody></table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pendaftaran Mahasiswa</title>
    <style>
        body { 
          font-family: 'Times New Roman', serif; 
          margin: 30px; }
        h1 { 
          text-align: center; }
        h2 { 
          border-bottom: 2px solid #333; 
          padding-bottom: 5px; 
          color: #4a148c; }
    </style>
</head>
<body>
    <h1>Data Pendaftaran Mahasiswa Baru</h1>
    
    <?php
    renderTabel("Jalur Reguler", $dataReguler);
    renderTabel("Jalur Prestasi", $dataPrestasi);
    renderTabel("Jalur Kedinasan", $dataKedinasan);
    ?>
</body>
</html>

