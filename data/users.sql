DROP DATABASE IF EXISTS `blog`;
CREATE DATABASE IF NOT EXISTS `blog`;
USE `blog`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, email, password) VALUES 
('johndoe', 'john.doe@example.com', MD5('password123')),
('janesmith', 'jane.smith@example.com', MD5('securepass456')),
('miketech', 'mike.johnson@example.com', MD5('coder2026!')),
('sarahdev', 'sarah.williams@example.com', MD5('webdev123')),
('alexdata', 'alex.brown@example.com', MD5('database99'));