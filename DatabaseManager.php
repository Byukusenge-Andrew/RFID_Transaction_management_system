<?php
class DatabaseManager {
    private $db;

    public function __construct($databaseFile = 'database.sqlite') {
        try {
            $this->db = new SQLite3($databaseFile);
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->db;
    }
}
?>
