@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Ajouter un Article</h3>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Retour
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nom de l'article <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Prix (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control form-control-lg @error('price') is-invalid @enderror" value="{{ old('price') }}" required min="0">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Catégorie <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select form-select-lg @error('category_id') is-invalid @enderror" required>
                                <option value="">Choisir une catégorie...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->type == 'food' ? 'Plat' : 'Boisson' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border border-light bg-light rounded-4 mb-4">
                        <div class="card-body">
                            <label class="form-label fw-bold">Image</label>
                            <input type="file" name="image" class="form-control mb-2 @error('image') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Formats acceptés: jpg, jpeg, png (Max 2MB)</div>
                            @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="card border border-light bg-light rounded-4">
                        <div class="card-body">
                            <label class="form-label fw-bold">Disponibilité</label>
                            <div class="form-check form-switch form-check-lg mt-2">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }} style="transform: scale(1.3); margin-left: -1.5rem; margin-right: 1rem;">
                                <label class="form-check-label pt-1" for="is_available">Article disponible à la vente</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill px-5">
                    <i class="fa-solid fa-save me-2"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
