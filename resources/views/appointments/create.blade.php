@extends('layouts.app')
@section('title', __('app.new_appointment'))
@section('page-title', __('app.new_appointment'))

@section('content')
<div class="card border-0 shadow-sm" style="max-width:700px;margin:auto">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>{{ __('app.new_appointment') }}</h5>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.patient') }}</label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ auth()->user()->isPatient() && auth()->id()==$p->id ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.doctor') }}</label>
                    <select name="medecin_id" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        @foreach($medecins as $m)
                            <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->specialite }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.service') }}</label>
                    <select name="service_id" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->duree_minutes }} min)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('app.date') }}</label>
                    <input type="date" name="appointment_date" class="form-control"
                        min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('app.time') }}</label>
                    <input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">{{ __('app.notes') }}</label>
                    <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary"><i class="fas fa-save me-1"></i>{{ __('app.save') }}</button>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection