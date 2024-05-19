<?php
require_once '../functions.php';

header('Content-Type: application/json');

// Function to create orders table if it doesn't exist
createOrdersTable(DB);

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = isset($_POST['orderID']) ? $_POST['orderID'] : null;
    $cartItems = isset($_POST['cartItems']) ? $_POST['cartItems'] : null;
    $total = isset($_POST['total']) ? $_POST['total'] : null;

    // Sanitize inputs
    $orderID = sanitize($orderID);
    $cartItems = sanitize(json_encode($cartItems)); // Assuming cartItems is an array
    $total = sanitize($total);

    // Validate inputs
    if (empty($orderID) || empty($cartItems) || empty($total) || !is_numeric($total)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data']);
        exit();
    }

    // Encrypt cart items data
    $encryptedCartItems = encryptData($cartItems, MASTER_KEY);

    // Create orders table if it doesn't exist
    if (!createOrdersTable(DB)) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error']);
        exit();
    }

    // Check if orderID exists in the database
    $orderExists = false;
    $checkOrderSQL = "SELECT COUNT(*) FROM orders WHERE order_id = :order_id";
    try {
        $stmt = DB->prepare($checkOrderSQL);
        $stmt->bindParam(':order_id', $orderID);
        $stmt->execute();
        $orderExists = $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log('Error checking order existence: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'status' => 'failed',
            'msg' => 'Failed to check order existence'
        ]);
        exit();
    }

    // If orderID already exists, return it
    if ($orderExists) {
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'orderID' => $orderID
        ]);
        exit();
    }

    // Insert order into database
    $insertSQL = "INSERT INTO orders (order_id, order_data, total) VALUES (:order_id, :order_data, :total)";
    try {
        $stmt = DB->prepare($insertSQL);
        $stmt->bindParam(':order_id', $orderID);
        $stmt->bindParam(':order_data', $encryptedCartItems);
        $stmt->bindParam(':total', $total);
        $stmt->execute();
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'msg' => 'Order placed successfully'
        ]);
    } catch (PDOException $e) {
        error_log('Error inserting order: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'status' => 'failed',
            'msg' => 'Failed to place order'
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
?>