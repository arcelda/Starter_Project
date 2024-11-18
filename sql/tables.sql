CREATE TABLE users (
  id int(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(15) NOT NULL,
  password varchar(255) NOT NULL,
  full_name varchar(100) DEFAULT NULL,
  role ENUM('admin', 'staff', 'customer') NOT NULL,
  FileData longblob DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id)
);

CREATE TABLE transactions (
  id int(17) UNSIGNED NOT NULL AUTO_INCREMENT,
  customer_id int(13),
  ordered_products varchar(255) NOT NULL,
  total_cost varchar(15) NOT NULL,
  transaction_d_t date_time NOT NULL,
  status ENUM('completed', 'canceled', 'shipped') NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (customer_id) REFERENCES users(id)
);

CREATE TABLE products (
  product_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price varchar(15) NOT NULL,
  description varchar(255) DEFAULT NULL,
  PRIMARY KEY (product_id)
);

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);