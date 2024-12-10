<?php
require_once '../layer_business_logic/UserController.php';

$controller = new UserController();
$error_message = '';
$success_message = '';
$username = $email = $phone = $full_name = $role = ''; // Default empty values

// Check if id is set in the URL for initial loading
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $user = $controller->viewUser($id);

    if ($user) {
        // Populate variables with product data
        $username = $user['username'];
        $email = $user['email'];
        $phone = $user['phone'];
        $full_name = $user['full_name'];
        $role = $user['role'];
    } else {
        $error_message = "User not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission to update user
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $full_name = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $originalPhone = filter_var($_POST['original_phone'], FILTER_SANITIZE_STRING);
    $originalRole = filter_var($_POST['original_role'], FILTER_SANITIZE_STRING);

    if (empty($role)) {
        // If the role field is empty (not selected), use the original role
        $role = $originalRole;
    }

    if (empty($phone)) {
        // If the role field is empty (not selected), use the original role
        $phone = $originalPhone;
    }

    if ($controller->updateUser($id, $username, $email, $phone, $full_name, $role)) {
        $success_message = "User updated successfully!";
    } else {
        $error_message = "Failed to update user.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-3">
            <a href='../display_users.php' class='btn btn-secondary'>Back to Users</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Update User</h2>

                <?php if (!empty($error_message)): ?>
                    <p class="text-danger text-center"><?php echo $error_message; ?></p>
                <?php elseif (!empty($success_message)): ?>
                    <p class="text-success text-center"><?php echo $success_message; ?></p>
                <?php else: ?>
                    <form method="POST" action="editUser.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                        <div class="mb-3">
                            <label for="username" class="form-label">User Name:</label>
                            <input type="text" id="username" name="username" class="form-control" required
                                value="<?php echo htmlspecialchars($username); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" id="email" name="email" class="form-control" required
                                value="<?php echo htmlspecialchars($email); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" id="phone" name="phone" class="form-control" required
                                value="<?php echo htmlspecialchars($phone); ?>">
                            <input type="hidden" name="original_phone" value="<?php echo htmlspecialchars($phone); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name:</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" required
                                value="<?php echo htmlspecialchars($full_name); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Select Role:</label>
                            <select name="role" id="role">
                                <option disabled selected value></option>
                                <option value="customer" <?php echo $role === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                <option value="admin" <?php echo $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="staff" <?php echo $role === 'staff' ? 'selected' : ''; ?>>Staff</option>
                            </select>
                            <input type="hidden" name="original_role" value="<?php echo htmlspecialchars($role); ?>">
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-success" value="Update User">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>