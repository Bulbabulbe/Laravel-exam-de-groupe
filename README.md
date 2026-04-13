# TaskFlow - Gestionnaire de Tâches

Application web de gestion de projets et tâches développée avec Laravel dans le cadre de notre projet d'évaluation.

---

## Membres du groupe

- **Raphael JACQ**
- **Théo CORBUN**
- **Samy HARRIR**
- **Enzo DIPIETRO**

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

