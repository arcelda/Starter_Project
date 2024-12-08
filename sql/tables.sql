CREATE TABLE users (
  id int(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(15) NOT NULL,
  password varchar(255) NOT NULL,
  full_name varchar(100) DEFAULT NULL,
  role ENUM('admin', 'staff', 'customer') NOT NULL,
  user_image longblob DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id)
);

ALTER TABLE users 
MODIFY COLUMN role VARCHAR(50) DEFAULT 'customer', 
ADD CONSTRAINT chk_roles CHECK (role IN ('customer', 'admin', 'staff'));

CREATE TABLE customer(
   id int(13) UNSIGNED NOT NULL,
   customer_id int(13) NOT NULL AUTO_INCREMENT,
   full_name varchar(100) REFERENCES users(full_name),
   username varchar(50) REFERENCES users(username),
   email varchar(100) REFERENCES users(email),
   phone varchar(15) REFERENCES users(phone),
   password varchar(255) REFERENCES users(password),
   role ENUM('customer'),
   PRIMARY KEY (customer_id),
   FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE transactions (
  customer_id int(13) NOT NULL,
  transaction_id int(17) UNSIGNED NOT NULL AUTO_INCREMENT,
  ordered_products varchar(255) NOT NULL,
  total_cost varchar(15) NOT NULL,
  transaction_d_t DATETIME NOT NULL,
  status ENUM('completed', 'canceled', 'shipped') NOT NULL,
  PRIMARY KEY (transaction_id),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE products (
  product_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price DECIMAL(10,2),
  description varchar(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (product_id)
);

/* This is the table with images, do not use yet*/
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