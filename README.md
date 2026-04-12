# TaskFlow - Gestionnaire de Tâches

Application web de gestion de projets et de tâches développée avec Laravel.

**Membres du groupe :** Raphael JACQ, Théo CORBUN, Samy HARRIR

---

## Description

TaskFlow est une application de gestion de tâches qui permet aux utilisateurs de :
- Créer et gérer des **projets**
- Ajouter des **tâches** à chaque projet (avec statut, priorité, date d'échéance)
- Associer des **labels/étiquettes** aux tâches
- Gérer les droits : **Admin** (accès complet) ou **Utilisateur** (gère ses propres projets)

---

## Instructions d'installation

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd taskflow
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Base de données (SQLite, aucune configuration nécessaire)

```bash
php artisan migrate:fresh --seed
```

### 5. Compiler les assets

```bash
npm install
npm run build
```

### 6. Lancer le serveur

```bash
php artisan serve
```

L'application est disponible sur : http://localhost:8000

---

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | admin@taskflow.com | password |
| Utilisateur | user@taskflow.com | password |

---

## Structure de la base de données

- **users** : utilisateurs (avec rôle admin/user)
- **projects** : projets (appartiennent à un utilisateur) → relation **1:N** avec users
- **tasks** : tâches (appartiennent à un projet) → relation **1:N** avec projects
- **labels** : étiquettes
- **label_task** : table pivot → relation **N:N** entre tasks et labels

---

## Technologies utilisées

- Laravel 12, PHP 8.x
- Laravel Breeze (authentification)
- Bootstrap 5.3 (interface)
- SQLite (base de données)
