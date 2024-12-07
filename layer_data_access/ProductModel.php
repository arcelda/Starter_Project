<?php
require_once '../includes/conn.php';

class ProductModel
{
    private $table_name = "products";
    private $conn;

    public function __construct()
    {
        global $conn;  // Use the global connection variable from conn.php
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT); // Specify the data type
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //public function createProduct($name, $price, $description, $fileData)
    public function createProduct($name, $price, $description)
    {
        //$query = "INSERT INTO " . $this->table_name . " (name, price, description, FileData) VALUES (:name, :price, :description, :fileData)";
        $query = "INSERT INTO " . $this->table_name . " (name, price, description, FileData) VALUES (:name, :price, :description, :fileData)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        //$stmt->bindParam(':fileData', $fileData, PDO::PARAM_LOB); // Storing as LOB (large object)
        return $stmt->execute();
    }

    //public function updateProduct($product_id, $name, $price, $description, $fileData)
    public function updateProduct($product_id, $name, $price, $description)
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, description = :description, FileData = :filedata WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        //$stmt->bindParam(':fileData', $fileData, PDO::PARAM_LOB); // Storing as LOB (large object)
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT); // Specify the data type
        return $stmt->execute();
    }

    public function deleteProduct($product_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT); // Specify the data type
        return $stmt->execute();
    }
}
