CREATE TABLE utilisateur (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    CIN VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100),
    telephone VARCHAR(20),
    adresse TEXT,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE compte (
    id_compte INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    type ENUM('courant', 'epargne') NOT NULL,
    solde DECIMAL(10, 2),
    statut ENUM('actif', 'bloque'),
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);
CREATE TABLE transaction (
    id_transaction INT AUTO_INCREMENT PRIMARY KEY,
    id_compte INT NOT NULL,
    type ENUM('depot', 'retrait') NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    solde_apres DECIMAL(10, 2),
    description TEXT,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_compte) REFERENCES compte(id_compte)
);