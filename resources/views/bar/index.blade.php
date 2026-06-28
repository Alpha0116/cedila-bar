@extends('layouts.app')

@section('content')
<!-- Hero Slider -->
<div id="barCarousel" class="carousel slide carousel-fade mb-5" style="margin-top: -1.5rem;">
    <div class="carousel-inner" style="height: 60vh; min-height: 400px;">
        <div class="carousel-item active h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_1.jpg') }}'); background-size: cover; background-position: top;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">L'ambiance idéale pour vos soirées inoubliables</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_2.jpg') }}'); background-size: cover; background-position: top;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">Cocktails, musique et convivialité</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_3.png') }}'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">Un cadre unique pour se retrouver</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_4.jpg') }}'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">Des moments chaleureux à partager</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_5.jpg') }}'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">L'endroit parfait pour décompresser</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_6.png') }}'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">L'ambiance de vos meilleures soirées</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item h-100" data-bs-interval="2500">
            <div class="w-100 h-100" style="background-image: url('{{ asset('images/bar_bg_7.png') }}'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100" style="background: rgba(0,0,0,0.5);">
                    <div class="text-center text-white px-3">
                        <h1 class="display-3 fw-bold mb-3">CEDILA BAR</h1>
                        <p class="lead fs-4">Le rendez-vous incontournable</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#barCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#barCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>

<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: var(--cedila-title);"><i class="fa-solid fa-martini-glass-citrus"></i> Notre Carte des Boissons</h2>
        <p class="text-muted fs-5 mx-auto mt-3" style="max-width: 600px;">
            Découvrez notre sélection de boissons et cocktails.
        </p>
    </div>

    <!-- Barre de Recherche -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Rechercher une boisson..." onkeyup="filterMenu()">
            </div>
        </div>
    </div>

    <style>
        .category-nav {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            margin-bottom: 2rem;
        }
        .category-nav::-webkit-scrollbar {
            display: none;
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
        <div class="col-12 mb-5">
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
                                <div class="col-lg-4 col-md-6 mb-4 menu-card-wrapper menu-item-card" data-name="{{ strtolower($item->name) }}">
                                    <div class="card h-100 border-0 text-start hover-shadow-lg transition-all" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); cursor: pointer;" onclick="openOrderModal({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ Auth::check() ? 'true' : 'false' }})">
                                        <div style="position: relative; overflow: hidden;">
                                            <img src="{{ $item->image_path ? (str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/'.$item->image_path)) : asset('images/default_drink.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&h=400&fit=crop'" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
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
                    <p class="text-muted text-center py-5">La carte des boissons est en cours de mise à jour.</p>
                @endforelse
            </div>
            
            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="fa-solid fa-martini-glass-empty fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucune boisson ne correspond à votre recherche.</h5>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Événements à venir -->
    <div class="mb-5 pb-3">
        <div class="d-flex align-items-center mb-4">
            <h2 class="fw-bold mb-0" style="color: var(--cedila-title);"><i class="fa-regular fa-calendar-check text-primary me-2"></i> Événements à venir</h2>
        </div>
        
        @if($evenementsAvenir->count() > 0)
            <div class="row">
                @foreach($evenementsAvenir as $evenement)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 hover-shadow-lg transition-all" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                            <div class="menu-card-wrapper" style="position: relative; overflow: hidden;">
                                <img src="{{ $evenement->image_path ? (str_starts_with($evenement->image_path, 'http') ? $evenement->image_path : asset('storage/'.$evenement->image_path)) : asset('images/bar03.jpeg') }}" class="card-img-top" alt="{{ $evenement->title }}" style="height: 250px; object-fit: cover;">
                                <div style="position: absolute; top: 15px; left: 15px; background: white; padding: 6px 15px; border-radius: 12px; font-weight: bold; font-size: 1.1rem; color: var(--cedila-title); box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    {{ \Carbon\Carbon::parse($evenement->event_date)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column bg-white">
                                <h4 class="card-title fw-bold text-dark mb-3">{{ $evenement->title }}</h4>
                                <p class="text-muted flex-grow-1" style="font-size: 1.05rem;">{{ $evenement->description }}</p>
                                
                                <div class="mt-3 text-center">
                                    <button class="btn btn-outline-danger rounded-pill fw-bold py-2 px-4 shadow-sm like-btn" onclick="likeEvent(this, {{ $evenement->id }})">
                                        <i class="fa-regular fa-heart me-1"></i> 
                                        <span class="like-count">{{ $evenement->likes ?? 0 }}</span> J'aime
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert bg-white border-0 text-center py-5 shadow-sm" style="border-radius: 20px;">
                <i class="fa-solid fa-calendar-xmark fa-4x text-muted mb-4 opacity-50"></i>
                <h4 class="text-muted fw-bold">Aucun événement prévu pour le moment.</h4>
                <p class="text-muted mb-0">Restez connectés pour nos prochaines soirées !</p>
            </div>
        @endif
    </div>

    <!-- Événements passés -->
    @if($evenementsPasses->count() > 0)
    <div class="pt-3 border-top">
        <div class="d-flex align-items-center mb-4 mt-4">
            <h3 class="fw-bold mb-0 text-muted"><i class="fa-solid fa-clock-rotate-left me-2"></i> Nos soirées passées</h3>
        </div>
        
        <div class="row">
            @foreach($evenementsPasses as $evenement)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 bg-light" style="border-radius: 15px; overflow: hidden; opacity: 0.85; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                        <div style="position: relative; overflow: hidden;">
                            <img src="{{ $evenement->image_path ? (str_starts_with($evenement->image_path, 'http') ? $evenement->image_path : asset('storage/'.$evenement->image_path)) : asset('images/bar03.jpeg') }}" class="card-img-top" alt="{{ $evenement->title }}" style="height: 180px; object-fit: cover; filter: grayscale(40%);">
                            <div style="position: absolute; top: 12px; left: 12px; background: rgba(0,0,0,0.6); color: white; padding: 4px 10px; border-radius: 8px; font-weight: bold; font-size: 0.85rem;">
                                Terminé le {{ \Carbon\Carbon::parse($evenement->event_date)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <h5 class="card-title fw-bold text-muted mb-2">{{ $evenement->title }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($evenement->description, 80) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = document.getElementById('barCarousel');
        if (myCarousel) {
            new bootstrap.Carousel(myCarousel, {
                interval: 2500,
                ride: 'carousel',
                pause: false
            });
        }
    });

    function likeEvent(btn, eventId) {
        btn.disabled = true;
        
        fetch(`/evenements/${eventId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                let icon = btn.querySelector('i');
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                btn.classList.remove('btn-outline-danger');
                btn.classList.add('btn-danger');
                
                btn.querySelector('.like-count').innerText = data.likes;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.disabled = false;
        });
    }
</script>
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

        for (var i = 0; i < items.length; i++) {
            var name = items[i].getAttribute('data-name');
            if (name.includes(input)) {
                items[i].style.display = "";
                hasVisibleItems = true;
            } else {
                items[i].style.display = "none";
            }
        }

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

        document.getElementById('noResults').style.display = hasVisibleItems ? "none" : "block";
    }

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
@endsection
