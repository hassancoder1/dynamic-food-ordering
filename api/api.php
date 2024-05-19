<?php
require_once '../functions.php';

header('Content-Type: application/json');

// Check if action is specified
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Check if the action is to generate order ID
    if ($action === 'generate_order_id') {
        // Generate a unique order ID
        $orderID = generateUniqueOrderID(DB);

        // Return the generated order ID
        if ($orderID) {
            http_response_code(200);
            echo json_encode(['orderID' => $orderID]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to generate order ID']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Action parameter is missing']);

}

// Function to generate a unique order ID
function generateUniqueOrderID($conn)
{
    // Generate a random UUID
    $orderID = uniqid();
    createOrdersTable(DB);

    // Check if the generated order ID already exists in the database
    $checkOrderIDSQL = "SELECT COUNT(*) FROM orders WHERE order_id = :order_id";
    try {
        $stmt = $conn->prepare($checkOrderIDSQL);
        $stmt->bindParam(':order_id', $orderID);
        $stmt->execute();
        $orderExists = $stmt->fetchColumn() > 0;
        // If order ID exists, recursively generate a new one until a unique one is found
        if ($orderExists) {
            return generateUniqueOrderID($conn);
        }
        return $orderID;
    } catch (PDOException $e) {
        error_log('Error generating order ID: ' . $e->getMessage());
        return false;
    }
}
?>