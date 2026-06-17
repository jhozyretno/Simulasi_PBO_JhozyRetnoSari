<?php
require_once 'pendaftaran.php';

class pendaftaran_reguler extends pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    public function __construct($row_data) {
        parent::__construct($row_data);
        $this->pilihanProdi = $row_data['pilihan_prodi'] ?? '-';
        $this->lokasiKampus = $row_data['lokasi_kampus'] ?? '-';
    }

    // =========================================
    // GETTER SPESIFIK JALUR REGULER
    // =========================================
    public function getPilihanProdi() { return $this->pilihanProdi; }
    public function getLokasiKampus() { return $this->lokasiKampus; }

    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hasil[] = new pendaftaran_reguler($row);
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar; 
    }

    public function tampilkanInfoJalur() {
        // Menggunakan getter spesifik di dalam class sendiri (opsional tapi rapi)
        return "Prodi: " . $this->getPilihanProdi() . " | Lokasi: " . $this->getLokasiKampus();
    }
}
?>