# Documentation Technique du Projet "Projet Parfait 20-20"

## Structure du Projet

Le projet est organisé selon le modèle MVC. Voici la structure principale :

    /autre 
        - pdf.php 
        - dompdf/ (bibliothèque pour la génération de PDF) 
    /controleur 
        - accueil.php 
        - ajouterAuteur.php 
        - ajouterLivre.php 
        - auth.php 
        - ... 
    /css 
        - style.css 
    /img 
        - BD.jpg 
        - Bibliothèque.jpg 
        - ... 
    /inc 
        - header.inc 
        - footer.inc 
    /modele 
        - mesFonctionsAccesBDD.php 
    /tests 
        - testAddAuteur.php 
        - testCheckLogin.php 
        - ... 
    /vue 
        - vueAccueil.php 
        - vueAjouterAuteur.php 
        - vueAjouterLivre.php 
        - ...


---

## Fonctionnalités Principales

Le projet est une application de gestion de bibliothèque avec les fonctionnalités suivantes :

1. **Gestion des Livres :**
   - Ajout, suppression et affichage des livres.
   - Recherche de livres par titre et genre.
   - Génération de fiches PDF pour les livres.

2. **Gestion des Auteurs :**
   - Ajout d'auteurs avec leurs informations personnelles.

3. **Authentification :**
   - Connexion des bibliothécaires avec gestion de session.

4. **Interface Utilisateur :**
   - Navigation entre les différentes pages via un menu.
   - Design responsive avec des styles définis dans `css/style.css`.

---

## Détails des Fichiers

### `/autre`
- **`pdf.php` :**
  - Génère un fichier PDF contenant les informations d'un livre.
  - Utilise la bibliothèque `Dompdf` pour convertir du HTML en PDF.
  - Encode les images en base64 pour les inclure directement dans le PDF.

- **`dompdf/` :**
  - Contient la bibliothèque `Dompdf` pour la génération de PDF.

### `/controleur`
- **`accueil.php` :**
  - Charge la vue d'accueil.

- **`ajouterLivre.php` :**
  - Gère l'ajout de livres en récupérant les genres et auteurs disponibles.

- **`auth.php` :**
  - Gère l'authentification des bibliothécaires.

- **`scriptAjoutLivre.php` :**
  - Traite les données du formulaire d'ajout de livre.
  - Vérifie et déplace les fichiers d'image téléchargés.

- **`supprimerLivre.php` :**
  - Supprime un livre de la base de données en fonction de son ID.

### `/css`
- **`style.css` :**
  - Contient les styles pour l'interface utilisateur.
  - Définit des classes pour les boutons, les formulaires, les tableaux, etc.

### `/img`
- Contient les images utilisées dans le projet, comme les couvertures de livres.

### `/inc`
- **`header.inc` :**
  - Contient le code HTML pour l'en-tête, y compris le menu de navigation.

- **`footer.inc` :**
  - Contient le code HTML pour le pied de page.

### `/modele`
- **`mesFonctionsAccesBDD.php` :**
  - Contient les fonctions pour interagir avec la base de données.
  - Exemples :
    - `dbConnection()` : Connexion à la base de données.
    - `getLivreById()` : Récupère les détails d'un livre par son ID.
    - `addLivre()` : Ajoute un livre à la base de données.

### `/tests`
- Contient des scripts pour tester les fonctionnalités du projet, comme la connexion à la base de données ou l'ajout d'auteurs.

### `/vue`
- Contient les fichiers de vue pour afficher les pages HTML.
- Exemples :
  - `vueAccueil.php` : Page d'accueil.
  - `vueAjouterLivre.php` : Formulaire pour ajouter un livre.
  - `vueLivre.php` : Affiche les détails d'un livre.

---

## Base de Données

Le projet utilise une base de données MySQL. Voici les principales tables :

### Livres
  - id (PRIMARY KEY,Auto-increment) int(11)
  - titre varchar(100)
  - photo (Default : NULL) varchar(255)
  - resume varchar(1800)
  - datesortie date
  - id_auteur (FOREIGN KEY on auteur.id) int(11)
  - id_genre (FOREIGN KEY on genre.id) int(11)

    `Exemple:`
    3
    L'Étranger
    ./img/Roman/Etranger.jpg
    Meursault, un homme détaché et indifférent, mène une existence monotone en Algérie jusqu’au jour où, sans véritable raison, il commet un meurtre. Son procès devient alors le symbole de son incapacité à se conformer aux normes de la société. Ce roman puissant explore l’absurde, la liberté et le destin.
    1942-05-19
    3
    1

 ### Auteurs
  - id (PRIMARY KEY,Auto-increment) int(11)
  - nom varchar(60)
  - prenom varchar(60)
  - date_naissance date

  `Exemple:`
  3
  Camus
  Albert
  1913-11-07

 ### Genres
  - id (PRIMARY KEY,Auto-increment) int(11)
  - genre varchar(30)
  - chemin varchar(20)
  
  `Exemple:`
  1
  Roman
  Roman
 
---

## Bibliothèque Externe

- **Dompdf :**
  - Utilisée pour générer des fichiers PDF à partir de contenu HTML.
  - Documentation incluse dans `autre/dompdf/README.md`.

---

## Points Techniques Importants

1. **Génération de PDF :**
   - Les images sont encodées en base64 pour être incluses directement dans le PDF.

2. **Gestion des Sessions :**
   - Les bibliothécaires doivent être connectés pour accéder à certaines fonctionnalités.
   - Exemple dans `controleur/auth.php` :
     ```php
     session_start();
     if (!isset($_SESSION['bibliothecaire'])) {
         header("Location: index.php?action=connexion");
         exit();
     }
     ```

3. **Téléchargement et Validation des Images :**
   - Les fichiers d'image sont validés avant d'être déplacés dans le dossier `img`.
   - Exemple dans `controleur/scriptAjoutLivre.php` :
     ```php
     if (!isValidImage($extension)) {
         header("Location: ../index.php?action=ajouterLivre&message=error");
         exit();
     }
     ```

4. **Permissions accordées :**
   - Il faut accorder les permissions sur le dossier img à l'utilisateur www-data (rw)

---

## Tests

Des scripts de test sont disponibles dans le dossier `/tests` pour valider les fonctionnalités principales, comme la connexion à la base de données (`testConnexionBDD.php`) ou l'ajout d'auteurs (`testAddAuteur.php`).

---

## Dépendances

- PHP 7.1 ou supérieur.
- Extensions PHP requises :
  - `PDO` (pour la base de données).
  - `MBString` (pour la gestion des chaînes de caractères).
  - `GD` ou `Imagick` (pour le traitement des images).

---

## Installation

1. Clonez le projet :
   ```bash
   git clone <url_du_projet>

2. Configurez la base de données dans modele/mesFonctionsAccesBDD.php

3. Installez les dépendances de Dompdf si nécessaire :
'''composer require dompdf/dompdf'''

4.Lancez le projet dans un serveur local (ex.: Apache)
