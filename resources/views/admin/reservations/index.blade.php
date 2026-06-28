@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Toutes les Réservations</h3>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3 rounded-top-start">N° Réservation</th>
                        <th class="border-0 px-4 py-3">Client</th>
                        <th class="border-0 px-4 py-3">Date Prévue</th>
                        <th class="border-0 px-4 py-3 text-center">Invités</th>
                        <th class="border-0 px-4 py-3">Notes</th>
                        <th class="border-0 px-4 py-3 text-center">Statut</th>
                        <th class="border-0 px-4 py-3 rounded-top-end text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-navy">#{{ $res->id }}</td>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $res->user->name }}</div>
                            <small class="text-muted">Demande du {{ $res->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark"><i class="fa-regular fa-calendar me-1 text-primary"></i> {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/Y') }}</div>
                            <div class="small text-muted"><i class="fa-regular fa-clock me-1"></i> {{ \Carbon\Carbon::parse($res->reservation_date)->format('H:i') }}</div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="badge bg-light text-dark border"><i class="fa-solid fa-users me-1"></i> {{ $res->guests }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($res->special_request)
                                <div class="text-muted small fst-italic">"{{ $res->special_request }}"</div>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-warning text-dark',
                                    'confirmed' => 'bg-success',
                                    'rejected' => 'bg-danger'
                                ];
                                $statusColor = $statusColors[$res->status] ?? 'bg-secondary';
                                $statusLabels = [
                                    'pending' => 'En attente',
                                    'confirmed' => 'Confirmée',
                                    'rejected' => 'Refusée'
                                ];
                                $statusLabel = $statusLabels[$res->status] ?? strtoupper($res->status);
                            @endphp
                            <span class="badge {{ $statusColor }}">{{ $statusLabel }}</span>
                        </td>
                        <td class="px-4 py-3 text-end">
                            <form action="{{ route('admin.reservations.update', $res->id) }}" method="POST" class="d-flex align-items-center justify-content-end">
                                @csrf
                                <select name="status" class="form-select form-select-sm me-2 w-auto" onchange="this.form.submit()">
                                    <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmed" {{ $res->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="rejected" {{ $res->status == 'rejected' ? 'selected' : '' }}>Refusée</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Aucune réservation trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reservations->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $reservations->links() }}
    </div>
    @endif
</div>
@endsection
