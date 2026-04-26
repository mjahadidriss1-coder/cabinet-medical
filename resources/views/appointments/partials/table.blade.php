<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>{{ __('app.patient') }}</th>
                <th>{{ __('app.doctor') }}</th>
                <th>{{ __('app.service') }}</th>
                <th>{{ __('app.date') }}</th>
                <th>{{ __('app.time') }}</th>
                <th>{{ __('app.status') }}</th>
                <th>{{ __('app.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @forelse($appointments as $a)
        <tr>
            <td>
                <div class="fw-semibold">{{ $a->patient->name }}</div>
                <small class="text-muted">{{ $a->patient->phone }}</small>
            </td>
            <td>
                <div>{{ $a->medecin->name }}</div>
                <small class="text-muted">{{ $a->medecin->specialite }}</small>
            </td>
            <td>{{ $a->service->name }}</td>
            <td>{{ $a->appointment_date->format('d/m/Y') }}</td>
            <td>{{ $a->appointment_time }}</td>
            <td>
                <span class="badge badge-{{ $a->statut }} px-3 py-2">
                    {{ __('app.statut_'.$a->statut) }}
                </span>
            </td>
            <td>
                <a href="{{ route('appointments.show', $a) }}" class="btn btn-sm btn-outline-info" title="Voir">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('appointments.edit', $a) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger btn-delete"
                    data-url="{{ route('appointments.destroy', $a) }}" title="Supprimer">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted py-5">
                <i class="fas fa-calendar-times fa-2x mb-2 d-block"></i>
                {{ __('app.no_appointments') }}
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
@if($appointments->hasPages())
<div class="p-3">{{ $appointments->links() }}</div>
@endif