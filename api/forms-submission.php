<?php
include '../functions.php';
function handleContactForm($data)
{
    // Encrypt the email and message (You'll need to implement your own encryption function)
    $encrypted_name = encryptData(sanitize($data['fname']) . ' ' . sanitize($data['lname']), MASTER_KEY);
    $encrypted_email = encryptData(filter_var($data['email'], FILTER_SANITIZE_EMAIL), MASTER_KEY);
    $encrypted_phone = encryptData(sanitize($data['phone']), MASTER_KEY);
    $encrypted_message = encryptData(sanitize($data['message']), MASTER_KEY);

    // Create table if not exists
    createContactFromTable(DB);
    // Insert data into database
    $stmt = DB->prepare("INSERT INTO contact_form (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
    $insert = $stmt->execute(['name' => $encrypted_name, 'email' => $encrypted_email, 'phone' => $encrypted_phone, 'message' => $encrypted_message]); // For demonstration purposes

    // Return JSON response
    if ($insert) {
        return json_encode([
            'status' => 'success',
            'msg' => 'Success: We will contact you shortly!'
        ]);
    } else {
        return json_encode([
            'status' => 'failed',
            'msg' => '!Error: There is a problem at our side!'
        ]);
    }
}

// Main script
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = $_POST;

    // Check the formtype field
    $formType = isset($postData['formtype']) ? $postData['formtype'] : '';

    if ($formType === 'contactform') {
        $response = handleContactForm($postData);
    } else {
        $response = json_encode(['msg' => 'Invalid formtype']);
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo $response;
} else {
    // Handle other HTTP methods if needed
    http_response_code(405); // Method Not Allowed
}
?>