<?php
// Include config for DB connection
include 'config.php';

// Get POST data from frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo "No data received";
    exit();
}

$fullname = $conn->real_escape_string($data['fullname']);
$email = $conn->real_escape_string($data['email']);
$phone = $conn->real_escape_string($data['phone']);
$address = $conn->real_escape_string($data['address']);
$products = $conn->real_escape_string(json_encode($data['products']));
$total_price = 0;

// Calculate total price
foreach ($data['products'] as $p) {
    $total_price += floatval($p['price']);
}

$payment_method = $conn->real_escape_string($data['paymentMethod']);

// Insert order into DB
$sql = "INSERT INTO orders (fullname, email, phone, address, products, total_price, payment_method)
        VALUES ('$fullname', '$email', '$phone', '$address', '$products', '$total_price', '$payment_method')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
