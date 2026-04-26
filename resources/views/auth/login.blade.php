@extends('layouts.guest')
@section('title', 'Connexion')
@section('content')
<h5 class="fw-bold mb-4 text-center">Connexion</h5>
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
    </div>
    <button class="btn btn-primary w-100">Se connecter</button>
</form>
<hr>
<p class="text-center mb-0 small">Pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
@endsection