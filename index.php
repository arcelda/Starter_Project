

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link type="text/css" rel="stylesheet" href="style2.css"> -->
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./includes/favicon.ico">
    <link rel = "stylesheet" href = "css\styles.css">
</head>

<body>
    <section class = "h-100 gradient-form login-page">
    <div class="container mt-5 py-5 h-100">
        <div class = "row d-flex justify-content-center align-items-center h-100">
            <div class = "col-xl-10">
                <div class = "card rounded-3 text-black"> 
                    <div class = "row g-0 login-page-inner"> 
                        <div class = "card-body p-md-5 mx-md-4">
                            <div class = "text-center login-page-font">
                                <h3 class = " mt-1 mb-5 pb-1"> Maria Sanford Marketplace </h3>
                                <img src = "http://localhost:3000/images_non_inventory/ccsuLogo.jpg" style ="width: 200px;" alt = "logo">    
                                                                    
                                <h2 class="text-center">Login</h2>
                                <div data-mdv-input-init class = "form-outline mb-3">
                                    <div class="row justify-content-center">
                                        <form action="process_login.php" method="POST">
                                            <div class="mb-7">
                                                <label for="username" class="form-label" >Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" class="form-control" id="username" name="username"
                                                    placeholder="Enter your username" required>
                                                </div>
                                            </div>
                                                                      
                                            <div data-mdb-input-init class ="form-outline mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="Enter your password" required>
                                                </div>
                                            </div>

                                            <div class = "text-center pt-1 mb-5 pb-1">
                                                <!--  <button type="submit" class="btn btn-primary w-100"> -->
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block fa-lg gradient-custom-2 mb-3" 
                                                type="submit">
                                                <i class="fas fa-sign-in-alt"></i> Login</button>
                                            </div>
                                                            
                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <button type = "button" data-mdb-button-init data-mdb-ripple-init class = "btn btn-outlien-danger"><p>Don't have an account? <a href="register.php">
                                                    <i class="fas fa-user-plus"></i>Register</a></p></button>
                                            </div>
                                                            </div>
                                        </form>

                                        <div class = "d-flex align-items-center gradient-custom-2">
                                            <div class = "text-white px-3 py-4 p-md-5 mx-md-4">
                                                <h6 class = "mb-4"> This is Our Store Project </h6>
                                                <p class = "small mb-0"> 
                                                    (Add some text explaining the Database of Store and What is sold)
                                                    This store sells clothing to all differnet shapes and sizes of people
                                                    We have Hoodies, garments, and others. We Will add more items as the orders come in.
                                                    
                                                </p>
                                            </div>
                                        </div>
                                               
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>