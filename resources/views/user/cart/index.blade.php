@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: var(--cedila-title);">
        <i class="fa-solid fa-cart-shopping me-2 text-primary"></i> Mon Panier
    </h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-light text-center py-5 border-0 shadow-sm rounded-4">
            <i class="fa-solid fa-cart-arrow-down fa-3x text-muted mb-3"></i>
            <h5 class="fw-bold">Votre panier est vide.</h5>
            <a href="{{ route('restaurant.accueil') }}" class="btn btn-primary mt-3 rounded-pill px-4 fw-bold">Voir le menu</a>
        </div>
    @else
        <div class="row">
            <!-- Items Column -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-4">
                            @foreach($cart as $id => $item)
                                <li class="list-group-item p-4">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            @if($item['image'])
                                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="rounded-3 me-3 object-fit-cover shadow-sm" style="width: 70px; height: 70px;">
                                            @else
                                                <div class="rounded-3 me-3 bg-light d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 70px; height: 70px;">
                                                    <i class="fa-solid fa-utensils fa-lg"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h5 class="mb-1 fw-bold">{{ $item['name'] }}</h5>
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @if(!empty($item['accompanying_drink']))
                                                        <span class="badge bg-info text-dark rounded-pill"><i class="fa-solid fa-wine-glass me-1"></i> {{ $item['accompanying_drink'] }}</span>
                                                    @endif
                                                    @if(!empty($item['special_request']))
                                                        <span class="badge bg-warning text-dark rounded-pill"><i class="fa-solid fa-note-sticky me-1"></i> {{ $item['special_request'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold fs-5 text-primary mb-2">{{ $item['price'] }} FCFA x {{ $item['quantity'] }}</div>
                                            <div class="fw-bold text-navy">{{ $item['price'] * $item['quantity'] }} FCFA</div>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fa-solid fa-trash me-1"></i> Retirer</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Checkout Column -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Récapitulatif</h4>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Sous-total</span>
                            <span class="fw-bold">{{ $total }} FCFA</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5 text-navy">Total</span>
                            <span class="fw-bold fs-5 text-primary">{{ $total }} FCFA</span>
                        </div>

                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Où manger ?</label>
                                <select name="delivery_type" class="form-select form-select-lg" id="cartDeliveryType" onchange="toggleCartAddress()" required>
                                    <option value="pickup">Sur place / À emporter</option>
                                    <option value="delivery">A livrer (+ Frais de livraison)</option>
                                </select>
                            </div>
                            
                            <div class="mb-4" id="cartAddressField" style="display: none;">
                                <label class="form-label fw-bold small">Adresse de livraison détaillée</label>
                                <textarea name="delivery_address" class="form-control" rows="3" placeholder="Quartier, rue, repère..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm">
                                <i class="fa-solid fa-check-circle me-2"></i> Valider la commande
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function toggleCartAddress() {
        const type = document.getElementById('cartDeliveryType').value;
        const addressField = document.getElementById('cartAddressField');
        if (type === 'delivery') {
            addressField.style.display = 'block';
            addressField.querySelector('textarea').required = true;
        } else {
            addressField.style.display = 'none';
            addressField.querySelector('textarea').required = false;
        }
    }
</script>
@endsection
