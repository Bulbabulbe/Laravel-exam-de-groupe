@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="h3 mb-4"><i class="bi bi-person-circle"></i> Mon profil</h1>

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Informations du profil</h5></div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Modifier le mot de passe</h5></div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card border-danger">
            <div class="card-header bg-danger text-white"><h5 class="mb-0">Zone de danger</h5></div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
