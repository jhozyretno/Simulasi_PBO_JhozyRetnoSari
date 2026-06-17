<?php
require_once 'pendaftaran.php';

class pendaftaran_kedinasan extends Pendaftaran {
    protected $skIkatanDinas;
    protected $instansiSponsor;

    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar, $sk_dinas, $instansi) {
        parent::__construct($id, $nama, $asal, $nilai, $biaya_dasar);
        $this->skIkatanDinas = $sk_dinas;
        $this->instansiSponsor = $instansi;
    }

    public function getSkIkatanDinas() { return $this->skIkatanDinas; }
    public function getInstansiSponsor() { return $this->instansiSponsor; }

    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $hasil = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hasil[] = new pendaftaran_kedinasan(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['sk_ikatan_dinas'] ?? '',
                $row['instansi_sponsor'] ?? ''
            );
        }
        return $hasil;
    }

    public function hitungTotalBiaya() {
        return $this->getBiayaPendaftaranDasar() * 1.25; 
    }

    public function tampilkanInfoJalur() {
        return "Sponsor: " . $this->getInstansiSponsor() . " | SK: " . $this->getSkIkatanDinas();
    }
}
?>