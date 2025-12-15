-- Create database
CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

-- Create table
CREATE TABLE IF NOT EXISTS restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name   VARCHAR(100) NOT NULL,
    meal   VARCHAR(50)  NOT NULL,
    rating INT          NOT NULL
);

-- Sample data
INSERT INTO restaurants (name, meal, rating) VALUES
('Pizza Palace',   'pizza',    5),
('Burger Town',    'burger',   4),
('Shawarma House', 'shawarma', 5),
('Pasta Corner',   'pasta',    4),
('Sushi Spot',     'sushi',    5),
('Falafel King',   'falafel',  4),
('Grill Master',   'bbq',      5);
