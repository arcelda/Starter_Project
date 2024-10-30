<div class="container mt-3">
  <h2>Insert Data into Table</h2>
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

          try {
            // SQL statement to insert a new record into MyGuests table
            $sql = "INSERT INTO MyGuests (firstname, lastname, email)
                    VALUES ('John', 'Doe', 'john@example.com')";

            // Use exec() because no results are returned
            $conn->exec($sql);
            echo "<p>New record created successfully</p>";
          } catch (PDOException $e) {
            // Handle insert statement errors
            echo "Error inserting record: " . $e->getMessage();
          }
        } catch (PDOException $e) {
          // Handle database selection errors
          echo "<p>Error selecting database: " . $e->getMessage() . '</p>';
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