-- Active: 1733819346903@@127.0.0.1@3306@youdemy_db


-- céation de la base de données :
CREATE DATABASE IF NOT EXISTS Youdemy_db ;

-- utiliser la base de données "Youdemy_db" :
use Youdemy_db ;

-- vérifier l'éxistance des tables :
show TABLES;




-- la cr&ation des tables : ==============================================================================================================================================

-- Tables utilisateurs :
CREATE TABLE utilisateurs (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    motDePasse VARCHAR(255) NOT NULL,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    photo VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Etudiant', 'Enseignant') NOT NULL,
    status ENUM('Suspendu', 'Activer') DEFAULT 'Activer'
);


-- Table enseignants :
CREATE TABLE enseignants (
    -- id_enseignant INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL PRIMARY KEY,
    estValide BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (id_user) REFERENCES utilisateurs(id_user) ON DELETE CASCADE
);

-- Table categorie :
CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    titre_categorie VARCHAR(255) NOT NULL
);

-- Table cours : (text - video)
CREATE TABLE cours (
    id_cours INT AUTO_INCREMENT PRIMARY KEY,
    id_enseignant INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(500),
    type_contenu ENUM('Video', 'Texte') NOT NULL,
    contenu_text TEXT DEFAULT NULL, -- si le le contenu est un video ce cahmp doit etre null
    contenu_video VARCHAR(255) DEFAULT NULL, -- si le contenu est un text , ce champ doit etre null
    date_de_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_categorie INT DEFAULT NULL,
    photo VARCHAR(255) NOT NULL,
    -- photo BLOB DEFAULT NULL,
    -- mime VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_enseignant) REFERENCES enseignants(id_user) ON DELETE CASCADE
);


-- Table inscription cours : 
CREATE TABLE inscription_cours (
    id_inscription INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_cours INT NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES utilisateurs(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES cours(id_cours) ON DELETE CASCADE,
    UNIQUE (id_user, id_cours)
);

-- Table tags :
CREATE TABLE tags (
    id_tag INT AUTO_INCREMENT PRIMARY KEY,
    nom_tag VARCHAR(255) NOT NULL
);

-- Table cours_tags : 
CREATE TABLE cours_tags (
    id_cours INT NOT NULL,
    id_tag INT NOT NULL,
    PRIMARY KEY (id_cours, id_tag),
    FOREIGN KEY (id_cours) REFERENCES cours(id_cours) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE
);


-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


