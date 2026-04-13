# TaskFlow - Gestionnaire de Tâches

Application web de gestion de projets et tâches développée avec Laravel dans le cadre de notre projet d'évaluation.

---

## Membres du groupe

- **Raphael JACQ**
- **Théo CORBUN**
- **Samy HARRIR**
- **Enzo DIPIETRO**

---

## Répartition des tâches

| Membre | Travail effectué |
|--------|-----------------|
| Raphael JACQ | Mise en place du projet Laravel, migrations, modèles et relations Eloquent |
| Samy HARRIR | Controllers, Form Requests, routes et logique métier |
| Théo CORBUN | Vues Blade, layout Bootstrap, intégration des messages flash |

---

## Problèmes rencontrés

- **Relation N:N tasks/labels** : on avait nommé la table pivot `task_labels` au lieu de `label_task`, Laravel ne la trouvait pas automatiquement. On a corrigé le nom pour respecter la convention alphabétique d'Eloquent.

- **Middleware auth sur les routes imbriquées** : au début les routes des tâches n'héritaient pas du middleware du groupe parent, les tâches étaient accessibles sans être connecté. Réglé en les mettant bien dans le `Route::middleware('auth')->group(...)`.

- **Policies non appliquées** : on avait oublié d'appeler `$this->authorize()` dans les controllers, du coup n'importe quel utilisateur pouvait modifier les projets des autres. Corrigé en ajoutant `use AuthorizesRequests` et les appels dans chaque méthode.

- **SQLite sur Windows** : l'extension `pdo_sqlite` n'était pas activée par défaut sur l'un de nos PC, il fallait décommenter la ligne dans `php.ini`.

---

## Installation

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd Laravel-projet-Raphael-Th-o-Samy
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Base de données

```bash
php artisan migrate:fresh --seed
```

> La base de données utilise SQLite, le fichier est créé automatiquement dans `database/database.sqlite`. Aucune configuration supplémentaire n'est nécessaire.

### 5. Assets

```bash
npm install
npm run build
```

### 6. Lancer le serveur

```bash
php artisan serve
```

Accès : http://localhost:8000

---

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | admin@taskflow.com | password |
| Utilisateur | user@taskflow.com | password |

---

## Structure de la base de données

- **users** — utilisateurs avec rôle (admin / user)
- **projects** — projets appartenant à un utilisateur `(1:N avec users)`
- **tasks** — tâches appartenant à un projet `(1:N avec projects)`
- **labels** — étiquettes
- **label_task** — table pivot `(N:N entre tasks et labels)`

---

## Stack technique

- Laravel 12
- Laravel Breeze (auth)
- Bootstrap 5.3
- SQLite
