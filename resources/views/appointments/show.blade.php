@extends('layouts.app')
@section('title', 'Détail du rendez-vous')
@section('page-title', 'Détail du rendez-vous')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:700px;margin:auto">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-calendar-check me-2 text-primary"></i>Rendez-vous #{{ $appointment->id }}
            </h5>
            <span class="badge badge-{{ $appointment->statut }} px-3 py-2 fs-6">
                {{ __('app.statut_'.$appointment->statut) }}
            </span>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card bg-light border-0 p-3 h-100">
                    <p class="text-muted small mb-1"><i class="fas fa-user me-1"></i>Patient</p>
                    <p class="fw-semibold mb-0">{{ $appointment->patient->name }}</p>
                    <p class="text-muted small mb-0">{{ $appointment->patient->email }}</p>
                    <p class="text-muted small mb-0">{{ $appointment->patient->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light border-0 p-3 h-100">
                    <p class="text-muted small mb-1"><i class="fas fa-user-md me-1"></i>Médecin</p>
                    <p class="fw-semibold mb-0">{{ $appointment->medecin->name }}</p>
                    <p class="text-muted small mb-0">{{ $appointment->medecin->specialite }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light border-0 p-3">
                    <p class="text-muted small mb-1"><i class="fas fa-stethoscope me-1"></i>Service</p>
                    <p class="fw-semibold mb-0">{{ $appointment->service->name }}</p>
                    <p class="text-muted small mb-0">{{ $appointment->service->duree_minutes }} min
                        @if($appointment->service->prix)
                            — {{ $appointment->service->prix }} MAD
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light border-0 p-3">
                    <p class="text-muted small mb-1"><i class="fas fa-clock me-1"></i>Date & Heure</p>
                    <p class="fw-semibold mb-0">{{ $appointment->appointment_date->format('d/m/Y') }}</p>
                    <p class="text-muted small mb-0">{{ $appointment->appointment_time }}</p>
                </div>
            </div>
            @if($appointment->notes)
            <div class="col-12">
                <div class="card bg-light border-0 p-3">
                    <p class="text-muted small mb-1"><i class="fas fa-sticky-note me-1"></i>Notes</p>
                    <p class="mb-0">{{ $appointment->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
</div>
@endsection