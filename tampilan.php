<?php
require_once 'Database.php';
require_once 'pendaftaran_reguler.php';
require_once 'pendaftaran_prestasi.php';
require_once 'pendaftaran_kedinasan.php';

$dbConnection = new Database();
$db = $dbConnection->getConnection();

if ($db === null) {
    die("<div style='color:red; text-align:center; margin-top:50px;'>Koneksi database gagal.</div>");
}

// 1. Mengambil data
$dataReguler = pendaftaran_reguler::getDaftarReguler($db);
$dataPrestasi = pendaftaran_prestasi::getDaftarPrestasi($db);
$dataKedinasan = pendaftaran_kedinasan::getDaftarKedinasan($db);

// 2. Fungsi Statistik untuk memperkaya data
function hitungTotalBiayaSeluruhnya($data) {
    $total = 0;
    foreach ($data as $item) { $total += $item->hitungTotalBiaya(); }
    return $total;
}

$semuaData = array_merge($dataReguler, $dataPrestasi, $dataKedinasan);
$totalPendaftar = count($semuaData);
$totalPendapatan = hitungTotalBiayaSeluruhnya($semuaData);

// 3. Fungsi Render Tabel yang lebih dinamis
function renderTabel($judul, $daftarData, $warna = "#6a1b9a") {
    echo "<div class='card'>";
    echo "<h2 style='color:$warna;'>$judul</h2>";
    echo "<table>
            <thead>
                <tr style='background-color:$warna;'>
                    <th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai</th>
                    <th>Info Jalur</th><th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>";
    
    if (empty($daftarData)) {
        echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data.</td></tr>";
    } else {
        foreach ($daftarData as $item) {
            echo "<tr>
                    <td>{$item->getNamaCalon()}</td>
                    <td>{$item->getAsalSekolah()}</td>
                    <td>{$item->getNilaiUjian()}</td>
                    <td>{$item->tampilkanInfoJalur()}</td>
                    <td class='duit'>Rp " . number_format($item->hitungTotalBiaya(), 0, ',', '.') . "</td>
                  </tr>";
        }
    }
    echo "</tbody></table></div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Sistem Dashboard Pendaftaran</title>
    <style>
        :root { --ungu-utama: #6a1b9a; --biru-panel: #2196f3; --hijau-panel: #4caf50; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f9; padding: 20px; }
        .container { max-width: 1000px; margin: auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 10px; border-left: 5px solid var(--ungu-utama); box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th { color: white; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .duit { font-weight: bold; color: #2e7d32; }
        .footer { text-align: center; font-size: 0.8em; color: #777; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Penerimaan Mahasiswa</h1>
        
        <div class="stats-grid">
            <div class="stat-card"><h3>Total Pendaftar</h3><p><?php echo $totalPendaftar; ?> Siswa</p></div>
            <div class="stat-card" style="border-left-color:var(--hijau-panel);"><h3>Total Pendapatan</h3><p>Rp <?php echo number_format($totalPendapatan, 0, ',', '.'); ?></p></div>
        </div>

        <?php 
            renderTabel("Jalur Reguler", $dataReguler, "#6a1b9a");
            renderTabel("Jalur Prestasi", $dataPrestasi, "#f57c00");
            renderTabel("Jalur Kedinasan", $dataKedinasan, "#1976d2");
        ?>
        
        <div class="footer">
            &copy; <?php echo date('Y'); ?> Sistem Informasi Pendaftaran Mahasiswa Baru.
        </div>
    </div>
</body>
</html>