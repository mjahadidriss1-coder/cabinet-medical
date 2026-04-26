@extends('layouts.app')
@section('title', 'Modifier service')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;margin:auto">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Modifier le service</h5>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('services.update', $service) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Durée (minutes)</label>
                    <input type="number" name="duree_minutes" class="form-control" value="{{ $service->duree_minutes }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Prix (MAD)</label>
                    <input type="number" name="prix" class="form-control" value="{{ $service->prix }}" step="0.01">
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning">Mettre à jour</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection