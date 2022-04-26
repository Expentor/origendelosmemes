DROP DATABASE IF EXISTS userOrigenDeLosMemes;

DROP TABLE IF EXISTS users;

CREATE DATABASE userOrigenDeLosMemes;

USE userOrigenDeLosMemes;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
);

INSERT INTO users (username, email, password) VALUES ("Adair", "adair@adair.com", "hola123");