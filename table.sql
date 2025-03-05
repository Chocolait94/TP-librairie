CREATE DATABASE librairie; 
USE librairie;

-- Création des tables users
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Création des tables books 
CREATE TABLE books(
    id SERIAL PRIMARY KEY, -- serial = auto_increment 
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(5,2) NOT NULL,
    stock INT NOT NULL
);
-- Création des tables favorites 
CREATE TABLE favorites(
    id SERIAL PRIMARY KEY, -- serial = auto_increment
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

ALTER TABLE users ADD name VARCHAR(255); -- Ajout d'une colonne name dans la table users
ALTER TABLE users ADD firstname VARCHAR(255); -- Ajout d'une colonne firstname dans la table users 