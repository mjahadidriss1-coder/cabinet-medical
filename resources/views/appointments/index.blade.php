@extends('layouts.app')
@section('title', __('app.appointments'))
@section('page-title', __('app.appointments'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-calendar-check me-2 text-primary"></i>{{ __('app.appointments') }}</h4>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>{{ __('app.new_appointment') }}
    </a>
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

<!-- MODAL SUPPRESSION -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>{{ __('app.confirm_delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">{{ __('app.delete_warning') }}</div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">{{ __('app.delete') }}</button>
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
            const parser = new DOMParser();
            const doc = parser.parseFromString(res.data, 'text/html');
            document.getElementById('appointmentsTable').innerHTML =
                doc.getElementById('appointmentsTable').innerHTML;
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
</script>
@endpush