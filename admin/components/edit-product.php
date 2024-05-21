<?php
createProductTableIfNotExists($conn);
$productid = $value1;
$product = [];
if (isset($productid)) {
    $product = getProductInfo($conn, $productid);
} else {
    $product['product_id'] = generateUniqueOrderId($conn);
}

function createProductTableIfNotExists($conn)
{
    $query = "
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id CHAR(16) UNIQUE NOT NULL,
        title VARCHAR(255) NOT NULL,
        secondary_title VARCHAR(255) NOT NULL,
        image VARCHAR(255)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    if ($conn->query($query) === FALSE) {
        die("Error creating table: " . $conn->error);
    }
}

function getProductInfo($conn, $productid)
{
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productid);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function generateUniqueOrderId($conn)
{
    do {
        $orderId = bin2hex(random_bytes(8));
        $stmt = $conn->prepare("SELECT id FROM products WHERE order_id = ?");
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $stmt->store_result();
    } while ($stmt->num_rows > 0);

    return $orderId;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl mb-4">Product Form</h1>
        <form action="process_form.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                <input type="text" name="title" id="title"
                    value="<?php echo htmlspecialchars($product['title'] ?? ''); ?>"
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm">
            </div>
            <div>
                <label for="secondary_title" class="block text-sm font-medium text-gray-300">Secondary Title</label>
                <input type="text" name="secondary_title" id="secondary_title"
                    value="<?php echo htmlspecialchars($product['secondary_title'] ?? ''); ?>"
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-white">
            </div>
            <div>
                <label for="order_id" class="block text-sm font-medium text-gray-300">Order ID</label>
                <input type="text" name="order_id" id="order_id"
                    value="<?php echo htmlspecialchars($product['order_id'] ?? ''); ?>"
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm">
            </div>
            <input type="hidden" name="productid" id="productid"
                value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>