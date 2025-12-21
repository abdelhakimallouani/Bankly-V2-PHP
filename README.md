# Bankly V2

**Bankly V2** est une application web interne pour une petite banque visant à moderniser ses outils de gestion. Elle permet aux employés de gérer les clients, les comptes bancaires et les transactions de manière sécurisée et organisée.

---

## 🚀 Contexte du projet

La banque souhaite disposer d’une interface simple et fonctionnelle pour :

- Gérer les clients
- Créer et gérer les comptes bancaires
- Enregistrer des dépôts et retraits
- Consulter l’historique des transactions
- Accéder uniquement après authentification
- Organiser toutes les données dans une base SQL modélisée via un ERD

---

## 🛠 Technologies utilisées

- **Frontend** : HTML, CSS (Tailwind CSS), JavaScript  
- **Backend** : PHP procédural  
- **Base de données** : MySQL / MariaDB  
- **CRUD** : Clients, Comptes, Transactions  
- **Authentification** : Sessions PHP (login/logout)  
- **Sécurité** : Validation des formulaires, protection des entrées  

---

## 📂 Structure du projet

### Pages principales

#### Authentification
- `login.php` : Formulaire de connexion, redirige vers le dashboard après succès.  
- `logout.php` : Déconnexion et destruction de la session.  

#### Dashboard
- `dashboard.php` : Vue d’ensemble des statistiques (nombre de clients, nombre de comptes, total des transactions du jour…).  

#### Gestion des clients
- `list_clients.php` : Liste de tous les clients  
- `add_client.php` : Ajouter un client  
- `edit_client.php` : Modifier un client  

#### Gestion des comptes bancaires
- `list_accounts.php` : Liste de tous les comptes  
- `add_account.php` : Ajouter un compte pour un client  
- `edit_account.php` : Modifier un compte  
- `delete_account.php` : Supprimer un compte  

#### Gestion des transactions
- `make_transaction.php` : Effectuer un dépôt ou retrait  
- `list_transactions.php` : Historique des transactions filtré par compte  

---

## 🧾 User Stories

### Authentification
- Se connecter pour accéder aux fonctionnalités internes  
- Se déconnecter pour sécuriser le compte  

### Gestion des clients
- Ajouter un client avec ses informations (nom, email, CIN)  
- Consulter la liste de tous les clients  
- Modifier les informations d’un client  
- Supprimer un client si nécessaire  

### Gestion des comptes bancaires
- Créer un compte bancaire pour un client  
- Consulter tous les comptes bancaires  
- Modifier un compte (type, statut…)  
- Supprimer un compte  

### Gestion des transactions
- Effectuer un dépôt sur un compte  
- Effectuer un retrait  
- Consulter l’historique des transactions  

### Dashboard
- Voir un résumé global dès la connexion (statistiques principales)  

---

## 💾 Base de données

### Entités principales
- **Utilisateur** : Gestion des employés / agents  
- **Client** : Informations sur les clients  
- **Compte** : Comptes bancaires liés aux clients  
- **Transaction** : Historique des dépôts et retraits  

### Relations
- 1 client → N comptes  
- 1 compte → N transactions  
- Clés primaires et étrangères bien définies  
- Contraintes `NOT NULL` et `UNIQUE`  

---

## ⚡ Fonctionnalités principales

- CRUD complet pour Clients et Comptes  
- Gestion des transactions avec historique automatique  
- Authentification sécurisée (login/logout)  
- Formulaires avec validation et messages d’erreur / succès  
- Dashboard avec statistiques rapides  
