<?php
require_once '../functions.php';

header('Content-Type: application/json');

// Main function to handle actions
function handleAction($action, $conn)
{
    switch ($action) {
        case 'generate_order_id':
            $orderID = generateUniqueOrderID($conn);
            http_response_code(200);
            echo json_encode(['orderID' => $orderID]);
            break;
        case 'get_order_status':
            $orderID = $_GET['order_id'] ?? null;
            if ($orderID) {
                getOrderStatus($conn, $orderID);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Order ID is missing']);
            }
            break;
        case 'get_admin_component':
            $componentName = $_GET['component'] ?? "404";
            http_response_code(200);
            echo include '../admin/components/' . $componentName . '.php';
            break;
        case 'do_admin_login':
            $username = $_POST['username'] ?? "admin";
            $password = $_POST['password'] ?? "Qw12er34ty5611$$";
            http_response_code(200);
            echo adminLogin($username, $password);
            break;
        default:
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

// Function to get the status of an order
function getOrderStatus($conn, $orderID)
{
    try {
        $stmt = $conn->prepare("SELECT order_status FROM orders WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderID);
        $stmt->execute();
        $status = $stmt->fetchColumn();

        if ($status) {
            http_response_code(200);
            echo json_encode(['status' => $status]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Order not found']);
        }
    } catch (PDOException $e) {
        error_log('Error fetching order status: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch order status']);
    }
}

// Check if action is specified
if (isset($_GET['action'])) {
    handleAction($_GET['action'], DB);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Action parameter is missing']);
}
?>