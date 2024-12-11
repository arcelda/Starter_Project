CREATE TABLE users (
  id INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(15) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100) DEFAULT NULL,
  role ENUM('admin', 'staff', 'customer') NOT NULL DEFAULT 'customer',
  user_image LONGBLOB DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id)
);
/* This ensures that duplicate values cannot be inserted into these columns moving forward.
ALTER TABLE users
ADD UNIQUE (username),
ADD UNIQUE (email),
ADD UNIQUE (phone);

ALTER TABLE users 
MODIFY COLUMN role VARCHAR(50) DEFAULT 'customer', 
ADD CONSTRAINT chk_roles CHECK (role IN ('customer', 'admin', 'staff'));*/

CREATE TABLE customer (
   id INT(13) UNSIGNED NOT NULL,
   customer_id INT(13) NOT NULL AUTO_INCREMENT,
   PRIMARY KEY (customer_id),
   FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE transactions (
  customer_id INT(13) NOT NULL,
  transaction_id INT(17) UNSIGNED NOT NULL AUTO_INCREMENT,
  ordered_products JSON NOT NULL,
  total_cost VARCHAR(15) NOT NULL,
  transaction_d_t DATETIME NOT NULL,
  status ENUM('completed', 'canceled', 'shipped') NOT NULL,
  PRIMARY KEY (transaction_id),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);
/*
ALTER TABLE transactions
MODIFY COLUMN ordered_products JSON NOT NULL;*/

CREATE TABLE `cart` (
    `cart_item_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(13) UNSIGNED NOT NULL,     -- Ensure the user_id matches users(id) in type and size
    `product_id` INT(11) UNSIGNED NOT NULL,  -- Ensure the product_id matches products(product_id) in type and size
    `quantity` INT DEFAULT 1,
    PRIMARY KEY (`cart_item_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),  -- Ensure the reference is correct
    FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`),  -- Ensure the reference is correct
    UNIQUE(`user_id`, `product_id`)  -- Ensure user-product uniqueness
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE products (
  product_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price DECIMAL(10,2),
  description varchar(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  product_image varchar(255) DEFAULT NULL,
  PRIMARY KEY (product_id)
);

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);