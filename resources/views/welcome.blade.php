@extends('layouts.app')

@section('content')
<style>
    /* Hero Section with Background Overlay */
    .hero-section {
        position: relative;
        height: 70vh;
        min-height: 500px;
        background-image: url('{{ asset("images/bacground.jpeg") }}');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }

    /* Infinite Marquee Animation for Photos */
    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        width: 100%;
        padding: 20px 0;
    }

    .marquee-track {
        display: inline-block;
        animation: marquee 25s linear infinite;
    }

    /* Pause animation on hover */
    .marquee-container:hover .marquee-track {
        animation-play-state: paused;
    }

    .marquee-track img {
        height: 250px;
        width: 350px;
        object-fit: cover;
        border-radius: 12px;
        margin-right: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .marquee-track img:hover {
        transform: scale(1.05);
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Section Styling */
    .section-title {
        font-weight: 800;
        color: var(--cedila-title);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }
    .section-title::after {
        content: '';
        width: 50px;
        height: 4px;
        background-color: #ffd700; /* Subtle touch of gold from logo */
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Modern Footer */
    .custom-footer {
        background-color: var(--cedila-navy);
        color: #fff;
        padding: 40px 0 20px;
        margin-top: 60px;
    }
</style>

<!-- HERO SECTION -->
<div id="homeCarousel" class="carousel slide carousel-fade shadow-lg" style="margin-top: -1.5rem;">
    <div class="carousel-inner" style="height: 70vh; min-height: 500px;">
        <div class="carousel-item active h-100" data-bs-interval="3000">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/home_bg_1.jpg') }}'); background-size: cover; background-position: top;">
                <div class="hero-overlay"></div>
                <div class="d-flex align-items-center justify-content-center h-100 position-relative" style="z-index: 2;">
                    <div class="text-center text-white px-3">
                        <h1 class="display-2 fw-bold mb-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">CEDILA</h1>
                        <h3 class="fw-light mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.8);">Restaurant, Bar & Lounge de Prestige</h3>
                        <p class="lead mx-auto" style="max-width: 700px;">Plongez dans une atmosphère unique où la gastronomie raffinée rencontre l'art de la mixologie.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="3000">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/home_bg_2.jpg') }}'); background-size: cover; background-position: top;">
                <div class="hero-overlay"></div>
                <div class="d-flex align-items-center justify-content-center h-100 position-relative" style="z-index: 2;">
                    <div class="text-center text-white px-3">
                        <h1 class="display-2 fw-bold mb-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">CEDILA</h1>
                        <h3 class="fw-light mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.8);">Restaurant, Bar & Lounge de Prestige</h3>
                        <p class="lead mx-auto" style="max-width: 700px;">Une expérience inoubliable vous attend, midi et soir.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="3000">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/home_bg_3.jpg') }}'); background-size: cover; background-position: top;">
                <div class="hero-overlay"></div>
                <div class="d-flex align-items-center justify-content-center h-100 position-relative" style="z-index: 2;">
                    <div class="text-center text-white px-3">
                        <h1 class="display-2 fw-bold mb-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">CEDILA</h1>
                        <h3 class="fw-light mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.8);">Restaurant, Bar & Lounge de Prestige</h3>
                        <p class="lead mx-auto" style="max-width: 700px;">Le lieu de rendez-vous incontournable pour vos moments de détente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev" style="z-index: 3;">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next" style="z-index: 3;">
        <span class="carousel-control-next-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = document.getElementById('homeCarousel');
        if (myCarousel) {
            new bootstrap.Carousel(myCarousel, {
                interval: 3000,
                ride: 'carousel',
                pause: false
            });
        }
    });
</script>

<div class="container-fluid px-0 mt-5">
    
    <!-- RESTAURANT SECTION -->
    <div class="py-5 bg-white text-center">
        <div class="container mb-4">
            <h2 class="section-title"><i class="fa-solid fa-utensils me-2"></i> Le Restaurant</h2>
            <p class="text-muted fs-5 mx-auto mt-4" style="max-width: 600px;">
                Des plats savoureux préparés avec passion. Découvrez notre sélection pour ravir vos papilles.
            </p>
        </div>

        <!-- Marquee Slider Restaurant -->
        <div class="marquee-container mb-4">
            <div class="marquee-track">
                <!-- First Set -->
                <img src="{{ asset('images/restau01.jpeg') }}" alt="Ambiance 1">
                <img src="{{ asset('images/restau02.jpeg') }}" alt="Ambiance 2">
                <img src="{{ asset('images/restau03.jpeg') }}" alt="Ambiance 3">
                <img src="{{ asset('images/restau04.jpeg') }}" alt="Ambiance 4">
                <img src="{{ asset('images/restau05.jpeg') }}" alt="Ambiance 5">
                
                <!-- Duplicate Set -->
                <img src="{{ asset('images/restau01.jpeg') }}" alt="Ambiance 1">
                <img src="{{ asset('images/restau02.jpeg') }}" alt="Ambiance 2">
                <img src="{{ asset('images/restau03.jpeg') }}" alt="Ambiance 3">
                <img src="{{ asset('images/restau04.jpeg') }}" alt="Ambiance 4">
                <img src="{{ asset('images/restau05.jpeg') }}" alt="Ambiance 5">
            </div>
        </div>

        <div class="container mt-5 text-start">
            <h2 class="fw-bold mb-0" style="color: #1a1a1a; font-size: 2rem;">Les offres du moment</h2>
            <p class="text-muted mb-4" style="font-size: 1.1rem;">Celles qui partent le plus vite cette semaine</p>
            
            <div class="row">
                @forelse($foodItems as $item)
                    <div class="col-lg-4 col-md-6 mb-5 menu-card-wrapper">
                        <div class="card h-100 border-0 text-start hover-shadow-lg transition-all" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); cursor: pointer;" onclick="openOrderModal({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ Auth::check() ? 'true' : 'false' }})">
                            <div style="position: relative; overflow: hidden;">
                                <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/'.$item->image_path)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop' }}" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
                                
                                <!-- Badges sur l'image -->
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
                    <p class="text-muted">Menu en cours de préparation.</p>
                @endforelse
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('restaurant.accueil') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5 fw-bold shadow-sm">Voir plus d'offres <i class="fa-solid fa-arrow-right ms-2"></i></a>
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

                    @auth
                        <button type="submit" class="btn btn-primary w-100 btn-lg rounded-pill fw-bold shadow-sm">
                            <i class="fa-solid fa-cart-plus me-2"></i> Ajouter au panier
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 fw-bold">Se connecter pour commander</a>
                    @endauth
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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

<!-- FOOTER -->
<footer class="custom-footer">
    <div class="container text-center">
        <div class="row justify-content-center mb-4">
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">CEDILA</h5>
                <p class="text-white-50 small">Votre adresse incontournable pour savourer, célébrer et se détendre.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">Contact</h5>
                <p class="text-white-50 small mb-1"><i class="fa-solid fa-location-dot me-2"></i> 123 Avenue de la Gastronomie</p>
                <p class="text-white-50 small mb-1"><i class="fa-solid fa-phone me-2"></i> +33 1 23 45 67 89</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">Horaires</h5>
                <p class="text-white-50 small mb-1">Lun - Jeu : 11h00 - 00h00</p>
                <p class="text-white-50 small mb-1">Ven - Sam : 11h00 - 02h00</p>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} CEDILA Bar & Restaurant. Tous droits réservés.</p>
    </div>
</footer>

@endsection
