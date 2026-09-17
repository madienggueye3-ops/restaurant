CREATE DATABASE IF NOT EXISTS restaurant_delice
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE restaurant_delice;

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30) NOT NULL,
    email VARCHAR(150),
    date_reservation DATE NOT NULL,
    heure_reservation TIME NOT NULL,
    nombre_personnes INT NOT NULL,
    message TEXT,
    statut ENUM('En attente', 'Confirmée', 'Annulée') DEFAULT 'En attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);