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
        case 'place_new_order':
            placeNewOrder($conn);
            http_response_code(200);
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
        case 'cancel_order':
            $orderID = $_GET['order_id'] ?? null;
            if ($orderID) {
                cancelOrder($conn, $orderID);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Order ID is missing']);
            }
            break;
        case 'get_admin_component':
            $componentName = $_GET['component'] ?? "404";
            $value1 = $_GET['value1'];
            http_response_code(200);
            include '../admin/components/' . $componentName . '.php';
            break;
        case 'get_formatted_orders_data':
            $page = $_GET['page'] ?? 1;
            getFormattedOrdersData($conn, $page);
            http_response_code(200);
            break;
        case 'update_order_status':
            $orderID = $_GET['order_id'];
            $status = $_GET['updatedStatus'];
            updateOrderStatus($conn, $orderID, $status);
            // http_response_code(200);
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
function placeNewOrder($conn)
{
    $orderID = $_GET['orderID'] ?? '';
    $total = $_GET['total'] ?? '';
    $customerName = $_GET['customerName'] ?? '';
    $screenNumber = $_GET['screenNumber'] ?? '';
    $seatNumber = $_GET['seatNumber'] ?? '';
    $cartItemsJSON = $_GET['cartItems'] ?? '';

    // Decode the JSON string to retrieve the cartItems array
    $cartItems = json_decode(urldecode($cartItemsJSON), true);

    // Validate inputs
    if (empty($orderID) || empty($cartItems) || empty($total) || !is_numeric($total)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data']);
        exit();
    }

    // Encrypt cart items data
    $cartItems = json_encode($cartItems);

    // Create orders table if it doesn't exist
    if (!createOrdersTable(DB)) {
        createOrdersTable(DB);
        exit();
    }

    // Insert order into database
    $insertSQL = "INSERT INTO orders (order_id, order_data, total, customer_name, screen_number, seat_number) VALUES (:order_id, :order_data, :total, :customer_name, :screen_number, :seat_number)";
    try {
        $stmt = DB->prepare($insertSQL);
        $stmt->bindParam(':order_id', $orderID);
        $stmt->bindParam(':order_data', $cartItems);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':customer_name', $customerName);
        $stmt->bindParam(':screen_number', $screenNumber);
        $stmt->bindParam(':seat_number', $seatNumber);
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

function cancelOrder($conn, $orderID)
{
    try {
        // Update the order status to "canceled" in the database
        $stmt = $conn->prepare("UPDATE orders SET order_status = 'canceled' WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderID);
        $stmt->execute();

        // Check if any rows were affected
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            http_response_code(200);
            echo json_encode(['status' => 'canceled', 'msg' => 'Order canceled successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Order not found']);
        }
    } catch (PDOException $e) {
        error_log('Error canceling order: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to cancel order']);
    }
}
function updateOrderStatus($conn, $order_id, $new_status)
{
    try {
        // Prepare the query to update order status
        $stmt = $conn->prepare("UPDATE orders SET order_status = :new_status WHERE order_id = :order_id");
        $stmt->bindParam(':new_status', $new_status);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(["status" => $new_status]);
            ;
        } else {
            echo "Order not found or status is already the same.";
        }
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
function getFormattedOrdersData($conn, $page = 1, $limit = 100)
{
    try {
        // Set the Content-Type header to application/json
        header('Content-Type: application/json');

        // Calculate the offset for pagination
        $offset = (intval($page) - 1) * $limit;

        // Fetch all orders to calculate totals
        $stmt = $conn->query("SELECT * FROM orders");
        $allOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch paginated orders
        $stmt = $conn->prepare("SELECT * FROM orders LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $paginatedOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize variables to store totals
        $totalOrders = count($allOrders);
        $totalEarnings = 0;
        $pendingOrdersCount = 0;
        $totalSales = 0;
        $formattedOrders = [];

        // Calculate totals using all orders
        foreach ($allOrders as $order) {
            $orderItems = json_decode($order['order_data'], true);
            $totalEarnings += floatval($order['total']);

            if ($order['order_status'] === 'pending') {
                $pendingOrdersCount++;
            }

            foreach ($orderItems as $item) {
                $totalSales += $item['quantity'];
            }
        }

        // Format paginated orders
        foreach ($paginatedOrders as $order) {
            $orderItems = json_decode($order['order_data'], true);
            $quantityPerOrder = 0;
            $formattedItems = [];

            foreach ($orderItems as $index => $item) {
                $quantityPerOrder += $item['quantity'];
                $formattedItems[$index] = [
                    'currency' => $item['currency'],
                    'item_id' => $item['id'],
                    'item_img' => $item['img'],
                    'item_name' => $item['name'],
                    'price' => $item['price'],
                    'item_quantity' => $item['quantity']
                ];
            }

            $formattedOrders[] = [
                'customer_name' => $order['customer_name'],
                'order_id' => $order['order_id'],
                'screen_number' => $order['screen_number'],
                'seat_number' => $order['seat_number'],
                'order_status' => $order['order_status'],
                'timestamp' => $order['created_at'],
                'quantity_per_order' => $quantityPerOrder,
                'total' => floatval($order['total']),
                'items' => $formattedItems
            ];
        }

        // Construct the response array
        $response = [
            'total_orders' => $totalOrders,
            'total_earnings' => '$' . number_format($totalEarnings, 2),
            'total_sales' => $totalSales,
            'total_pending_orders' => $pendingOrdersCount,
            'orders' => $formattedOrders,
            'current_page' => intval($page),
            'total_pages' => ceil($totalOrders / $limit)
        ];

        // Return the response as JSON
        http_response_code(200);
        echo json_encode($response);
    } catch (PDOException $e) {
        error_log('Error fetching totals: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch totals']);
    }
}





// Check if action is specified
if (isset($_GET['action'])) {
    $response = handleAction($_GET['action'], DB);
    echo $response;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Action parameter is missing']);
}
?>