DROP DATABASE IF EXISTS userOrigenDeLosMemes;

CREATE DATABASE userOrigenDeLosMemes;

USE userOrigenDeLosMemes;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    picture VARCHAR(255)
);

DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    picture VARCHAR(255),
    isAdmin Boolean
);

DROP TABLE IF EXISTS articles;

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    subtitle VARCHAR(50),
    publish_date DATE,
    author VARCHAR(50),
    picture VARCHAR(255),
    origin VARCHAR(50),
    category VARCHAR(50),
    information TEXT,
    links VARCHAR(255),
    isPublished BOOLEAN
);

CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_articles INT FOREIGN KEY,
    likes INT,
    dislikes INT
);

DROP TABLE IF EXISTS comments;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    author VARCHAR(255) DEFAULT NULL,
    profile_picture VARCHAR(255),
    comments TEXT DEFAULT NULL,
    datecom datetime NOT NULL DEFAULT current_timestamp(),
    post_id INT NOT NULL
);