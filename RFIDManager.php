<?php
require_once 'DatabaseManager.php';

class RFIDManager {
    private $db;

    public function __construct() {
        $databaseManager = new DatabaseManager();
        $this->db = $databaseManager->getConnection();
        $this->initializeTable();
    }

    private function initializeTable() {
        $query = "CREATE TABLE IF NOT EXISTS rfid_transactions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            customer TEXT NOT NULL,
            initial_balance REAL NOT NULL,
            transport_fare REAL NOT NULL,
            new_balance REAL GENERATED ALWAYS AS (initial_balance - transport_fare) STORED,
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->exec($query);
    }

    public function saveTransaction($customer, $initialBalance, $transportFare) {
        //  validation for inputs before database insertion
        if (empty($customer) || !is_numeric($initialBalance) || !is_numeric($transportFare)) {
            return false; 
        }
        $query = $this->db->prepare("INSERT INTO rfid_transactions (customer, initial_balance, transport_fare) VALUES (:customer, :initial_balance, :transport_fare)");
        $query->bindValue(':customer', $customer, SQLITE3_TEXT);
        $query->bindValue(':initial_balance', $initialBalance, SQLITE3_FLOAT);
        $query->bindValue(':transport_fare', $transportFare, SQLITE3_FLOAT);

        return $query->execute() !== false;
    }

    public function getAllTransactions() {
        $result = $this->db->query("SELECT id, customer, initial_balance, transport_fare, new_balance, timestamp FROM rfid_transactions");
        $transactions = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $transactions[] = $row;
        }
        return $transactions;
    }
}
?>
