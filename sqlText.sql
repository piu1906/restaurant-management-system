DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_name TEXT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    mob_no VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
