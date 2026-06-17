<?php
class Database {
    // Sesuaikan konfigurasi ini dengan server lokal (Laragon)
    private $host = "localhost";
    private $db_name = "Ddb_simulasi_pbo_ti1c_jhozyretnosari";
    private $username = "root"; 
    private $password = ""; 
    public $conn;

    // Method untuk mendapatkan koneksi database
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Mengatur mode error PDO menjadi Exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>