/* CREATING TABLES FOR DATABASE*/

CREATE TABLE product_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) UNIQUE,
    description TEXT
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    description TEXT,
    price DECIMAL(10, 2),
    category_id INT,
    stock_quantity INT,
    image_url VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES product_categories(category_id)
);

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    address VARCHAR(255),
    phone_number VARCHAR(15),
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2),
    status VARCHAR(20),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    stock_quantity INT,
    reorder_threshold INT,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    first_name VARCHAR(50),
    last_name VARCHAR(50)
);

/*
VALUES FOR THE TABLES */

INSERT INTO product_categories (category_name, description) VALUES
    ('Cardio Equipment', 'Machines for cardiovascular exercises'),
    ('Strength Training', 'Weights and resistance equipment'),
    ('Classes', 'Scheduled fitness classes');


INSERT INTO products (product_name, description, price, category_id, stock_quantity, image_url) VALUES
    ('Treadmill', 'High-quality treadmill for running and walking', 999.99, 1, 10, 'treadmill.jpg'),
    ('Dumbbells Set', 'Set of adjustable dumbbells for strength training', 249.99, 2, 20, 'dumbbells.jpg'),
    ('Yoga Mat', 'Premium yoga mat for comfortable workouts', 29.99, 3, 50, 'yoga_mat.jpg');


INSERT INTO customers (first_name, last_name, email, password, address, phone_number) VALUES
    ('Ahmad', 'Alkhaled', 'ahmad.alkhaled@email.com', 'hashedpassword123', '123 Main St, Birmingham, UK', ‘+44 2071234567’),
    ('Sultan', 'Altareq', 'ahmad.altareq@email.com', 'hashedpassword456', '456 Oak St, Birmingham, UK', ‘+44 3071234567’);


INSERT INTO orders (customer_id, total_price, status) VALUES
    (1, 112.98, 'Processing'),
    (2, 29.99, 'Shipped');


INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES
    (1, 1, 1, 999.99),
    (2, 3, 1, 29.99);


INSERT INTO inventory (product_id, stock_quantity, reorder_threshold) VALUES
    (1, 10, 5),
    (2, 20, 10),
    (3, 50, 20);


INSERT INTO admins (username, password, first_name, last_name) VALUES
    ('admin', 'adminpassword', 'Admin', 'User');
