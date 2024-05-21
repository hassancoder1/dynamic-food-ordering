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
            $value1 = $_GET['value1'] ?? '';
            $value2 = $_GET['value2'] ?? '';
            $value3 = $_GET['value3'] ?? '';
            http_response_code(200);
            echo include '../admin/components/' . $componentName . '.php';
            break;
        case 'do_admin_login':
            $username = $_POST['username'] ?? "admin";
            $password = $_POST['password'] ?? "Qw12er34ty5611$$";
            http_response_code(200);
            echo adminLogin($username, $password);
            break;
        case 'get_orders_details':
            getOrdersDetails($conn);
            http_response_code(200);
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
function getOrdersDetails($conn)
{
    try {
        // Fetch all orders from the database
        $stmt = $conn->query("SELECT * FROM orders");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize variables to store totals
        $totalOrders = count($orders);
        $totalEarnings = 0;
        $pendingOrdersCount = 0;
        $totalSales = 0;
        $formattedOrders = [];

        // Loop through each order
        foreach ($orders as $order) {
            // Decode the order data
            $orderItems = json_decode($order['order_data'], true);

            // Calculate total earnings
            $totalEarnings += floatval($order['total']);

            // Increment pending orders count
            if ($order['order_status'] === 'pending') {
                $pendingOrdersCount++;
            }

            // Calculate total sales and quantity per order
            $quantityPerOrder = 0;
            $formattedItems = [];
            foreach ($orderItems as $index => $item) {
                $quantityPerOrder += $item['quantity'];
                $totalSales += $item['quantity'];

                $formattedItems[$index] = [
                    'currency' => $item['currency'],
                    'item_id' => $item['id'],
                    'item_img' => $item['img'],
                    'item_name' => $item['name'],
                    'price' => $item['price'],
                    'item_quantity' => $item['quantity']
                ];
            }

            // Format each order
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
            'orders' => $formattedOrders
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
    header('Content-Type: application/json');
    echo $response;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Action parameter is missing']);
}
?>