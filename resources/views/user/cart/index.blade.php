@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: var(--cedila-title);">
        <i class="fa-solid fa-cart-shopping me-2 text-warning"></i> Mon Panier
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
                                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="rounded-3 me-3 object-fit-cover shadow-sm" style="width: 50px; height: 50px;">
                                            @else
                                                <div class="rounded-3 me-3 bg-light d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 50px; height: 50px;">
                                                    <i class="fa-solid fa-utensils"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-bold text-uppercase">{{ $item['quantity'] }} X {{ $item['name'] }}</h6>
                                                <div class="small text-muted mt-1">{{ $item['price'] }} FCFA</div>
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @if(!empty($item['special_request']))
                                                        <span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.7rem;"><i class="fa-solid fa-note-sticky me-1"></i> {{ $item['special_request'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="fw-bold mb-2" style="color: var(--cedila-title);">{{ $item['price'] * $item['quantity'] }} FCFA</div>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" style="width: 32px; height: 32px;" title="Retirer">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
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
                            
                            <!-- Couverts (Applies to all) -->
                            <div class="mb-4 bg-light p-3 rounded-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1"><i class="fa-solid fa-utensils me-2"></i> Besoin de couvert ?</h6>
                                        <small class="text-muted">Aidez-nous à réduire le gaspillage.</small>
                                    </div>
                                    <div class="form-check form-switch fs-4 mb-0">
                                        <input class="form-check-input" type="checkbox" name="needs_cutlery" id="needsCutlery" value="1">
                                    </div>
                                </div>
                            </div>

                            <!-- Mode de récupération -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Type de commande</label>
                                <select name="delivery_type" class="form-select form-select-lg rounded-pill" id="cartDeliveryType" onchange="toggleCartAddress()" required>
                                    <option value="" disabled selected>Sélectionnez une option</option>
                                    <option value="pickup">Retrait sur place</option>
                                    <option value="delivery">Livraison à domicile</option>
                                </select>
                            </div>
                            
                            <!-- Delivery details -->
                            <div id="cartAddressBlock" style="display: none;">
                                <div class="mb-4 bg-light p-3 rounded-4">
                                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-location-dot me-2"></i> Où voulez-vous être livré ?</h6>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Adresse de livraison</label>
                                        <textarea name="delivery_address" class="form-control rounded-3" rows="3" placeholder="Quartier, rue, repère exact..."></textarea>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">Cette adresse est-elle correcte ?</h6>
                                            <small class="text-muted">Nous demanderons au livreur de vous contacter.</small>
                                        </div>
                                        <div class="form-check form-switch fs-4 mb-0">
                                            <!-- Just a UI verification toggle -->
                                            <input class="form-check-input" type="checkbox" id="addressVerification" value="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Special requests (Global) -->
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i> Quelques choses à ajouter, des allergies ?</label>
                                <textarea name="global_special_request" class="form-control rounded-3" rows="2" placeholder="Ex: Pas trop épicé, sans oignons..."></textarea>
                            </div>

                            <!-- Mode de Paiement (Only for Delivery) -->
                            <div id="paymentOptionsBlock" style="display: none;">
                                <div class="mb-4 bg-light p-3 rounded-4">
                                    <h6 class="fw-bold mb-3">MODE DE PAIEMENT</h6>
                                    
                                    <div class="form-check mb-3 p-3 border rounded-3 bg-white">
                                        <input class="form-check-input float-end mt-1 fs-5" type="radio" name="payment_method" id="payCash" value="cash">
                                        <label class="form-check-label w-100" for="payCash">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-wallet fs-4 me-3 text-primary"></i>
                                                <div>
                                                    <div class="fw-bold">Paiement cash</div>
                                                    <small class="text-muted">Payez cash à la livraison.</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-check p-3 border rounded-3 bg-white">
                                        <input class="form-check-input float-end mt-1 fs-5" type="radio" name="payment_method" id="payMobile" value="mobile">
                                        <label class="form-check-label w-100" for="payMobile">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-mobile-screen-button fs-4 me-3 text-warning"></i>
                                                <div>
                                                    <div class="fw-bold">Paiement mobile</div>
                                                    <small class="text-muted">MTN, Moov, Celtis</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning text-dark btn-lg w-100 rounded-pill fw-bold shadow-sm py-3" id="submitOrderBtn">
                                Finaliser votre commande <i class="fa-solid fa-chevron-right ms-2"></i>
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
        const addressBlock = document.getElementById('cartAddressBlock');
        const paymentBlock = document.getElementById('paymentOptionsBlock');
        const addressTextarea = addressBlock.querySelector('textarea');
        const addressToggle = document.getElementById('addressVerification');
        const paymentRadios = paymentBlock.querySelectorAll('input[type="radio"]');
        
        if (type === 'delivery') {
            addressBlock.style.display = 'block';
            paymentBlock.style.display = 'block';
            addressTextarea.required = true;
            addressToggle.required = true;
            paymentRadios.forEach(r => r.required = true);
        } else {
            addressBlock.style.display = 'none';
            paymentBlock.style.display = 'none';
            addressTextarea.required = false;
            addressToggle.required = false;
            paymentRadios.forEach(r => {
                r.required = false;
                r.checked = false; // reset selection
            });
        }
    }
</script>
@endsection
