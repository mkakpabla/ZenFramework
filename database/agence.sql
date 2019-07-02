-- Création de la base de données
DROP DATABASE IF EXISTS agence_immobiliere;
CREATE DATABASE agence_immobiliere;
USE agence_immobiliere;

-- Création de la table properties

DROP TABLE IF EXISTS users;
CREATE TABLE properties(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    rooms INT(2) NOT NULL,
    bedrooms INT(2) NOT NULL,
    floor INT(2) NOT NULL,
    surface INT(2) NOT NULL,
    city VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    postal_code VARCHAR(255) NOT NULL,
    heat VARCHAR(255) NOT NULL,
    price INT(11) NOT NULL,
    sold BOOLEAN NOT NULL DEFAULT 0,
    image VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (id)
);

-- Création de la table users
DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(100) NOT NULL DEFAULT 'agent',
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


-- Insertion de l'administrateur

INSERT INTO users 