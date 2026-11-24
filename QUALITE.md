
# Rapport qualité — MediaHub

## 1. Tests automatisés

Les tests ont été réalisés avec PHPUnit et Laravel.

La base de données utilisée pour les tests est SQLite en mémoire (`:memory:`), afin de séparer les tests de la base de données de développement.

### Tests réalisés

- **Catégories :** vérification de la création d'une catégorie par un administrateur.
- **Authentification :** vérification de l'inscription d'un nouvel utilisateur.
- **Authentification :** vérification du refus de connexion avec des identifiants incorrects.
- **Permissions :** vérification des droits de modification et de suppression des publications.
- **API REST :** vérification de la consultation publique des publications.
- **API REST :** vérification du refus de création sans authentification.

### Résultat

- 10 tests réussis.
- 18 assertions validées.

Commande utilisée :

```bash
php artisan test
```

## 2. Sécurité et autorisations

L'application utilise Laravel Policies pour contrôler les opérations sur les publications.

Les règles appliquées sont :

- Un utilisateur peut modifier et supprimer ses propres publications.
- Un utilisateur ne peut pas modifier ou supprimer les publications des autres.
- Un administrateur peut modifier et supprimer toutes les publications.

L'API REST utilise Laravel Sanctum pour protéger les opérations nécessitant une authentification.

## 3. Optimisation des requêtes SQL

L'Eager Loading est utilisé dans `PublicationController` avec :

```php
Publication::with(['categorie', 'auteur', 'tags'])
```

Cette technique permet de charger les relations nécessaires en avance et de limiter les requêtes répétitives (problème N+1).

La méthode `withCount('publications')` est également utilisée pour compter les publications associées à chaque catégorie.

## 4. Mise en cache

Le cache Laravel est utilisé pour conserver la liste des catégories pendant une heure.

```php
Cache::remember('categories.liste', 3600, function () {
    return Categorie::withCount('publications')->get();
});
```

Le cache est invalidé après :

- La création d'une catégorie.
- La modification d'une catégorie.
- La suppression d'une catégorie.

## 5. Conclusion

Les tests automatisés, les contrôles d'accès, l'Eager Loading et le système de cache contribuent à améliorer la fiabilité, la sécurité et les performances de MediaHub.
