<?php
require_once '../functions.php';

header('Content-Type: application/json');

// Main function to handle actions
function handleAction($action, $conn)
{
    if ($action === 'generate_order_id') {
        $orderID = generateUniqueOrderID($conn);
        http_response_code(200);
        echo json_encode(['orderID' => $orderID]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
    }
}

// Function to generate a unique order ID
function generateUniqueOrderID($conn)
{
    createOrdersTable($conn);
    do {
        $uuid = bin2hex(random_bytes(16));
        $orderID = substr($uuid, 0, 8);
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderID);
        $stmt->execute();
        $orderExists = $stmt->fetchColumn() > 0;
    } while ($orderExists);
    return $orderID;
}

// Check if action is specified
if (isset($_GET['action'])) {
    handleAction($_GET['action'], DB);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Action parameter is missing']);
}
?>