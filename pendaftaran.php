<?php
// Membuat abstract class Pendaftaran
abstract class Pendaftaran {
    
    // Properti/Atribut Terenkapsulasi (protected)
    // Dipetakan dari kolom tabel_pendaftaran di database
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biaya_pendaftaran_dasar; 

    // Constructor untuk memetakan data dari baris hasil query database ke dalam properti objek saat diinstansiasi.
    public function __construct($row_data) {
        $this->id_pendaftaran = $row_data['id_pendaftaran'] ?? null;
        $this->nama_calon = $row_data['nama_calon'] ?? null;
        $this->asal_sekolah = $row_data['asal_sekolah'] ?? null;
        $this->nilai_ujian = $row_data['nilai_ujian'] ?? null;
        $this->biaya_pendaftaran_dasar = $row_data['biaya_pendaftaran_dasar'] ?? null;
    }

    // Contoh abstract method (Biasanya abstract class memiliki minimal 1 abstract method Method ini nantinya WAJIB di-override oleh class turunannya (Reguler, Prestasi, Kedinasan)
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>