CREATE DATABASE IF NOT EXISTS ace_tennis;
USE ace_tennis;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    image VARCHAR(255),
    sizes VARCHAR(100)
);


INSERT INTO products (name, description, price, image, sizes) VALUES 
('Pro Aero Shirt', 'Breathable white polo for traditional play.', 29.99, 'pro_aero.png', 'S, M, L, XL'),
('Clay Pro Performance Tee', 'Moisture-wicking fabric in clay orange.', 34.99, 'clay_pro.png', 'S, M, L, XL'),
('Classic Grass Court Polo', 'Ultra-lightweight mesh shirt for maximum speed.', 24.50, 'grass_polo.png', 'S, M, L, XL');