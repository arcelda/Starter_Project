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

    // Instantiate CartController
    $cartController = new CartController();

    // Add or update the product in the cart with the given quantity
    $cartController->addProduct($product_id, $quantity);

    // Redirect to cart display page
    header('Location: ../display_Cart.php');
    exit();

} catch (Exception $e) {
    // Redirect with an error message
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: /error_page.php');
    exit();
}
