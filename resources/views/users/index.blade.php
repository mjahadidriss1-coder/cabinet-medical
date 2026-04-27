@extends('layouts.app')
@section('title', __('app.users'))
@section('page-title', __('app.users'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold"><i class="fas fa-users me-2 text-primary"></i>{{ __('app.patients_and_doctors') }}</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
        <i class="fas fa-plus me-1"></i>{{ __('app.new_user') }}
    </button>
</div>

<!-- SEARCH -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control"
                   placeholder="{{ __('app.search_users') }}">
            <span id="searchSpinner" class="input-group-text d-none">
                <div class="spinner-border spinner-border-sm" role="status"></div>
            </span>
        </div>
    </div>
</div>

<!-- ADMINS TABLE -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center"
             style="cursor:pointer" onclick="toggleSection('admins')">
            <h6 class="fw-bold mb-0" style="color:#dc2626">
                <i class="fas fa-shield-halved me-2"></i>
                Admins (<span id="adminsCount">{{ $admins->count() }}</span>)
            </h6>
            <i class="fas fa-chevron-up text-muted" id="adminsChevron"></i>
        </div>
        <div id="adminsSection">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('app.full_name') }}</th>
                        <th>{{ __('app.email') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($admins as $u)
                <tr>
                    <td class="fw-semibold">{{ $u->name }}</td>
                    <td class="text-muted">{{ $u->email }}</td>
                    <td>
                        @if($u->id !== auth()->id())
                        <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger btn-delete-user"
                            data-url="{{ route('users.destroy', $u) }}"
                            data-name="{{ $u->name }}">
                            <i class="fas fa-trash"></i>
                        </button>
                        @else
                        <span class="badge bg-secondary">Vous</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-3">Aucun admin.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- PATIENTS TABLE -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center"
             style="cursor:pointer" onclick="toggleSection('patients')">
            <h6 class="fw-bold mb-0 text-primary">
                <i class="fas fa-user me-2"></i>
                {{ __('app.patients') }} (<span id="patientsCount">{{ $patients->count() }}</span>)
            </h6>
            <i class="fas fa-chevron-up text-muted" id="patientsChevron"></i>
        </div>
        <div id="patientsSection">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('app.full_name') }}</th>
                        <th>{{ __('app.email') }}</th>
                        <th>{{ __('app.phone') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="patientsTbody">
                    @forelse($patients as $u)
                    <tr>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td>{{ $u->phone ?? '-' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-delete-user"
                                data-url="{{ route('users.destroy', $u) }}"
                                data-name="{{ $u->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-3">{{ __('app.no_patients') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MEDECINS TABLE -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center"
             style="cursor:pointer" onclick="toggleSection('medecins')">
            <h6 class="fw-bold mb-0 text-success">
                <i class="fas fa-user-doctor me-2"></i>
                {{ __('app.doctors_list') }} (<span id="medecinsCount">{{ $medecins->count() }}</span>)
            </h6>
            <i class="fas fa-chevron-up text-muted" id="medecinsChevron"></i>
        </div>
        <div id="medecinsSection">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('app.full_name') }}</th>
                        <th>{{ __('app.email') }}</th>
                        <th>{{ __('app.specialite') }}</th>
                        <th>{{ __('app.phone') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="medecinsTbody">
                    @forelse($medecins as $u)
                    <tr>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td>{{ $u->specialite ?? '-' }}</td>
                        <td>{{ $u->phone ?? '-' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-delete-user"
                                data-url="{{ route('users.destroy', $u) }}"
                                data-name="{{ $u->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">{{ __('app.no_doctors') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ===== MODAL AJOUT ===== -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>{{ __('app.new_user') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.full_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.role') }} <span class="text-danger">*</span></label>
                            <select name="role" class="form-select" id="roleSelect" required>
                                <option value="patient" {{ old('role')=='patient' ? 'selected':'' }}>{{ __('app.role_patient') }}</option>
                                <option value="medecin" {{ old('role')=='medecin' ? 'selected':'' }}>{{ __('app.role_medecin') }}</option>
                                <option value="admin"   {{ old('role')=='admin'   ? 'selected':'' }}>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.phone') }}</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone') }}">
                        </div>
                        <div class="col-12" id="specialiteField"
                            style="{{ old('role')=='medecin' ? '' : 'display:none' }}">
                            <label class="form-label">{{ __('app.specialite') }}</label>
                            <input type="text" name="specialite" class="form-control"
                                value="{{ old('specialite') }}"
                                placeholder="{{ __('app.specialite_placeholder') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.confirm_password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>{{ __('app.create_user') }}
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
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>{{ __('app.confirm_delete_user') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-user-slash fa-3x text-danger mb-3 d-block"></i>
                <p class="mb-1">{{ __('app.delete_user_warning') }}</p>
                <p class="fw-bold fs-5" id="deleteUserName"></p>
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
// ── COLLAPSE ──
const collapsed = { patients: false, medecins: false, admins: false };

function toggleSection(key) {
    collapsed[key] = !collapsed[key];
    document.getElementById(key + 'Section').style.display =
        collapsed[key] ? 'none' : '';
    document.getElementById(key + 'Chevron').className =
        'fas text-muted ' + (collapsed[key] ? 'fa-chevron-down' : 'fa-chevron-up');
}

// ── SEARCH ──
let searchTimer;
const searchInput = document.getElementById('searchInput');
const spinner     = document.getElementById('searchSpinner');

searchInput.addEventListener('input', function () {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        const q = this.value.trim();
        spinner.classList.remove('d-none');
        axios.get('{{ route("users.index") }}', {
            params: { search: q },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => {
            const data = res.data;
            document.getElementById('patientsTbody').innerHTML   = data.patients;
            document.getElementById('medecinsTbody').innerHTML   = data.medecins;
            document.getElementById('patientsCount').textContent = data.patients_count;
            document.getElementById('medecinsCount').textContent = data.medecins_count;
            bindDeleteButtons();
        }).finally(() => spinner.classList.add('d-none'));
    }, 400);
});

// ── DELETE MODAL ──
function bindDeleteButtons() {
    document.querySelectorAll('.btn-delete-user').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('deleteUserName').textContent = this.dataset.name;
            document.getElementById('deleteForm').action = this.dataset.url;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
}
bindDeleteButtons();

// ── ROLE SELECT ──
document.getElementById('roleSelect').addEventListener('change', function() {
    document.getElementById('specialiteField').style.display =
        this.value === 'medecin' ? 'block' : 'none';
});

@if($errors->any())
    new bootstrap.Modal(document.getElementById('createUserModal')).show();
@endif
</script>
@endpush