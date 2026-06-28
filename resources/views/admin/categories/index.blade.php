@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: var(--cedila-title);">Gestion des Catégories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-pill fw-bold px-4">
        <i class="fa-solid fa-plus me-2"></i> Nouvelle Catégorie
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Ordre d'affichage</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="fw-bold">{{ $category->name }}</td>
                    <td>
                        @if($category->type == 'food')
                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-utensils me-1"></i> Nourriture</span>
                        @else
                            <span class="badge bg-info text-dark"><i class="fa-solid fa-glass-water me-1"></i> Boisson</span>
                        @endif
                    </td>
                    <td>{{ $category->sort_order }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Modifier">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Supprimer">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Aucune catégorie trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $categories->links() }}
</div>
@endsection
