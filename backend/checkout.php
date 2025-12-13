<?php
session_start();
include 'config.php';  // Include DB connection

// Get data from form
$fullname = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$products = json_encode($_SESSION['cart']); // Cart from session
$total_price = $_POST['total_price'];
$payment_method = $_POST['paymentMethod'];

// Insert order into orders table
$sql = "INSERT INTO orders (fullname, email, phone, address, products, total_price, payment_method)
        VALUES ('$fullname', '$email', '$phone', '$address', '$products', '$total_price', '$payment_method')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    unset($_SESSION['cart']); // Clear cart after checkout
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
