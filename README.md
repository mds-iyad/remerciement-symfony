# Application de Remerciements

## Installation
1. Clonez le projet : `git clone https://github.com/mds-iyad/remerciement-symfony.git`
2. Installez les dépendances PHP : `composer install`
3. Configurez l’environnement :
   - Copiez `.env` vers `.env.local` et ajustez les paramètres si nécessaire.
   - Assurez-vous d'avoir une base de données SQLite ou MySQL configurée.
4. Lancez le serveur de développement : `php bin/console server:run`

## Utilisation
- L'application est accessible via [http://localhost:8000](http://localhost:8000).
- Vous pouvez créer des utilisateurs, les remercier et visualiser les remerciements.

## Configuration de la base de données
- Pour SQLite, le fichier `data.db` est dans le dossier `var/`.
