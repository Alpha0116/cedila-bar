@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Menu & Boissons</h3>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary fw-bold rounded-pill px-4">
        <i class="fa-solid fa-plus me-1"></i> Ajouter un article
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3 rounded-top-start">Image</th>
                        <th class="border-0 px-4 py-3">Nom</th>
                        <th class="border-0 px-4 py-3">Catégorie</th>
                        <th class="border-0 px-4 py-3 text-end">Prix</th>
                        <th class="border-0 px-4 py-3 text-center">Disponibilité</th>
                        <th class="border-0 px-4 py-3 rounded-top-end text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                    <tr>
                        <td class="px-4 py-3">
                            @if($menu->image_path)
                                <img src="{{ str_starts_with($menu->image_path, 'http') ? $menu->image_path : asset('storage/'.$menu->image_path) }}" alt="{{ $menu->name }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 fw-bold">{{ $menu->name }}</td>
                        <td class="px-4 py-3 text-capitalize">
                            @if($menu->category)
                                <span class="badge {{ $menu->category->type == 'food' ? 'bg-warning' : 'bg-info' }} text-dark">
                                    <i class="fa-solid {{ $menu->category->type == 'food' ? 'fa-burger' : 'fa-martini-glass' }} me-1"></i> {{ $menu->category->name }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Non catégorisé</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end fw-bold">{{ $menu->price }} FCFA</td>
                        <td class="px-4 py-3 text-center">
                            @if($menu->is_available_today)
                                <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i> Disponible</span>
                            @else
                                <span class="badge bg-danger"><i class="fa-solid fa-xmark me-1"></i> Épuisé</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle ms-1" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-utensils fs-1 mb-3 text-light"></i>
                            <p>Aucun article dans le menu pour le moment.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($menus->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $menus->links() }}
    </div>
    @endif
</div>
@endsection
