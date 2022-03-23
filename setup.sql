DROP DATABASE IF EXISTS userOrigenDeLosMemes;

CREATE DATABASE userOrigenDeLosMemes;

USE userOrigenDeLosMemes;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    age INT(3)
);

INSERT INTO users (username, email, password, age) VALUES ("Adair", "adair@adair.com" "hola123", "19");