<div class="container mt-3">
  <h2>Create a Table</h2>
  <div class="card">
    <div class="card-body">

      <?php
      // Check if $conn is defined and available
      if (isset($conn)) {
        // Database name
        $dbname = "myDBPDO";

        try {
          // Select the database
          $conn->exec("USE $dbname");

          // Check if the table exists
          $result = $conn->query("SHOW TABLES LIKE 'MyGuest'");
          if ($result->rowCount() > 0) {
            // Table exists, display a message
            echo "Table tableName already exists.";
          } else {
            include './includes/main_insert_table_name.php';
            // Table doesn't exist, so create it
                $sql = "CREATE TABLE :table_name (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
              )";

            // Use exec() because no results are returned
            $conn->exec($sql);
            echo "<p>Table tableName created successfully.</p>";
          }
        } catch (PDOException $e) {
          echo "<p>Error creating table: " . $e->getMessage() . '</p>';
        }

        // Close the connection
        $conn = null;
      } else {
        echo "<p>Database connection not established.</p>";
      }
      ?>

    </div>
  </div>
</div>