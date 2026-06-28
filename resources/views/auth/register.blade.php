@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: var(--cedila-title);">Créer un compte</h2>
                        <p class="text-muted">Rejoignez-nous pour commander plus rapidement.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted">Nom complet</label>
                            <input id="name" type="text" class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Jean Dupont" style="border-radius: 12px;">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold small text-muted">Adresse Email</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="votre@email.com" style="border-radius: 12px;">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold small text-muted">Mot de passe</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••" style="border-radius: 12px 0 0 12px;">
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

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold small text-muted">Confirmer le mot de passe</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control form-control-lg bg-light border-0" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" style="border-radius: 12px 0 0 12px;">
                                <button class="btn btn-light bg-light border-0 text-muted" type="button" onclick="togglePassword('password-confirm', this)" style="border-radius: 0 12px 12px 0;">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                                S'inscrire
                            </button>
                        </div>
                    </form>

                    @if (Route::has('login'))
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted mb-0 small">Déjà un compte ? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Se connecter</a></p>
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
