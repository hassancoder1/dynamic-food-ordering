<?php
require_once '../functions.php';

header('Content-Type: application/json');

// Create table if not exists
try {
    DB->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id VARCHAR(255) NOT NULL,
        user_id INT NOT NULL,
        order_data TEXT NOT NULL,
        status VARCHAR(50) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    error_log("Error creating table: " . $e->getMessage());
    echo json_encode(['error' => 'Database error']);
    exit();
}

// Fetch and decrypt all orders
try {
    $stmt = DB->query("SELECT order_data FROM orders");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $decryptedOrders = [];
    foreach ($orders as $row) {
        $encryptedOrderData = $row['order_data'];
        $decryptedOrderData = decryptData($encryptedOrderData, MASTER_KEY);

        // Decode HTML entities to get valid JSON
        $jsonOrderData = html_entity_decode($decryptedOrderData);

        // Decode JSON string to PHP array/object
        $orderData = json_decode($jsonOrderData, true);

        $decryptedOrders[] = $orderData;
    }

    // Display all decrypted orders
    echo json_encode(['orderData' => $decryptedOrders]);

} catch (PDOException $e) {
    error_log("Error fetching orders: " . $e->getMessage());
    echo json_encode(['error' => 'Failed to fetch orders']);
}
?>