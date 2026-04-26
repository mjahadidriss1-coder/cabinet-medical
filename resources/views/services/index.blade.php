@extends('layouts.app')
@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-stethoscope me-2 text-primary"></i>Services</h4>
    <a href="{{ route('services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Nouveau service
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Durée</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($services as $s)
            <tr>
                <td class="fw-semibold">{{ $s->name }}</td>
                <td class="text-muted">{{ $s->description }}</td>
                <td>{{ $s->duree_minutes }} min</td>
                <td>{{ $s->prix ? $s->prix.' MAD' : '-' }}</td>
                <td>
                    <a href="{{ route('services.edit', $s) }}" class="btn btn-sm btn-outline-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('services.destroy', $s) }}" class="d-inline"
                          onsubmit="return confirm('Supprimer ce service ?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Aucun service trouvé.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($services->hasPages())
<div class="mt-3">{{ $services->links() }}</div>
@endif
@endsection