CREATE DATABASE telefoot;

USE telefoot;

CREATE TABLE users (
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(20),
    lastname VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(255)
)


CREATE TABLE password_reset (
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255),
    token VARCHAR(100)
)