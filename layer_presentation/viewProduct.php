<?php
require_once '../layer_business_logic/ProductController.php';

$error_message = '';
$success_message = '';
$name = $price = $description = ''; // Default empty values
$product_image = ''; // Default image path

// Check if product_id is set in the URL for initial loading
if (isset($_GET['product_id'])) {
    $product_id = filter_var($_GET['product_id'], FILTER_SANITIZE_NUMBER_INT);

    if ($product_id > 0) {
        $controller = new ProductController();
        $product = $controller->viewProduct($product_id);

        if ($product) {
            // Successfully fetched product details
            $name = $product['name'];
            $price = $product['price'];
            $description = $product['description'];
            $product_image = $product['product_image']; // Assuming image is stored in the 'image' column
        } else {
            $error_message = "Product not found for ID: $product_id";
        }
    } else {
        $error_message = "Invalid product ID.";
    }
} else {
    $error_message = "No product ID specified in the URL.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">Product Details</h1>
            </div>
            <div class="card-body">
                <?php if ($error_message): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <p><strong>Product ID:</strong> <?php echo htmlspecialchars($product['product_id']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Image Path Debug:</strong> <?php echo htmlspecialchars($product_image); ?></p>

                
                <p><strong>Image:</strong>
                    <?php if (!empty($product_image)): ?>
                        <img src="http://localhost/Starter_Project/<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                </p>
            </div>
            <div class="card-footer text-end">
                <a href="editProduct.php?product_id=<?php echo $product_id; ?>" class="btn btn-warning">Edit</a>
                <a href="../display_inventory.php" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>