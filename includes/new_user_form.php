<div class="container mt-3">
    <h2>Add New User to Database</h2>
    <div class="card">
        <div class="card-body register-page-font">
            <!--======================================================================-->
            <form action="./includes/process_registration.php" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                
                <div class="form-group">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" pattern="^[a-zA-Z0-9_]{5,50}$" required>
                    <div><i>Username must be alphanumeric and 5-50 characters long.</i></div>
                </div>

                <div class="form-group">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                </div>

                <div>
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" 
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    <div><i>Numbers only.</i></div>
                </div> <br>

                <div class="form-group">
                    <label for="role">Select Role:</label>
                    <select name="role" id="role" required>
                        <option disabled selected value></option>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" required>
                    <div>
                        <i>Password must be at least 8 characters long, contain at least one letter, one number, and one
                        special character (!@#$%^&*).</i>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label"><i class="fas fa-file-upload"></i> Upload File</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
                    <div>
                        Not required for customers.
                    </div>
                </div>

                <button id="submit_button" type="submit" class="btn btn-default submit-button .submit_button:hover">Submit</button>
            </form>
            <!--======================================================================-->
        </div>
    </div>
</div>