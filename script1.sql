
CREATE TABLE utilisateurs (
    idUtilisateurs INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL, 
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    nom_complet VARCHAR(100) GENERATED ALWAYS AS (CONCAT(prenom, ' ', nom)) STORED,
    adresse VARCHAR(255),
    telephone VARCHAR(20),
    
    INDEX(email)
);

CREATE TABLE Timbre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_creation YEAR, 
    couleurs VARCHAR(100), 
    pays_origine VARCHAR(100),
    image_principale VARCHAR(255), 
    images_supplementaires TEXT, 
    etat ENUM('Parfaite', 'Excellente', 'Bonne', 'Moyenne', 'Endommagé') NOT NULL,
    tirage INT,
    dimensions VARCHAR(50),
    certifie BOOLEAN NOT NULL DEFAULT FALSE
);


CREATE TABLE Enchere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timbre_id INT NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    coups_de_coeur BOOLEAN DEFAULT FALSE,
    archivee BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (timbre_id) REFERENCES Timbre(id) ON DELETE CASCADE,
    INDEX(date_debut),
    INDEX(date_fin)
);


CREATE TABLE Offre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enchere_id INT NOT NULL,
    membre_id INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date_offre DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enchere_id) REFERENCES Enchere(id) ON DELETE CASCADE,
    FOREIGN KEY (membre_id) REFERENCES Membre(id) ON DELETE CASCADE,
    INDEX(enchere_id),
    INDEX(membre_id)
);

CREATE TABLE Image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timbre_id INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    principale BOOLEAN DEFAULT FALSE, 
    description VARCHAR(255), 
    ordre INT DEFAULT 0, 
    FOREIGN KEY (timbre_id) REFERENCES Timbre(id) ON DELETE CASCADE,
    INDEX(timbre_id)
);


