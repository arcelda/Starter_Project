-- Users
INSERT INTO users (username, email, phone, password, full_name, role) VALUES
('jandoe002', 'janejdoe@gmail.com', '222-465-1379', 'password@123', 'Jane Doe', 'staff'),
('ricthomas003', 'richardthomasjr@gmail.com', '222-312-0357', 'password@123', 'Richard Thomas', 'staff'),
('johndoe55', 'johnmdoe@gmail.com', '222-123-6789', 'password@123', 'John Doe', 'customer'),
('marrybarry85', 'marybclark@gmail.com', '233-852-9105', 'password@123', 'Mary Clark', 'customer'),
('cooldudez95', 'supercooldudez95@gmail.com', '222-349-8264', 'password@123', 'Matt Dudez', 'customer');

INSERT INTO products (name, price, description, product_image) VALUES
('Black CCSU Hoodie', 34.99, 'One of our more popular items!', 'images/black_CCSU_hoodie.jpg'),
('Blue CCSU Shirt', 19.99, 'One of our more popular items!', 'images/blue_CCSU_shirt.jpg'),
('Gray CCSU hoodie', 29.99, 'One of our more popular items!', 'images/gray_CCSU_hoodie.jpg'),
('Gray CCSU V-neck', 19.99, 'One of our more popular items!', 'images/gray_CCSU_v_neck.jpg'),
('CCSU Hat', 24.99, 'One of our more popular items!', 'images/hat_CCSU.jpg'),
('CCSU Leggings', 24.99, 'One of our more popular items!', 'images/leggings_CCSU.jpg');

-- Cart
INSERT INTO cart (user_id, product_id, quantity) VALUES
(1, 2, 1),
(2, 3, 2);

-- Customer (assuming users with id 1, 2, 3 are customers)
INSERT INTO customer (id) VALUES
(1),
(2),
(3);

INSERT INTO users (username, email, phone, password, full_name, role)
VALUES
('admin01', 'admin@example.com', '1234567890', 'securepassword', 'Admin User', 'admin'),
('customer01', 'customer@example.com', '0987654321', 'securepassword', 'Customer User', 'customer');

/* If you have duplicates of the account use these */

SELECT username, COUNT(*) AS count FROM users
GROUP BY username
HAVING count > 1;

DELETE FROM users
WHERE id NOT IN (
  SELECT MIN(id)
  FROM users
  GROUP BY username
);
