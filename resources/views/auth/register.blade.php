@extends('layouts.guest')
@section('title', 'Inscription')
@section('content')
<h5 class="fw-bold mb-4 text-center">Créer un compte</h5>
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nom complet</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Téléphone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button class="btn btn-success w-100">S'inscrire</button>
</form>
<hr>
<p class="text-center mb-0 small">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
@endsection