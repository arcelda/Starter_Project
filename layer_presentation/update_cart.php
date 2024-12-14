<?php
session_start();
require_once __DIR__ . '/../layer_business_logic/CartController.php';

try {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("User is not logged in.");
    }

    // Validate POST data
    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        throw new Exception("Invalid input.");
    }

    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity <= 0) {
        throw new Exception("Quantity must be greater than zero.");
    }

    // Update the cart
    $cartController = new CartController();
    $cartController->updateCart($product_id, $quantity);

    // Redirect to cart page
    header('Location: ../display_Cart.php');
    exit();
} catch (Exception $e) {
    // Handle errors
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../error_page.php');
    exit();
}
