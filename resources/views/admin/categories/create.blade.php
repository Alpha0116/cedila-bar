@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: var(--cedila-title);">Nouvelle Catégorie</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill fw-bold px-4">
        <i class="fa-solid fa-arrow-left me-2"></i> Retour
    </a>
</div>

<div class="card border-0 bg-light rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nom de la catégorie</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Type (Menu où la catégorie apparaîtra)</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="food" {{ old('type') == 'food' ? 'selected' : '' }}>Nourriture (Restaurant)</option>
                    <option value="drink" {{ old('type') == 'drink' ? 'selected' : '' }}>Boisson (Bar)</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sort_order" class="form-label fw-bold">Ordre d'affichage</label>
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" required>
                <div class="form-text">Plus le nombre est petit, plus la catégorie apparaîtra haut dans la liste (ex: 10, 20, 30).</div>
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-pill fw-bold px-5">
                <i class="fa-solid fa-save me-2"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
@endsection
