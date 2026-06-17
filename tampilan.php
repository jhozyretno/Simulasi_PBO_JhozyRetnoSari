<?php


// Debugging: Cek apakah file ada
if (file_exists('pendaftaran_prestasi.php')) {
    echo "File ditemukan!";
} else {
    echo "File TIDAK ditemukan! Periksa nama file dan lokasi folder.";
}
exit(); // Hentikan sementara untuk melihat hasilnya

require_once 'database.php';
require_once 'pendaftaran_reguler.php';
require_once 'pendaftaran_prestasi.php';
require_once 'pendaftaran_kedinasan.php';

// Inisialisasi koneksi
$db = (new Database())->getConnection();

// Mengambil data untuk setiap jalur
$dataReguler = pendaftaran_reguler::getDaftarReguler($db);
$dataPrestasi = pendaftaran_prestasi::getDaftarPrestasi($db);
$dataKedinasan = pendaftaran_kedinasan::getDaftarKedinasan($db);

// Fungsi pembantu untuk membuat tabel
function renderTabel($judul, $daftarData) {
    echo "<h2>Daftar Pendaftaran - $judul</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Nilai</th>
                <th>Info Jalur (Polimorfik)</th>
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
    echo "</tbody></table><br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pendaftaran Mahasiswa</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f2f2f2; text-align: left; }
        h2 { border-bottom: 2px solid #333; padding-bottom: 10px; }
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