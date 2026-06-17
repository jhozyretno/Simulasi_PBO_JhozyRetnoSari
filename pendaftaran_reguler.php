<?php
require_once 'pendaftaran.php';

class pendaftaran_reguler extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $prodi, $lokasi) {
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $lokasi;
    }

    public function getPilihanProdi() { return $this->pilihanProdi; }
    public function getLokasiKampus() { return $this->lokasiKampus; }

    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hasil[] = new pendaftaran_reguler(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['pilihan_prodi'] ?? '',
                $row['lokasi_kampus'] ?? ''  
            );
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        return 0; 
    }

    public function tampilkanInfoJalur() {
        return "Prodi: " . $this->getPilihanProdi() . " | Lokasi: " . $this->getLokasiKampus();
    }
}
?>