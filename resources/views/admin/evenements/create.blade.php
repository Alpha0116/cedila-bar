@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Créer un Événement</h3>
    <a href="{{ route('admin.evenements.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Retour
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.evenements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Titre de l'événement <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Description complète <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Date de l'événement <span class="text-danger">*</span></label>
                        <input type="date" name="event_date" class="form-control form-control-lg @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" required>
                        @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border border-light bg-light rounded-4 mb-4">
                        <div class="card-body">
                            <label class="form-label fw-bold">Affiche de l'événement</label>
                            <input type="file" name="image" class="form-control mb-2 @error('image') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Formats acceptés: jpg, jpeg, png (Max 2MB)</div>
                            @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="card border border-light bg-light rounded-4">
                        <div class="card-body">
                            <label class="form-label fw-bold">Visibilité</label>
                            <div class="form-check form-switch form-check-lg mt-2">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} style="transform: scale(1.3); margin-left: -1.5rem; margin-right: 1rem;">
                                <label class="form-check-label pt-1" for="is_published">Publier l'événement</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-pill px-5">
                    <i class="fa-solid fa-save me-2"></i> Enregistrer l'événement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
