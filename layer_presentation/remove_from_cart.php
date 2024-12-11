<?php
session_start();
require_once __DIR__ . '/../layer_business_logic/CartController.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

// Get cart_item_id from the URL
if (isset($_GET['cart_item_id'])) {
    $cart_item_id = $_GET['cart_item_id'];

    // Create a new CartController instance
    $controller = new CartController();
    $controller->removeProductFromCart($cart_item_id); // Call the controller to remove the item

    // Redirect back to the cart page
    header('Location: /display_cart.php'); 
    exit();
} else {
    // Handle case where cart_item_id is not provided
    echo "Invalid request.";
}
?>
