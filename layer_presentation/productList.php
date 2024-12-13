<?php

require_once __DIR__ . '/../layer_business_logic/ProductController.php';

$controller = new ProductController();
$products = $controller->listProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS with Bootstrap styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- productTable -->
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="register-page-font">Product List</h1>
        </div>
        <div class="table-responsive mt-3">
            <table id="productTable" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                        <th>Add to Cart</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { 
                        $product_image = $product['product_image']; // Assuming 'product_image' is the column for image path
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($product['description']); ?></td>
                            <td>
                                <?php if (!empty($product_image)): ?>
                                    <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="layer_presentation/addProduct.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-add"></i>
                                    </a>
                                <?php endif; ?>
                                 <a href="layer_presentation/viewProduct.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="layer_presentation/editProduct.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="layer_presentation/deleteProduct.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Quantity controls -->
                                <div class="input-group mb-3" style="max-width: 150px;">
                                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                    <input type="number" class="form-control text-center quantity-input" 
                                        value="1" min="1" max="100" 
                                        data-product-id="<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                </div>
                                <!-- Add to Cart Form -->
                                <form method="POST" action="layer_presentation/add_to_cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="hidden" name="quantity" value="1"> <!-- Set default to 1 -->
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Add to Cart
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } // End of the foreach loop ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery, Bootstrap JS, and DataTables JS -->
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- productTable 
    <link rel="stylesheet" href="css/styles.css">-->
    <script>
    $(document).ready(function() {    
        $('#productTable').DataTable({
            responsive: true,
            pageLength: 10 // Default number of rows per page
        });
    });
    </script>

    <script>
        $(document).ready(function() {
            // Synchronize visible input with the hidden field
            $('.quantity-input').on('input', function() {
                const form = $(this).closest('form');
                form.find('input[name="quantity"]').val($(this).val());
            });

            // Increment quantity
            $('.plus-btn').on('click', function() {
                const input = $(this).siblings('.quantity-input');
                const currentValue = parseInt(input.val()) || 1;
                input.val(currentValue + 1).trigger('input');
            });

            // Decrement quantity
            $('.minus-btn').on('click', function() {
                const input = $(this).siblings('.quantity-input');
                const currentValue = parseInt(input.val()) || 1;
                if (currentValue > 1) {
                    input.val(currentValue - 1).trigger('input');
                }
            });
        });
    </script>
</body>

</html>