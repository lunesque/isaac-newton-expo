# ISAAC NEWTON EXPOSITION - PROJET MMI3
Dev Thuy Hang NGUYEN, Nicolas MOLDUCH
Créa Delphine QUACH, Ramata WAGNE, Laure MISSIE, Ahmed-Amine SAKKAL

===========================
## Site de l'expo (isaac-newton)
lien : https://isaac-newton.alwaysdata.net/
répo github : https://github.com/Nicolas24700/isaac-newton

===========================
## API 
lien : https://isaac-newton.alwaysdata.net/api

Ressources utilisées :
Génération et vérification de JSON Web Token en PHP
https://github.com/NouvelleTechno/JWT-en-PHP

Installation 
- importer la base de données 'expo_newton.sql'
- entrez hote, nom de la base, identifiant et mot de passe dans config.php

Utilisation
/api/auth       - GET - verify admin token
/api/auth       - POST - login (any account), create a token (only if account id = 1 / admin)
/api/auth/{id}  - DELETE - destroy session (delete account id and token cookies)

/api/accounts       - GET - get all accounts
/api/accounts/{id}  - GET - get one account from id
/api/accounts       - POST - create a new account
/api/accounts/{id}  - PUT - modify an account
/api/accounts/{id}  - DELETE - delete an account

/api/reservations       - GET - get all reservations
/api/reservations/{id}  - GET - get one reservation from id
/api/reservations       - POST - create a new reservations
/api/reservations/{id}  - PUT - modify a reservations
/api/reservations/{id}  - DELETE - delete a reservations

/api/tickets    - GET - get all ticket types

Troubleshooting :
- Erreurs de CORS : ajouter des domaines dans $allowed_domains dans config.php pour pouvoir envoyer des requêtes vers l'API ou héberger tous les parties du site sur le même domaine 

===========================
## Back-office
lien: https://isaac-newton.alwaysdata.net/back-office

Install des dépendences :
npm install

Mettre le lien vers l'API dans /src/App.jsx
$linkToAPI = "https://monapi.com"

Déploiment :
npm run build
