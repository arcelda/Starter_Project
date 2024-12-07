<?php
include './includes/conn.php';
// require '../layer_presentation/editUser.php';
// require '../layer_presentation/deleteUser.php';

// Check if the database connection is available
if (isset($conn)) {
    $dbname = "myDBPDO";

    try {
        // Select the database
        $conn->exec("USE $dbname");

        // Fetch all users from the 'users' table
        $stmt = $conn->query("SELECT id, username, email, phone, full_name, role FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p>Error fetching users: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Error: Database connection not available.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <style>
        /* Basic table styling */
        table.dataTable {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table.dataTable th,
        table.dataTable td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table.dataTable th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User List</h1>

        <table id="userTable" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Full Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <a href="editUser.php?id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="deleteUser.php?id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables with search, pagination, and responsiveness
            $('#userTable').DataTable({
                responsive: true,
                pageLength: 10 // Default number of rows per page
            });
        });
    </script>
</body>

</html>