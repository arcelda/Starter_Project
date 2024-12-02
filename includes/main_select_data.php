                    <div class="container mt-3">
                        <center>
                            <h2>Select Data</h2>
                        </center>

                        <?php
                        // Check if $conn is defined and available
                        if (isset($conn)) {
                            // Database name
                            $dbname = "myDBPDO";

                            try {
                                // Select the database
                                $conn->exec("USE $dbname");

                                // Execute the query and display results
                                try {
                                    $sql = "SELECT customer_id, full_name FROM users WHERE role IS 'customer'";
                                    $result = $conn->query($sql);

                                    // Check if there are rows returned
                                    if ($result->rowCount() > 0) {
                                        echo "<table style='width:90%; background-color:#68CECB;' class='table table-bordered text-white'><tr><th>ID</th><th>Name</th></tr>";
                                        // Output data of each row
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["full_name"] . "</td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "<p>No results found.</p>";
                                    }
                                } catch (PDOException $e) {
                                    // Handle SQL errors
                                    echo "<p>Error fetching data: " . $e->getMessage() . '</p>';
                                }
                            } catch (PDOException $e) {
                                // Handle database selection errors
                                echo "<p>Error selecting database: " . $e->getMessage() . '</p>';
                            }
                        } else {
                            echo "<p>Database connection not established.</p>";
                        }
                        ?>



                        <?php
                        // This second block is unnecessary because the query has already been run above
                        // You can remove it unless you need it for a different context
                        ?>
                        </center>
                    </div>
                    </div>