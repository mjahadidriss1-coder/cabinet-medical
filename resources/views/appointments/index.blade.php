@extends('layouts.app')
@section('title', __('app.appointments'))
@section('page-title', __('app.appointments'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-calendar-check me-2 text-primary"></i>{{ __('app.appointments') }}</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAppointmentModal">
        <i class="fas fa-plus me-1"></i>{{ __('app.new_appointment') }}
    </button>
</div>

<!-- SEARCH (Axios) -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="{{ __('app.search_placeholder') }}">
            <span id="searchSpinner" class="input-group-text d-none">
                <div class="spinner-border spinner-border-sm" role="status"></div>
            </span>
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div id="appointmentsTable">
            @include('appointments.partials.table', ['appointments' => $appointments])
        </div>
    </div>
</div>


<!-- ===== MODAL AJOUT RAPIDE ===== -->
<div class="modal fade" id="createAppointmentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>{{ __('app.new_appointment') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ __('app.patient') }} <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}"
                                        {{ auth()->user()->isPatient() && auth()->id()==$p->id ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ __('app.doctor') }} <span class="text-danger">*</span></label>
                            <select name="medecin_id" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                @foreach($medecins as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->specialite }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ __('app.service') }} <span class="text-danger">*</span></label>
                            <select name="service_id" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                @foreach($services as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->duree_minutes }} min)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">{{ __('app.date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="appointment_date" class="form-control"
                                min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">{{ __('app.time') }} <span class="text-danger">*</span></label>
                            <input type="time" name="appointment_time" class="form-control"
                                value="{{ old('appointment_time') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ __('app.notes') }}</label>
                            <textarea name="notes" class="form-control" rows="2"
                                placeholder="Notes optionnelles...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>{{ __('app.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ===== MODAL SUPPRESSION ===== -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>{{ __('app.confirm_delete') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-trash-alt fa-3x text-danger mb-3 d-block"></i>
                <p class="mb-0">{{ __('app.delete_warning') }}</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-secondary px-4" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger px-4">
                        <i class="fas fa-trash me-1"></i>{{ __('app.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Axios Search
let searchTimer;
const searchInput = document.getElementById('searchInput');
const spinner     = document.getElementById('searchSpinner');

searchInput.addEventListener('input', function () {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        const q = this.value.trim();
        spinner.classList.remove('d-none');
        axios.get('{{ route("appointments.index") }}', {
            params: { search: q },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => {
            document.getElementById('appointmentsTable').innerHTML = res.data;
            bindDeleteButtons();
        }).finally(() => spinner.classList.add('d-none'));
    }, 400);
});

// Delete Modal
function bindDeleteButtons() {
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('deleteForm').action = this.dataset.url;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
}
bindDeleteButtons();

// Rouvrir modal si erreur de validation
@if($errors->any())
    new bootstrap.Modal(document.getElementById('createAppointmentModal')).show();
@endif
</script>
@endpush