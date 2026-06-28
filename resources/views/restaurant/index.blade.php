@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color: var(--cedila-title);"><i class="fa-solid fa-utensils"></i> Le Restaurant</h1>
        <p class="text-muted fs-5 mx-auto mt-3" style="max-width: 600px;">
            Découvrez notre carte gourmande. Cherchez un plat spécifique ou parcourez nos spécialités.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @auth
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 text-center">
                <a href="{{ route('user.orders.index') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> Suivre mes commandes et réservations
                </a>
            </div>
        </div>
    @endauth

    <!-- Barre de Recherche et Filtres -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Rechercher un plat, un ingrédient..." onkeyup="filterMenu()">
            </div>
        </div>
    </div>

    <style>
        /* Custom Scrollbar for pills */
        .category-nav {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
            margin-bottom: 2rem;
        }
        .category-nav::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        
        .category-pill {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            border-radius: 50px;
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .category-pill:hover, .category-pill.active {
            background-color: #212529;
            color: #fff;
        }

        .category-section {
            padding-top: 20px;
            margin-bottom: 40px;
        }
        .category-header {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #212529;
            border-bottom: 2px solid #f1f3f5;
            padding-bottom: 10px;
        }
    </style>

    <div class="row">
        <!-- Menu Principal -->
        <div class="col-12 mb-5">
            
            <!-- Category Pills Navigation -->
            <div class="category-nav">
                <a href="#all" class="category-pill active">Toutes les catégories</a>
                @foreach($categories as $category)
                    <a href="#cat-{{ $category->id }}" class="category-pill">{{ $category->name }}</a>
                @endforeach
            </div>
            
            <div id="menuContainer">
                @forelse($categories as $category)
                    <div class="category-section" id="cat-{{ $category->id }}">
                        <h2 class="category-header">{{ strtoupper($category->name) }}</h2>
                        <div class="row">
                            @foreach($category->menuItems as $item)
                                <div class="col-lg-4 col-md-6 mb-4 menu-card-wrapper menu-item-card" data-name="{{ strtolower($item->name) }}" data-desc="{{ strtolower($item->description) }}">
                                    <div class="card h-100 border-0 text-start hover-shadow-lg transition-all" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); cursor: pointer;" onclick="openOrderModal({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ Auth::check() ? 'true' : 'false' }})">
                                        <div style="position: relative; overflow: hidden;">
                                            <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/'.$item->image_path)) : asset('images/default_food.png') }}" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop'" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
                                            <div style="position: absolute; bottom: 10px; right: 10px; background: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                                <i class="fa-solid fa-plus text-primary fs-5"></i>
                                            </div>
                                        </div>

                                        <div class="card-body p-3">
                                            <h5 class="card-title fw-bold mb-1 text-dark" style="font-size: 1.1rem;">
                                                {{ strtoupper($item->name) }}
                                            </h5>
                                            @if($item->description)
                                                <p class="text-muted small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $item->description }}
                                                </p>
                                            @endif
                                            
                                            <div class="d-flex align-items-center mt-2">
                                                <span class="fw-bold fs-6 text-dark">{{ number_format($item->price, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-5">La carte est en cours de mise à jour.</p>
                @endforelse
            </div>
            
            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="fa-solid fa-plate-wheat fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucun plat ne correspond à votre recherche.</h5>
            </div>
        </div>
    </div>
</div>

<script>
    function filterMenu() {
        // Reset pills to "All" when searching
        document.querySelectorAll('.category-pill').forEach(p => p.classList.remove('active'));
        var allPill = document.querySelector('a[href="#all"]');
        if(allPill) allPill.classList.add('active');

        var input = document.getElementById('searchInput').value.toLowerCase();
        var items = document.getElementsByClassName('menu-item-card');
        var categories = document.getElementsByClassName('category-section');
        var hasVisibleItems = false;

        // Filter items
        for (var i = 0; i < items.length; i++) {
            var name = items[i].getAttribute('data-name');
            if (name.includes(input)) {
                items[i].style.display = "";
                hasVisibleItems = true;
            } else {
                items[i].style.display = "none";
            }
        }

        // Hide empty categories
        for (var j = 0; j < categories.length; j++) {
            var catItems = categories[j].getElementsByClassName('menu-item-card');
            var catHasVisible = false;
            for (var k = 0; k < catItems.length; k++) {
                if (catItems[k].style.display !== "none") {
                    catHasVisible = true;
                    break;
                }
            }
            categories[j].style.display = catHasVisible ? "" : "none";
        }

        // Show/hide no results message
        document.getElementById('noResults').style.display = hasVisibleItems ? "none" : "block";
    }

    // Active state for pills on scroll
    document.querySelectorAll('.category-pill').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.category-pill').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            var targetId = this.getAttribute('href');
            
            if (targetId === '#all') {
                document.querySelectorAll('.category-section').forEach(sec => sec.style.display = 'block');
                document.getElementById('searchInput').value = '';
                filterMenu(); // Reset search logic
            } else {
                document.querySelectorAll('.category-section').forEach(sec => {
                    if ('#' + sec.id === targetId) {
                        sec.style.display = 'block';
                    } else {
                        sec.style.display = 'none';
                    }
                });
                document.getElementById('searchInput').value = '';
                // Ensure items inside target section are visible
                var targetSec = document.querySelector(targetId);
                if (targetSec) {
                    targetSec.querySelectorAll('.menu-item-card').forEach(item => item.style.display = '');
                }
            }
        });
    });
</script>

<!-- Modal Commande Rapide -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="orderModalLabel"><i class="fa-solid fa-cart-shopping text-primary me-2"></i> Commander</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <h4 id="modalItemName" class="mb-1 fw-bold text-navy"></h4>
                <p class="text-muted mb-4">Prix unitaire: <span id="modalItemPrice" class="fw-bold text-primary"></span> FCFA</p>
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <!-- We pass only one item in the array to keep compatibility with OrderController logic -->
                    <input type="hidden" name="single_item_id" id="modalItemIdInput" value="">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Quantité</label>
                        <input type="number" name="quantity" class="form-control form-control-lg" value="1" min="1" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Demande spéciale (optionnel)</label>
                        <textarea name="special_request" class="form-control" rows="2" placeholder="Sans piment, sauce à part..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg rounded-pill fw-bold shadow-sm">
                        <i class="fa-solid fa-cart-plus me-2"></i> Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal Commande
    function openOrderModal(id, name, price, isAuth) {
        if (!isAuth) {
            alert("Veuillez vous connecter pour pouvoir commander.");
            window.location.href = "{{ route('login') }}";
            return;
        }

        document.getElementById('modalItemName').innerText = name;
        document.getElementById('modalItemPrice').innerText = price;
        document.getElementById('modalItemIdInput').value = id;
        
        var modal = new bootstrap.Modal(document.getElementById('orderModal'));
        modal.show();
    }

    function toggleModalAddress() {
        var val = document.getElementById('modalDeliveryType').value;
        document.getElementById('modalAddressField').style.display = (val === 'delivery') ? 'block' : 'none';
    }
</script>
@endsection
