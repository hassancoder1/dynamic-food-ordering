<?php
// Assuming $conn is your PDO database connection
$order_id = $value1; // Ensure the order ID is an integer to prevent SQL injection

try {
    // Prepare the query to get order details
    $stmt = $conn->prepare("SELECT customer_name, screen_number, seat_number, total AS total_amount, created_at, order_status, order_data FROM orders WHERE order_id = :order_id");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();

    // Check if the order exists
    if ($stmt->rowCount() > 0) {
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Order Details #<?php echo htmlspecialchars($order_id); ?>
        </h2>
        <div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Customer Name: </span>
                <span><?php echo htmlspecialchars($order['customer_name']); ?> </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Screen Number: </span>
                <span><?php echo htmlspecialchars($order['screen_number']); ?> </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Seat Number: </span>
                <span><?php echo htmlspecialchars($order['seat_number']); ?> </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Total Amount: </span>
                <span>$<?php echo htmlspecialchars($order['total_amount']); ?> </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Order Created On: </span>
                <span><?php echo htmlspecialchars($order['created_at']); ?> </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Order Status: </span>
                <span
                    class="px-2 py-1 font-semibold leading-tight text-gray-700 rounded-full bg-gray-100 dark:text-gray-100 dark:bg-blue-500">
                    <?php echo htmlspecialchars($order['order_status']); ?>
                </span>
            </div>
            <div class="flex justify-between items-center w-full text-center mx-auto text-white" style="max-width:350px;">
                <span>Update Status To: </span>
                <select onchange="updateCurrentStatus(event)" class="bg-slate-800 mt-3" required>
                    <option value="">Choose Status</option>
                    <option value="preparing">Preparing</option>
                    <option value="delivered">Delivered</option>
                    <option value="not_available">Not Available</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>

        <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
            Items Ordered
        </h2>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <?php
            // Decode the JSON data in order_data
            $order_items = json_decode($order['order_data'], true);

            // Check if items exist in the order data
            if (is_array($order_items) && !empty($order_items)) {
                foreach ($order_items as $item) {
                    ?>
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex">
                        <img src="../<?php echo htmlspecialchars($item['img']); ?>" class="w-24 h-24 rounded-full mr-4" alt="">
                        <div>
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">
                                Quantity: <?php echo htmlspecialchars($item['quantity']); ?> x Price:
                                <?php echo htmlspecialchars($item['currency']) . htmlspecialchars($item['price']); ?> <br>
                                SubTotal:
                                <?php echo htmlspecialchars($item['currency']); ?>
                                <?php echo htmlspecialchars($item['quantity'] * $item['price']); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="text-center text-gray-600 dark:text-gray-400">No items found for this order.</p>';
            }
            ?>
        </div>

        <?php
    } else {
        echo '<p class="text-center text-gray-600 dark:text-gray-400">Order not found.</p>';
    }
} catch (PDOException $e) {
    echo '<p class="text-center text-gray-600 dark:text-gray-400">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>
<script>
    window.updateCurrentStatus = function (event) {
        const orderId = "<?php echo $order_id; ?>";
        const updatedStatus = event.target.value;
        $.ajax({
            url: `../api/api.php?action=update_order_status&order_id=${orderId}&updatedStatus=${updatedStatus}`, // Your API endpoint
            method: 'GET',
            success: function (response) {
                if (response.status === updatedStatus) {
                    alert("Updated!")
                    loadComponent('dashboard', 1);
                }

            },
            error: function (error) {

            }
        });

    }
</script>