<?php
require_once '../layer_business_logic/ProductController.php';

$controller = new ProductController();
$error_message = '';
$success_message = '';
$name = $price = $description = ''; // Default empty values

// Check if product_id is set in the URL for initial loading
if (isset($_GET['product_id'])) {
    $product_id = filter_var($_GET['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $product = $controller->viewProduct($product_id);

    if ($product) {
        // Populate variables with product data
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
    } else {
        $error_message = "Product not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission to update product
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    if ($controller->updateProduct($product_id, $name, $price, $description)) {
        $success_message = "Product updated successfully!";
    } else {
        $error_message = "Failed to update product.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-3">
            <a href="addProduct.php" class="btn btn-primary">Add New Product</a>
            <a href='productList.php' class='btn btn-secondary'>Back to Products</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Update Product</h2>

                <?php if (!empty($error_message)): ?>
                    <p class="text-danger text-center"><?php echo $error_message; ?></p>
                <?php elseif (!empty($success_message)): ?>
                    <p class="text-success text-center"><?php echo $success_message; ?></p>
                <?php else: ?>
                    <form method="POST" action="editProduct.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required
                                value="<?php echo htmlspecialchars($name); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" id="price" name="price" class="form-control" required
                                value="<?php echo htmlspecialchars($price); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required><?php echo htmlspecialchars($description); ?></textarea>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-success" value="Update Product">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>