<?php

session_start(); // Ensure session is started
require_once '../layer_business_logic/ProductController.php';

$controller = new ProductController();
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $product_id = htmlspecialchars(trim($_POST['product_id']));
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $description = htmlspecialchars(trim($_POST['description']));

    // Handle the image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        // Sanitize file upload
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $file_name = basename($_FILES['product_image']['name']);
        $file_path = "images/" . $file_name; // Folder where the image will be stored

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($file_tmp, "../" . $file_path)) {
            $product_image = $file_path; // Save the relative image path
        } else {
            $error_message = "Failed to upload the image.";
        }
    } else {
        $error_message = "No image uploaded or there was an upload error.";
    }

    // Attempt to add the product
    if (empty($error_message) && $controller->addProduct($name, $price, $description, $product_image)) {
        echo "<div class='alert alert-success'>Product added successfully.</div>";
        header("Location: ../display_inventory.php");
        die();
    } else {
        $error_message = "Failed to add product. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Add Product</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="addProduct.php" enctype="multipart/form-data">
                            <input type="hidden" name="product_id"
                                value="<?php echo isset($_GET['product_id']) ? htmlspecialchars($_GET['product_id']) : ''; ?>">

                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price" required
                                    value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"
                                    required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
                            </div>

                            <!-- Product Image Upload -->
                            <div class="mb-3">
                                <label for="product_image" class="form-label"><i class="fas fa-file-upload"></i> Upload Image File</label>
                                <input type="file" class="form-control" id="product_image" name="product_image">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>