<?php
require_once __DIR__ . '/../includes/conn.php';

class UserModel
{
    private $table_name = "users";
    private $conn;

    public function __construct()
    {
        global $conn; 
        if (!$conn) {
            die("Database connection is not established.");
        }
        $this->conn = $conn;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByproduct_id($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                error_log("No user found with id: $id");
            }
        } else {
            error_log("Query execution failed for id: $id");
        }

        return null; // Return null if nothing found or query fails
    }

    public function updateUser($username, $email, $phone, $full_name, $role)
    {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, phone = :phone, full_name = :full_name, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
