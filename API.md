# Documentation de l'API REST — MediaHub

## 1. Présentation

L'application MediaHub propose une API REST développée avec Laravel. Elle permet de consulter, créer, modifier et supprimer des publications au format JSON.

L'API utilise Laravel Sanctum pour sécuriser les opérations nécessitant une authentification.

**URL de base :**
`http://127.0.0.1:8000/api`

## 2. Authentification

L'authentification est gérée avec Laravel Sanctum et des tokens personnels.

### Connexion

- **Méthode :** POST
- **Route :** `/connexion`

Exemple de données JSON :

```json
{
    "email": "votre_email",
    "password": "votre_mot_de_passe"
}
```

En cas de succès, l'API retourne un token d'authentification.

Pour accéder aux routes protégées, ajouter cet en-tête :

`Authorization: Bearer VOTRE_TOKEN`

## 3. Routes disponibles

| Méthode | Route | Description | Accès |
|---|---|---|---|
| GET | `/publications` | Liste des publications | Public |
| GET | `/publications/{id}` | Détails d'une publication | Public |
| POST | `/publications` | Créer une publication | Authentifié |
| PUT/PATCH | `/publications/{id}` | Modifier une publication | Authentifié |
| DELETE | `/publications/{id}` | Supprimer une publication | Authentifié |

## 4. Gestion des publications

### Consulter les publications

`GET /publications`

L'API retourne une liste de publications au format JSON avec une pagination de 10 éléments par page.

### Consulter une publication

`GET /publications/{id}`

Retourne les informations d'une publication spécifique.

### Créer une publication

`POST /publications`

Exemple de données JSON :

```json
{
    "titre": "Ma publication API",
    "contenu": "Contenu de ma publication pour tester l'API REST.",
    "categorie_id": 1
}
```

La création retourne le code HTTP `201 Created`.

### Modifier une publication

`PUT /publications/{id}`

Permet de modifier les informations d'une publication existante.

### Supprimer une publication

`DELETE /publications/{id}`

Supprime une publication et retourne le code HTTP `204 No Content`.

## 5. Pagination

La liste des publications est paginée avec 10 éléments par page.

Exemples :

- `/publications?page=1`
- `/publications?page=2`

Les métadonnées retournées comprennent le numéro de page, le nombre total de publications et les liens de navigation.

## 6. Filtrage par catégorie

L'API permet de filtrer les publications selon leur catégorie grâce au paramètre `categorie_id`.

Exemple :

`GET /publications?categorie_id=1`

Cette requête retourne uniquement les publications appartenant à la catégorie Technologie dans notre jeu de données de test.

## 7. Codes de réponse HTTP

| Code | Signification |
|---|---|
| 200 | Requête réussie |
| 201 | Ressource créée |
| 204 | Ressource supprimée |
| 401 | Authentification nécessaire ou identifiants incorrects |
| 403 | Accès interdit |
| 404 | Ressource introuvable |
| 422 | Erreur de validation |

## 8. Technologies utilisées

- **Laravel 13 :** développement de l'API REST.
- **PHP 8.5 :** langage côté serveur.
- **MySQL :** gestion de la base de données.
- **Laravel Sanctum :** authentification par token.
- **JSON :** format d'échange des données.
- **cURL :** tests des différentes routes API.

## 9. Conclusion

L'API REST de MediaHub permet de gérer les publications de manière structurée et sécurisée. Elle propose les fonctionnalités CRUD, la validation des données, la pagination, le filtrage par catégorie et l'authentification avec Laravel Sanctum.
