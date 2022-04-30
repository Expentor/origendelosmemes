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

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    isAdmin Boolean
);

INSERT INTO users (username, email, password) VALUES ("Adair", "adair@adair.com", "hola123", "1");

DROP TABLE IF EXISTS articles;

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    publish_date DATE,
    author VARCHAR(50),
    picture VARCHAR(100),
    origin VARCHAR(50),
    information TEXT,
    links VARCHAR(255)
);

CREATE TABLE image (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(100)
);
    -- email VARCHAR(255),
    -- password VARCHAR(255),
    -- isAdmin TINYINT


INSERT INTO users (username, email, password) VALUES ("Adair", "adair@adair.com", "hola123");
INSERT INTO admins (username, email, password, isAdmin) VALUES ("Adair", "adair@gmail.com", "vbnfgh213", True);
INSERT INTO articles (publish_date, title, information, links) VALUES ("2022-04-27", "Jinx the cat", "jinx is a cat with big green eyes", "https://twitter.com/bigfootjinx");

