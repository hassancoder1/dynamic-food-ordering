<?php
define('MASTER_KEY', '55a3aa74-6190-4c44-82e0-fab75a345b02');

// Database connection
$dsn = 'mysql:host=localhost;dbname=mtc_db';
$username = 'root';
$password = '';

try {
    define('DB', new PDO($dsn, $username, $password));
    DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Encryption function
function encryptData($data, $key)
{
    $method = 'AES-256-CBC';
    $ivLength = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

// Decryption function
function decryptData($encryptedData, $key)
{
    $method = 'AES-256-CBC';
    $ivLength = openssl_cipher_iv_length($method);
    $encryptedData = base64_decode($encryptedData);
    $iv = substr($encryptedData, 0, $ivLength);
    $data = substr($encryptedData, $ivLength);
    return openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
}

function sanitize($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}


function createOrdersTable($conn)
{
    $createTableSQL = "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id VARCHAR(36),
        order_data TEXT NOT NULL,
        total DECIMAL(10, 2) NOT NULL,
        order_status VARCHAR(20) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    try {
        $conn->exec($createTableSQL);
    } catch (PDOException $e) {
        error_log("Error creating orders table: " . $e->getMessage());
        return false;
    }
    return true;
}

function createContactFromTable($conn)
{
    $createTableSQL = "CREATE TABLE IF NOT EXISTS contact_form (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    try {
        $conn->exec($createTableSQL);
    } catch (PDOException $e) {
        error_log("Error creating orders table: " . $e->getMessage());
        return false;
    }
    return true;
}
?>