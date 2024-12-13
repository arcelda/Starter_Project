<?php
session_start();
require_once __DIR__ . '/../layer_business_logic/CartController.php';

try {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        error_log("User is not logged in.");
        throw new Exception("User is not logged in.");
    }
    

    // Validate POST data
    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        error_log("Invalid input: " . print_r($_POST, true));
        throw new Exception("Invalid input.");
    }
    

    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity <= 0) {
        error_log("Quantity must be greater than zero: " . $quantity);
        throw new Exception("Quantity must be greater than zero.");
    }
    
    if (!class_exists('CartController')) {
        error_log("CartController class not found.");
        throw new Exception("CartController class not found.");
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
    header('Location: ../error_page.php');
    exit();
}
