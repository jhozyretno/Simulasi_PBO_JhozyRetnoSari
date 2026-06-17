<?php
require_once 'pendaftaran.php';

class pendaftaran_prestasi extends Pendaftaran {
    protected $jenisPrestasi;
    protected $tingkatPrestasi;

    // Tangkap semua parameter dari parent + parameter spesifik jalur prestasi
    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $jenis_prestasi, $tingkat_prestasi) {
        // Lempar parameter umum ke constructor Pendaftaran.php
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        
        // Simpan parameter spesifik
        $this->jenisPrestasi = $jenis_prestasi;
        $this->tingkatPrestasi = $tingkat_prestasi;
    }

    // GETTER SPESIFIK JALUR PRESTASI
    public function getJenisPrestasi() { return $this->jenisPrestasi; }
    public function getTingkatPrestasi() { return $this->tingkatPrestasi; }

    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Instansiasi objek dengan memasukkan parameter satu per satu
            $hasil[] = new pendaftaran_prestasi(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['jenis_prestasi'],  
                $row['tingkat_prestasi']  
            );
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        // Memanggil fungsi getter dari kelas parent dan memberikan potongan Rp50.000
        return $this->getBiayaPendaftaranDasar() - 50000; 
    }

    public function tampilkanInfoJalur() {
        // Menggunakan getter spesifik di dalam class sendiri
        return "Prestasi: " . $this->getJenisPrestasi() . " (" . $this->getTingkatPrestasi() . ")";
    }
}
?>