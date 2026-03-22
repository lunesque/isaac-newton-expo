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

## Utilisation
| Endpoint | Method | Description |
|---|---|---|
| `/api/auth` | `GET` | Verify admin token |
| `/api/auth` | `POST` | Login (any account), create a token (admin only — account id = 1) |
| `/api/auth/{id}` | `DELETE` | Destroy session (delete account id and token cookies) |
| `/api/accounts` | `GET` | Get all accounts |
| `/api/accounts/{id}` | `GET` | Get one account by id |
| `/api/accounts` | `POST` | Create a new account |
| `/api/accounts/{id}` | `PUT` | Modify an account |
| `/api/accounts/{id}` | `DELETE` | Delete an account |
| `/api/reservations` | `GET` | Get all reservations |
| `/api/reservations/{id}` | `GET` | Get one reservation by id |
| `/api/reservations` | `POST` | Create a new reservation |
| `/api/reservations/{id}` | `PUT` | Modify a reservation |
| `/api/reservations/{id}` | `DELETE` | Delete a reservation |
| `/api/tickets` | `GET` | Get all ticket types |

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
