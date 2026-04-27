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