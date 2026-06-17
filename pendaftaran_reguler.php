<?php
require_once 'pendaftaran.php';

class pendaftaran_reguler extends pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    // Tangkap semua parameter dari parent + parameter spesifik jalur ini
    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $prodi, $lokasi) {
        // Lempar parameter umum ke constructor Pendaftaran.php
        parent::__construct($id, $nama, $asal, $nilai, $biaya_pendaftaran_dasar);
        
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
        // Memanggil fungsi getter dari kelas parent
        return $this->getbiaya_pendaftaran_dasar(); 
    }

    public function tampilkanInfoJalur() {
        // Menggunakan getter spesifik di dalam class sendiri (opsional tapi rapi)
        return "Prodi: " . $this->getPilihanProdi() . " | Lokasi: " . $this->getLokasiKampus();
    }
}
?>