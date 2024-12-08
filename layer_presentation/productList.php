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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS with Bootstrap styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Product List</h1>
        </div>
        <div class="table-responsive mt-3">
            <table id="productTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
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
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {    
        $('#productTable').DataTable({
            responsive: true,
            autoWidth: false,
            paging: true,
            searching: true,
            dom: '<"top"f>rt<"bottom"lp><"clear">',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search products..."
            }
        });
    });
    </script>
</body>

</html>