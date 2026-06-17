<?php
require_once 'pendaftaran.php';

class pendaftaran_kedinasan extends Pendaftaran {
    protected $skIkatanDinas;
    protected $instansiSponsor;

    // Tangkap semua parameter dari parent + parameter spesifik jalur kedinasan
    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $sk_dinas, $instansi) {
        // Lempar parameter umum ke constructor Pendaftaran.php
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        
        // Simpan parameter spesifik
        $this->skIkatanDinas = $sk_dinas;
        $this->instansiSponsor = $instansi;
    }

    // GETTER SPESIFIK JALUR KEDINASAN
    public function getSkIkatanDinas() { return $this->skIkatanDinas; }
    public function getInstansiSponsor() { return $this->instansiSponsor; }

    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Instansiasi objek dengan memasukkan parameter satu per satu
            $hasil[] = new pendaftaran_kedinasan(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['sk_ikatan_dinas'],  
                $row['instansi_sponsor']  
            );
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        // Memanggil fungsi getter dari kelas parent dan memberikan surcharge 25%
        return $this->getBiayaPendaftaranDasar() * 1.25; 
    }

    public function tampilkanInfoJalur() {
        // Menggunakan getter spesifik di dalam class sendiri
        return "Sponsor: " . $this->getInstansiSponsor() . " | SK: " . $this->getSkIkatanDinas();
    }
}
?>