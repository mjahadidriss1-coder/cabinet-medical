@extends('layouts.app')
@section('title', __('app.edit_user'))
@section('page-title', __('app.edit_user'))

@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;margin:auto">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">
            <i class="fas fa-user-edit me-2 text-warning"></i>
            {{ __('app.edit_user') }} : {{ $user->name }}
        </h5>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.full_name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.role') }} <span class="text-danger">*</span></label>
                    <select name="role" class="form-select" id="roleSelect" required>
                        <option value="patient" {{ $user->role=='patient' ? 'selected':'' }}>{{ __('app.patient') }}</option>
                        <option value="medecin" {{ $user->role=='medecin' ? 'selected':'' }}>{{ __('app.medecin') }}</option>
                        <option value="admin"   {{ $user->role=='admin'   ? 'selected':'' }}>Admin</option> 
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                <div class="col-12" id="specialiteField"
                    style="{{ $user->role=='medecin' ? '' : 'display:none' }}">
                    <label class="form-label">{{ __('app.specialite') }}</label>
                    <input type="text" name="specialite" class="form-control" value="{{ $user->specialite }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.new_password_opt') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('app.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning">
                    <i class="fas fa-save me-1"></i>{{ __('app.update') }}
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    {{ __('app.cancel') }}
                </a>
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