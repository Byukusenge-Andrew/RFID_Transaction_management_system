<?php
require_once 'RFIDManager.php'; // Ensure you include the RFIDManager

// Create an instance of RFIDManager
$rfidManager = new RFIDManager();

// Fetch all transactions
$transactions = $rfidManager->getAllTransactions(); // Fetch transactions from the database

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Transactions</title>
    <style>
        /* Improved UI styles for better readability */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>RFID Transactions</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Initial Balance</th>
                <th>Transport Fare</th>
                <th>New Balance</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($transactions) > 0): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['id']) ?></td>
                        <td><?= htmlspecialchars($transaction['customer']) ?></td>
                        <td><?= htmlspecialchars($transaction['initial_balance']) ?></td>
                        <td><?= htmlspecialchars($transaction['transport_fare']) ?></td>
                        <td><?= htmlspecialchars($transaction['new_balance']) ?></td>
                        <td><?= htmlspecialchars($transaction['timestamp']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No transactions found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>