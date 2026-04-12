<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskFlow - Gestionnaire de tâches</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .hero { background: linear-gradient(135deg, #0d6efd, #0dcaf0); min-height: 70vh; }
        .feature-icon { font-size: 2.5rem; color: #0d6efd; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="bi bi-kanban"></i> TaskFlow</a>
        <div class="ms-auto">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Tableau de bord</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
            @endauth
        </div>
    </div>
</nav>
<div class="hero d-flex align-items-center text-white">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-4"><i class="bi bi-kanban"></i> TaskFlow</h1>
        <p class="lead mb-5">Organisez vos projets, gérez vos tâches, atteignez vos objectifs.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-speedometer2"></i> Mon tableau de bord
            </a>
        @else
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-3">Commencer</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">Se connecter</a>
        @endauth
    </div>
</div>
<div class="container py-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="feature-icon mb-3"><i class="bi bi-folder-fill"></i></div>
                <h4>Projets</h4>
                <p class="text-muted">Créez et organisez vos projets en quelques clics.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="feature-icon mb-3"><i class="bi bi-list-check"></i></div>
                <h4>Tâches</h4>
                <p class="text-muted">Gérez vos tâches avec statuts, priorités et étiquettes.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="feature-icon mb-3"><i class="bi bi-shield-check"></i></div>
                <h4>Sécurité</h4>
                <p class="text-muted">Vos données sont protégées. Chaque utilisateur gère ses propres projets.</p>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; {{ date('Y') }} TaskFlow</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
