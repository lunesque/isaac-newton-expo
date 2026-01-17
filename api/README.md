API exposition newton

Source of JWT generator : 
# JWT-en-PHP
Génération et vérification de JSON Web Token en PHP
https://www.youtube.com/watch?v=dZgHUq-uEGY

RESTful API Paths
/api/auth       - GET - verify admin token
/api/auth       - POST - login (any account), create a token (only if account id = 1 / admin)
/api/auth/{id}  - DELETE - destroy session (delete account id and token cookies)

/api/accounts       - GET - get all accounts
/api/accounts/{id}  - GET - get one account from id
/api/accounts       - POST - create a new account
/api/accounts/{id}  - PUT - modify an account
/api/accounts/{id}  - DELETE - delete an account

/api/accounts/{id}/reservations - GET - get all reservations made by one account

/api/reservations       - GET - get all reservations
/api/reservations/{id}  - GET - get one reservation from id
/api/reservations       - POST - create a new reservations
/api/reservations/{id}  - PUT - modify a reservations
/api/reservations/{id}  - DELETE - delete a reservations

/api/tickets    - GET - get all ticket types