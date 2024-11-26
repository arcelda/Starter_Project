<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management System</title>
    <link rel="icon" type="image/x-icon" href="./includes/favicon.ico">

    <link rel="stylesheet" href="css/styles.css">


</head>

<body>

    <?php include './includes/header.php'; ?>
    <div class="container-fluid content-wrapper d-flex flex-column flex-grow-1">
        <div class="row flex-grow-1">
           <?php
                /*$user_id = $_SESSION['user_id'];
                $query = "SELECT user_type FROM users WHERE id = $user_id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);*/

                if ((isset($_SESSION['role']) &&  $_SESSION['role'] == 'admin')) { 
                    include './includes/nav_admin.php';
                }
                else if ((isset($_SESSION['role']) &&  $_SESSION['role'] == 'staffs')){
                    include './includes/nav_staff.php';
                }
                else{
                    include './includes/nav.php';
                }
                //include './includes/nav.php';
                
            ?>


            <?php include './includes/main_carousel.php'; ?>
        </div>
    </div>
    <?php include './includes/footer.php'; ?>

</body>

</html>