-- Create Database
CREATE DATABASE IF NOT EXISTS apartment_system;
USE apartment_system;

-- Users Table (Tenants)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admins Table
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100)
);

-- Apartments Table
CREATE TABLE apartments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    block VARCHAR(50),
    floor VARCHAR(10),
    type VARCHAR(50),
    rent DECIMAL(10, 2),
    status VARCHAR(20) DEFAULT 'available'
);

-- Bookings Table
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    apartment_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (apartment_id) REFERENCES apartments(id) ON DELETE CASCADE
);

-- Payments Table
CREATE TABLE payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    amount DECIMAL(10, 2),
    payment_mode VARCHAR(50),
    status VARCHAR(20) DEFAULT 'pending',
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Maintenance Table
CREATE TABLE maintenance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    issue_type VARCHAR(100),
    description TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Feedback Table
CREATE TABLE feedback (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    rating INT,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Sample Data
INSERT INTO admins (email, password, name) VALUES 
('admin@apartment.com', '$2y$10$SomeHashedPassword123456789', 'Admin');

INSERT INTO users (name, email, password, contact) VALUES 
('John Tenant', 'tenant@apartment.com', '$2y$10$SomeHashedPassword123456789', '9876543210');

INSERT INTO apartments (block, floor, type, rent, status) VALUES 
('A', '1', '1BHK', 15000, 'available'),
('A', '2', '2BHK', 25000, 'available'),
('B', '1', '1BHK', 15000, 'booked'),
('B', '2', '3BHK', 35000, 'available');
