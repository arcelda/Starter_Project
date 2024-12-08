<?php
require_once __DIR__ . '/../includes/conn.php';

class ProductModel
{
    private $table_name = "products";
    private $conn;

    public function __construct()
    {
        global $conn; 
        if (!$conn) {
            die("Database connection is not established.");
        }
        $this->conn = $conn;
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductByproduct_id($product_id)
    {
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                error_log("No product found with product_id: $product_id");
            }
        } else {
            error_log("Query execution failed for product_id: $product_id");
        }

        return null; // Return null if nothing found or query fails
    }

    public function createProduct($name, $price, $description, $product_image)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, price, description, product_image) VALUES (:name, :price, :description, :product_image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":product_image", $product_image);
        return $stmt->execute();
    }

    public function updateProduct($product_id, $name, $price, $description, $product_image)
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, description = :description, product_image = :product_image WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":product_image", $product_image);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteProduct($product_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
