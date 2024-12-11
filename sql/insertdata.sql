INSERT INTO users (username, email, phone, password, full_name, role) VALUES
('jandoe002', 'janejdoe@gmail.com', '222-465-1379', 'password@123', 'Jane Doe', 'staff'),
('ricthomas003', 'richardthomasjr@gmail.com', '222-312-0357', 'password@123', 'Richard Thomas', 'staff'),
('johndoe55', 'johnmdoe@gmail.com', '222-123-6789', 'password@123', 'John Doe', 'customer'),
('marrybarry85', 'marybclark@gmail.com', '233-852-9105', 'password@123', 'Mary Clark', 'customer'),
('cooldudez95', 'supercooldudez95@gmail.com', '222-349-8264', 'password@123', 'Matt Dudez', 'customer')

INSERT INTO products (product_id, name, price, description) VALUES
(1, 'Black CCSU Hoodie', 34.99, 'One of our more popular items!'),
(2, 'Blue CCSU Shirt', 19.99, 'One of our more popular items!'),
(3, 'Gray CCSU hoodie', 29.99, 'One of our more popular items!'),
(4, 'Gray CCSU V-neck', 19.99, 'One of our more popular items!'),
(5, 'CCSU Hat', 24.99, 'One of our more popular items!'),
(6, 'CCSU Leggings', 24.99, 'One of our more popular items!');

/* These are with images and will be implemented later*/
INSERT INTO products (product_id, name, price, description, product_image) VALUES
(1, 'Black CCSU Hoodie', 34.99, 'One of our more popular items!', 'images/black_CCSU_hoodie.jpg'),
(2, 'Blue CCSU Shirt', 19.99, 'One of our more popular items!', 'images/blue_CCSU_shirt.jpg'),
(3, 'Gray CCSU hoodie', 29.99, 'One of our more popular items!', 'images/gray_CCSU_hoodie.jpg'),
(4, 'Gray CCSU V-neck', 19.99, 'One of our more popular items!', 'images/gray_CCSU_v_neck.jpg'),
(5, 'CCSU Hat', 24.99, 'One of our more popular items!', 'images/hat_CCSU.jpg'),
(6, 'CCSU Leggings', 24.99, 'One of our more popular items!', 'images/leggings_CCSU.jpg');

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
