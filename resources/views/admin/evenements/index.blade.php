@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Événements & Soirées</h3>
    <a href="{{ route('admin.evenements.create') }}" class="btn btn-primary fw-bold rounded-pill px-4">
        <i class="fa-solid fa-plus me-1"></i> Nouvel événement
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3 rounded-top-start">Affiche</th>
                        <th class="border-0 px-4 py-3">Titre</th>
                        <th class="border-0 px-4 py-3">Date</th>
                        <th class="border-0 px-4 py-3 text-center">J'aime <i class="fa-solid fa-heart text-danger"></i></th>
                        <th class="border-0 px-4 py-3 text-center">Statut</th>
                        <th class="border-0 px-4 py-3 rounded-top-end text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($evenements as $evenement)
                    <tr>
                        <td class="px-4 py-3">
                            @if($evenement->image_path)
                                <img src="{{ str_starts_with($evenement->image_path, 'http') ? $evenement->image_path : asset('storage/'.$evenement->image_path) }}" alt="{{ $evenement->title }}" class="rounded-3" style="width: 80px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 80px; height: 50px;">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 fw-bold">{{ $evenement->title }}</td>
                        <td class="px-4 py-3">
                            <span class="text-navy fw-bold"><i class="fa-regular fa-calendar-days me-1"></i> {{ \Carbon\Carbon::parse($evenement->event_date)->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-4 py-3 text-center fw-bold">{{ $evenement->likes }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($evenement->is_published)
                                <span class="badge bg-success"><i class="fa-solid fa-eye me-1"></i> Publié</span>
                            @else
                                <span class="badge bg-secondary"><i class="fa-solid fa-eye-slash me-1"></i> Brouillon</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('admin.evenements.edit', $evenement->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.evenements.destroy', $evenement->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle ms-1" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-champagne-glasses fs-1 mb-3 text-light"></i>
                            <p>Aucun événement planifié.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($evenements->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $evenements->links() }}
    </div>
    @endif
</div>
@endsection
