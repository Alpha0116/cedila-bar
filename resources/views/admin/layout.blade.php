@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4 bg-light min-vh-100" style="margin-top: -1.5rem;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                    <h5 class="fw-bold" style="color: var(--cedila-title);">
                        <i class="fa-solid fa-screwdriver-wrench me-2"></i>Administration
                    </h5>
                    <hr class="mt-3 mb-0">
                </div>
                <div class="card-body p-3">
                    <div class="nav flex-column nav-pills" id="admin-menu">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-solid fa-chart-pie me-2"></i> Vue d'ensemble
                        </a>
                        <a href="{{ route('admin.categories.index') ?? '#' }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.categories.*') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-solid fa-layer-group me-2"></i> Catégories
                        </a>
                        <a href="{{ route('admin.menus.index') ?? '#' }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.menus.*') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-solid fa-utensils me-2"></i> Menu & Boissons
                        </a>
                        <a href="{{ route('admin.evenements.index') ?? '#' }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.evenements.*') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-solid fa-champagne-glasses me-2"></i> Événements
                        </a>
                        <a href="{{ route('admin.orders.index') ?? '#' }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.orders.*') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-solid fa-cart-shopping me-2"></i> Commandes
                        </a>
                        <a href="{{ route('admin.reservations.index') ?? '#' }}" class="nav-link fw-bold mb-2 py-3 rounded-3 {{ request()->routeIs('admin.reservations.*') ? 'active text-white' : 'text-secondary' }}">
                            <i class="fa-regular fa-calendar-check me-2"></i> Réservations
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 15px;" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 15px;" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    @yield('admin_content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
