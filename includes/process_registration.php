<?php
include '../includes/conn.php';
$message = "";
// Check if $conn is defined and available
if (isset($conn)) {
    // Database name
    $dbname = "myDBPDO";

    try {
        // Select the database
        $conn->exec("USE $dbname");
    } catch (PDOException $e) {
        echo "<p>Error selecting database: " . $e->getMessage() . '</p>';
    }

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Basic validation for form inputs
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Hash the password
        $full_name = !empty($_POST['full_name']) ? trim($_POST['full_name']) : null;
        
        //Make sure each field is filled
        if(!$username || !$email || !$password){
            die("Error: Missing require fields.");
        }

        // Check if a file is uploaded and available
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file = $_FILES['file']['tmp_name'];

            // Read file data into a variable
            $user_image = file_get_contents($file);

            try {
                // Prepare SQL and bind parameters
                $validRoles = ['customer', 'admin', 'staff']; // Valid roles
                $role = (!empty($_POST['role']) && in_array($_POST['role'], $validRoles)) ? $_POST['role'] : 'customer';

                $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone, full_name, user_image, role) 
                                        VALUES (:username, :email, :password, :phone, :full_name, :user_image, :role)");

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':user_image', $user_image, PDO::PARAM_LOB); // Storing as LOB (large object)
                $stmt->bindParam(':role', $role);

                $stmt->execute();

                $message = "New record created successfully";
            } catch (PDOException $e) {
                $message =  "Error inserting data: " . $e->getMessage();
            }
        } else {
            $message =  "Error: Please upload a valid file.";
        }

        // Close the connection
        $conn = null;
    }
} else {
    $message =  "Error: Database connection is not available.";
}


// Redirect with a message
header('Location: ../show_message.php?type=Registration&message=' . $message);  // Use urlencode to encode the message for safe URL passing
exit();  // Always use exit after a redirect to stop further execution