<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               id="name" name="name"
               value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email"
               class="form-control @error('email') is-invalid @enderror"
               id="email" name="email"
               value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>

    @if(session('status') === 'profile-updated')
        <span class="ms-3 text-success">Sauvegardé !</span>
    @endif
</form>
