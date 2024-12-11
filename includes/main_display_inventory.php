<div class="container mt-3">
    <h2 class="site-font">Here is the inventory</h2>
      <div class="card">
          <div class="card-body">
              <?php
              // Include the product list page directly within this container
              include('./layer_presentation/productList.php'); 
              ?>
          </div>
      </div>

    
       
      <div class = "card text-center" style = "width: 10rem;">
        <img src = "<?php echo $userImage; ?>" class = "card-img-top" alt = " Name">
        <div class = "card-body">

    <!-- Display who is logged in and their role -->
        <p class = "text-uppercase font-weight-bold" > You are A <?php echo $role; ?>
    </p>
        </div>
      </div>
</div>
