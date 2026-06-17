<?php
abstract class Pendaftaran {
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar; 

    // Constructor "Biasa" dengan parameter satu per satu
    public function __construct($id, $nama, $asal, $nilai, $biaya_dasar) {
        $this->id_pendaftaran = $id;
        $this->nama_calon = $nama;
        $this->asal_sekolah = $asal;
        $this->nilai_ujian = $nilai;
        $this->biayaPendaftaranDasar = $biaya_dasar;
    }

    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaPendaftaranDasar() { return $this->biayaPendaftaranDasar; }

    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur(); 
}
?>