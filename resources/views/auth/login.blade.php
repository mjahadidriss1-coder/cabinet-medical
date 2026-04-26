@extends('layouts.guest')
@section('title', 'Connexion')
@section('content')
<h2>Connexion</h2>
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
            value="{{ old('email') }}" required autofocus>
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-4 d-flex align-items-center gap-2">
        <input type="checkbox" name="remember" id="remember"
            style="width:16px;height:16px;accent-color:var(--teal)">
        <label for="remember" style="font-size:.88rem;color:#64748b;cursor:pointer">
            Se souvenir de moi
        </label>
    </div>
    <button type="submit" class="btn-auth">Se connecter</button>
</form>
<div class="auth-footer">
    Pas de compte ? <a href="{{ route('register') }}">S'inscrire</a>
</div>
@endsection