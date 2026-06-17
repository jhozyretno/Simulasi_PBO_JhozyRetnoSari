<?php
require_once 'pendaftaran.php';

// Menyesuaikan penulisan nama class Pendaftaran dengan huruf besar di awal
class pendaftaran_reguler extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    // Tangkap semua parameter dari parent + parameter spesifik jalur ini
    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $prodi, $lokasi) {
        // PERBAIKAN 1: Gunakan variabel $biaya_dasar sesuai dengan parameter di atas
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        
        // Simpan parameter spesifik
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $lokasi;
    }

    // GETTER SPESIFIK JALUR REGULER
    public function getPilihanProdi() { return $this->pilihanProdi; }
    public function getLokasiKampus() { return $this->lokasiKampus; }

    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Instansiasi objek dengan memasukkan parameter satu per satu
            $hasil[] = new pendaftaran_reguler(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['pilihan_prodi'],  
                $row['lokasi_kampus']  
            );
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        // PERBAIKAN 2: Panggil nama fungsi getter yang sama persis dengan di kelas Pendaftaran
        return $this->getBiayaPendaftaranDasar(); 
    }

    public function tampilkanInfoJalur() {
        // Menggunakan getter spesifik di dalam class sendiri
        return "Prodi: " . $this->getPilihanProdi() . " | Lokasi: " . $this->getLokasiKampus();
    }
}
?>