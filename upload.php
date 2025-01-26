<?php
require_once 'RFIDManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = $_POST['customer'] ?? null;
    $initialBalance = $_POST['initial_balance'] ?? null;
    $transportFare = $_POST['transport_fare'] ?? null;

    if ($customer && is_numeric($initialBalance) && is_numeric($transportFare)) {
        $rfidManager = new RFIDManager();
        $success = $rfidManager->saveTransaction($customer, $initialBalance, $transportFare);

        if ($success) {
            echo json_encode(["message" => "Transaction uploaded successfully!"]);
        } else {
            echo json_encode(["message" => "Failed to save transaction."]);
        }
    } else {
        echo json_encode(["message" => "Invalid data provided."]);
    }
} else {
    echo json_encode(["message" => "Invalid request method."]);
}
?>
