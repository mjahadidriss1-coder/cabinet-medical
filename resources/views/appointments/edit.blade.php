@extends('layouts.app')
@section('title', __('app.edit_appointment'))
@section('page-title', __('app.edit_appointment'))

@section('content')
<div class="card border-0 shadow-sm" style="max-width:700px;margin:auto">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-edit me-2 text-warning"></i>{{ __('app.edit_appointment') }}</h5>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('appointments.update', $appointment) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.doctor') }}</label>
                    <select name="medecin_id" class="form-select" required>
                        @foreach($medecins as $m)
                            <option value="{{ $m->id }}" {{ $appointment->medecin_id==$m->id ? 'selected':'' }}>
                                {{ $m->name }} ({{ $m->specialite }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.service') }}</label>
                    <select name="service_id" class="form-select" required>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}" {{ $appointment->service_id==$s->id ? 'selected':'' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('app.date') }}</label>
                    <input type="date" name="appointment_date" class="form-control"
                        value="{{ $appointment->appointment_date->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('app.time') }}</label>
                    <input type="time" name="appointment_time" class="form-control"
                        value="{{ $appointment->appointment_time }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.status') }}</label>
                    <select name="statut" class="form-select">
                        @foreach(['en_attente','confirme','annule','termine'] as $s)
                            <option value="{{ $s }}" {{ $appointment->statut==$s ? 'selected':'' }}>
                                {{ __('app.statut_'.$s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">{{ __('app.notes') }}</label>
                    <textarea name="notes" class="form-control" rows="3">{{ $appointment->notes }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning"><i class="fas fa-save me-1"></i>{{ __('app.update') }}</button>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection