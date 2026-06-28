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

    <!-- Barre de Recherche et Filtres -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Rechercher un plat, un ingrédient..." onkeyup="filterMenu()">
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Menu Principal -->
        <div class="col-12 mb-5">
            <h3 class="mb-4 border-bottom pb-2 fw-bold text-navy">Notre Carte Complète</h3>
            
            <div class="row" id="menuContainer">
                @forelse($foodItems as $item)
                    <div class="col-lg-4 col-md-6 mb-4 menu-card-wrapper" data-name="{{ strtolower($item->name) }}" data-desc="{{ strtolower($item->description) }}">
                        <div class="card h-100 border-0 text-start hover-shadow-lg transition-all" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); cursor: pointer;" onclick="openOrderModal({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ Auth::check() ? 'true' : 'false' }})">
                            <div style="position: relative; overflow: hidden;">
                                <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/'.$item->image_path)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop' }}" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
                                
                                <div style="position: absolute; top: 12px; left: 12px; background: white; padding: 4px 10px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; color: #333;">
                                    <i class="fa-solid fa-gift text-purple" style="color: #8A2BE2;"></i> Offre du moment
                                </div>
                                <div style="position: absolute; top: 12px; right: 12px; background: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    <i class="fa-regular fa-heart text-muted"></i>
                                </div>
                            </div>

                            <div class="card-body p-3">
                                <p class="text-uppercase text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fa-solid fa-store me-1"></i> CEDILA BAR RESTAURANT
                                </p>
                                <h5 class="card-title fw-bold mb-2 text-dark" style="font-size: 1rem; line-height: 1.2;">
                                    {{ strtoupper($item->name) }}
                                </h5>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <span class="fw-bold fs-5 text-dark">{{ number_format($item->price, 0, ',', ' ') }} FCFA</span>
                                </div>

                                <button class="btn btn-primary w-100 rounded-pill fw-bold" onclick="event.stopPropagation(); openOrderModal({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ Auth::check() ? 'true' : 'false' }})">
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">La carte est en cours de mise à jour.</p>
                @endforelse
            </div>
            
            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="fa-solid fa-plate-wheat fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucun plat ne correspond à votre recherche.</h5>
            </div>
        </div>
    </div>
</div>

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
                <p class="text-muted mb-4">Prix unitaire: <span id="modalItemPrice" class="fw-bold text-primary"></span> €</p>
                
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="single_item_id" id="modalItemIdInput" value="">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Quantité</label>
                        <input type="number" name="quantity" class="form-control form-control-lg" value="1" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Où manger ?</label>
                        <select name="delivery_type" class="form-select form-select-lg" id="modalDeliveryType" onchange="toggleModalAddress()">
                            <option value="pickup">Sur place / À emporter</option>
                            <option value="delivery">Livraison</option>
                        </select>
                    </div>
                    
                    <div class="mb-3" id="modalAddressField" style="display: none;">
                        <label class="form-label fw-bold small">Adresse de livraison</label>
                        <textarea name="delivery_address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Demande spéciale</label>
                        <textarea name="special_request" class="form-control" rows="2" placeholder="Ex: Sans oignons..."></textarea>
                    </div>

                    @auth
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Valider la commande</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 fw-bold">Se connecter pour commander</a>
                    @endauth
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Filtrage JS de la carte
    function filterMenu() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var cards = document.getElementsByClassName('menu-card-wrapper');
        var visibleCount = 0;

        for (var i = 0; i < cards.length; i++) {
            var name = cards[i].getAttribute('data-name');
            var desc = cards[i].getAttribute('data-desc');
            
            if (name.includes(input) || desc.includes(input)) {
                cards[i].style.display = "";
                visibleCount++;
            } else {
                cards[i].style.display = "none";
            }
        }
        
        document.getElementById('noResults').style.display = (visibleCount === 0) ? "block" : "none";
    }

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
