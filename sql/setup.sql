DROP DATABASE IF EXISTS userOrigenDeLosMemes;

DROP TABLE IF EXISTS users;

CREATE DATABASE userOrigenDeLosMemes;

USE userOrigenDeLosMemes;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    confirm_password VARCHAR(255),
    password VARCHAR(255),
    isAdmin TINYINT
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publish_date DATE,
    title VARCHAR(100),
    information TEXT
);

CREATE TABLE image (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(100)
);
    -- email VARCHAR(255),
    -- password VARCHAR(255),
    -- isAdmin TINYINT


INSERT INTO users (username, email, password) VALUES ("Adair", "adair@adair.com", "hola123", "1");

