<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

require_once __DIR__ . '/../layer_business_logic/CartController.php';

// Check if the user is logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve user_id from the session
$user_id = $_SESSION['user_id']; 

$controller = new CartController();
$cart_data = $controller->viewCart(); // No need to pass user_id here

// Check if data is returned and handle the result accordingly
if ($cart_data && isset($cart_data['cartItems']) && isset($cart_data['cartTotal'])) {
    $cartItems = $cart_data['cartItems']; // Access cart items
    $cartTotal = $cart_data['cartTotal']; // Access cart total
} else {
    $cartItems = []; // If no cart data, set to empty array
    $cartTotal = 0;   // Set cart total to 0 if no items are found
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1 class="register-page-font">Your Cart</h1>
        <div class="cart-container">
            <table id="cartTable" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($cartItems)): ?>
                        <tr>
                            <td colspan="5" class="cart-message">Your cart is empty.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($item['price']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity'] * $item['price']); ?></td>
                                <td>
                                    <a href="./layer_presentation/remove_from_cart.php?cart_item_id=<?php echo $item['cart_item_id']; ?>" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <h3>Total: <?= number_format($cartTotal, 2) ?></h3>

    </div>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cartTable').DataTable({
                responsive: true,
                pageLength: 10 // Default number of rows per page
            });
        });
    </script>
</body>

</html>
