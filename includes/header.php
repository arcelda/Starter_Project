<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the index page if not logged in
    header('Location: index.php');
    exit();
}

// Retrieve user data from the session
$fullName = $_SESSION['full_name'];
$userImage = $_SESSION['user_image'];
$role = $_SESSION['role'];
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Background Image Container */
    .bg-container {
        width: 25%;
        height: 150px; /* Set a fixed height for the background image */
        background-image: url('./images_non_inventory/ccsuLogo.jpg'); /* Path to your image */
        background-repeat: no-repeat;
        background-size: contain; /* Adjust to keep the image small */
        background-position: left; /* Center the image */
        margin-bottom: 1rem; /* Add space below the background image */
    }

    h1 {
        margin-top: 0;
        width: 70%;
    }

    /* User Info (Profile) container */
    .user-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
    }

    .user-info img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin: 5px 0;
    }

    .logout-link {
        margin-top: 5px;
        font-size: 14px;
    }

    /* Checkout Cart container */
    .checkout-cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
    }

    .checkout-cart img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin: 5px 0;
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        header {
            padding: 2rem;
        }

        .user-info, .checkout-cart {
            align-items: center; /* Center them on smaller screens */
            margin-top: 10px; /* Add space between elements */
        }
    }
</style>

<header>
    <!-- Background Image Container -->
    <div class="bg-container"></div>

    <h1>Maria Sanford Marketplace</h1>

    <!-- Checkout Cart -->
    <div class="checkout-cart">
        <a href="display_cart.php">
            <img src="./images_non_inventory/checkout_cart.png" alt="Head to your cart">
        </a>
    </div>

    <!-- User Info (If logged in) -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="user-info">
            <span><?php echo htmlspecialchars($fullName); ?></span>
            <?php if (!empty($userImage)): ?>
                <img src="<?php echo htmlspecialchars($userImage); ?>" alt="User Image">
            <?php endif; ?>
            <a href="logout.php" class="logout-link text-decoration-none text-white">Logout</a>
        </div>
    <?php endif; ?>
</header>
