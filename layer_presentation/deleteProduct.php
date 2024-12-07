<?php
require_once '../layer_business_logic/ProductController.php';

$error_message = '';
$success_message = '';
$name = $price = $description = '';
$product_id = null;

$controller = new ProductController();

if (isset($_GET['product_id'])) {
    $product_id = filter_var($_GET['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $product = $controller->viewProduct($product_id);

    if ($product) {
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
    } else {
        $error_message = "Product not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);

    if ($controller->deleteProduct($product_id)) {
        $success_message = "Product deleted successfully!";
        header("Location: productList.php");
        exit();
    } else {
        $error_message = "Failed to delete product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete This Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">Delete This Product</h1>
            </div>
            <div class="card-body">
                <?php if ($error_message): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php elseif ($success_message): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <?php if ($product): ?>
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($product['id']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                <?php endif; ?>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
                <a href="productList.php" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="deleteProduct.php" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>