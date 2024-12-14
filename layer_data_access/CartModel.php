<?php
require_once __DIR__ . '/../includes/conn.php';

class CartModel
{
    private $conn;

    public function __construct()
    {
        global $conn; 
        if (!$conn) {
            die("Database connection is not established.");
        }
        $this->conn = $conn;
    }

    public function addToCart($user_id, $product_id, $quantity) {
        try {
            error_log("Adding product to cart: User ID = $user_id, Product ID = $product_id, Quantity = $quantity");
    
            // Check if the product already exists in the cart
            $query = "SELECT quantity FROM cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existingProduct) {
                $newQuantity = $existingProduct['quantity'] + $quantity;
                $updateQuery = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
                $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $updateStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $updateStmt->execute();
                error_log("Updated quantity for user $user_id, product $product_id: New Quantity = $newQuantity");

            } else {
                $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
                $insertStmt = $this->conn->prepare($insertQuery);
                $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insertStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $insertStmt->execute();
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to add product to cart.");
        }
    }
    
    public function getCartItemByUserAndProduct($user_id, $product_id) {
        try {
            $query = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Returns the cart item if exists, otherwise null
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to retrieve cart item.");
        }
    }
    
    public function updateCartItem($cart_item_id, $quantity) {
        try {
            $query = "UPDATE cart_items SET quantity = :quantity WHERE cart_item_id = :cart_item_id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$quantity, $cart_item_id]);
        } catch (PDOException $e) {
            error_log("Failed to update cart item: " . $e->getMessage());
            throw new Exception("Could not update cart item.");
        }
    }
    

    public function getCartItems($user_id) {
        $query = "SELECT c.*, p.name, p.price FROM cart c 
                  JOIN products p ON c.product_id = p.product_id 
                  WHERE c.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }//- Retrieve all items in the user's cart.

    public function removeFromCart($cart_item_id) {
        try {
            $query = "DELETE FROM cart WHERE cart_item_id = :cart_item_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                error_log("Successfully removed item with ID: $cart_item_id");
            } else {
                error_log("No item found with ID: $cart_item_id");
            }
        } catch (PDOException $e) {
            error_log("Error removing item from cart: " . $e->getMessage());
        }
    }

    public function clearCart($user_id) {
        try {
            $query = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to clear cart.");
        }
    }

    public function getCartTotal($user_id) {
        $query = "SELECT SUM(c.quantity * p.price) AS cart_total FROM cart c
                  JOIN products p ON c.product_id = p.product_id 
                  WHERE c.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['cart_total'] ? $result['cart_total'] : 0;
    }
     //- Calculate the total price of the cart.
}