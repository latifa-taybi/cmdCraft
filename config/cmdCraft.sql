CREATE DATABASE cmdCraft; 
use cmdCraft;

CREATE TABLE users(
    id_user int AUTO_INCREMENT PRIMARY KEY,
    name varchar(50),
    email varchar(50),
    mot_de_passe varchar(50),
    role ENUM('client', 'admin') NOT NULL,
    is_active boolean DEFAULT 1
);

CREATE TABLE product(
    id_product int AUTO_INCREMENT PRIMARY KEY,
    name varchar(50),
    description varchar(500),
    prix decimal,
    quantite int,
    image varchar(255)
);

CREATE TABLE commande(
    id_commande int AUTO_INCREMENT PRIMARY KEY,
    date_commande date,
    prixTotal decimal,
    id_user int,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE detailCommande(
    id_product int,
    id_commande int,
    FOREIGN KEY (id_product) REFERENCES product(id_product),
    FOREIGN KEY (id_commande) REFERENCES commande(id_commande),
    quantite int
);