<?php
require_once __DIR__ . '/../layer_data_access/CartModel.php';

class CartController
{
    private $model;

    public function __construct() {
        $this->model = new CartModel(); // Instantiate the CartModel
    }
    
    public function addProduct($product_id, $quantity) {
        $user_id = $_SESSION['user_id'];  // Assuming user is logged in
        error_log("Adding product to cart: User ID = $user_id, Product ID = $product_id, Quantity = $quantity");
    
        try {
            $this->model->addToCart($user_id, $product_id, $quantity);
        } catch (Exception $e) {
            error_log("Error in CartController: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function viewCart() {
        $user_id = $_SESSION['user_id'];
        $cartItems = $this->model->getCartItems($user_id);
        $cartTotal = $this->model->getCartTotal($user_id);
        return ['cartItems' => $cartItems, 'cartTotal' => $cartTotal];
    }    
    
    public function updateCart($cart_item_id, $quantity) {
        return $this->model->updateCartItem($cart_item_id, $quantity); // Call model to update cart item
    }

    public function removeProductFromCart($cart_item_id) {
        return $this->model->removeFromCart($cart_item_id); // Call model to remove item from cart
    }

    public function clearCart() {
        $user_id = $_SESSION['user_id'];  // Assuming user is logged in
        return $this->model->clearCart($user_id); // Call model to clear the cart
    }
}
