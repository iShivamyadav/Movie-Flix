

CREATE DATABASE moviesrating;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at VARCHAR(5),
    email VARCHAR(55),
    website VARCHAR(55),
    about VARCHAR(255),
    gender VARCHAR(50) NOT NULL,
    avengers INT NOT NULL,
    inception INT NOT NULL,
    godfather INT NOT NULL,
    mrrobot INT NOT NULL,
    xfiles INT NOT NULL,
    friends INT NOT NULL
);