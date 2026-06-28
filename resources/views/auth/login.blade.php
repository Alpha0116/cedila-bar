@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: var(--cedila-title);">Bon retour !</h2>
                        <p class="text-muted">Connectez-vous pour passer commande.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 12px;" role="alert">
                            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold small text-muted">Adresse Email</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="votre@email.com" style="border-radius: 12px;">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold small text-muted">Mot de passe</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••" style="border-radius: 12px 0 0 12px;">
                                <button class="btn btn-light bg-light border-0 text-muted" type="button" onclick="togglePassword('password', this)" style="border-radius: 0 12px 12px 0;">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-primary small text-decoration-none fw-bold" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                                Se connecter
                            </button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted mb-0 small">Nouveau ici ? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Créer un compte</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
