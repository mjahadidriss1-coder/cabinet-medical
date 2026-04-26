@extends('layouts.app')
@section('title', 'Modifier utilisateur')
@section('page-title', 'Modifier utilisateur')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;margin:auto">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-user-edit me-2 text-warning"></i>Modifier : {{ $user->name }}</h5>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Rôle <span class="text-danger">*</span></label>
                    <select name="role" class="form-select" id="roleSelect" required>
                        <option value="patient" {{ $user->role=='patient' ? 'selected':'' }}>Patient</option>
                        <option value="medecin" {{ $user->role=='medecin' ? 'selected':'' }}>Médecin</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                <div class="col-12" id="specialiteField" style="{{ $user->role=='medecin' ? '' : 'display:none' }}">
                    <label class="form-label">Spécialité</label>
                    <input type="text" name="specialite" class="form-control" value="{{ $user->specialite }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nouveau mot de passe <span class="text-muted">(optionnel)</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirmer</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning"><i class="fas fa-save me-1"></i>Mettre à jour</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    document.getElementById('specialiteField').style.display =
        this.value === 'medecin' ? 'block' : 'none';
});
</script>
@endpush