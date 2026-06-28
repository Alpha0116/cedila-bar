@extends('layouts.app')

@section('content')
<style>
    .timeline {
        position: relative;
        padding-left: 2rem;
        list-style: none;
    }
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 14px;
        width: 2px;
        background: #e0e0e0;
    }
    [data-bs-theme="dark"] .timeline::before {
        background: #333;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    .timeline-icon {
        position: absolute;
        left: -2rem;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }
    [data-bs-theme="dark"] .timeline-icon {
        background: var(--cedila-card);
        border-color: #333;
    }
    .timeline-item.active .timeline-icon {
        border-color: var(--cedila-title); /* Navy in light, Gold in dark */
        color: var(--cedila-title);
    }
    .timeline-item.active .timeline-icon i {
        color: var(--cedila-title);
    }
    
    .timeline-item.active::before {
        content: '';
        position: absolute;
        top: 30px; /* start after icon */
        bottom: -2rem;
        left: -14px;
        width: 2px;
        background: var(--cedila-title);
        z-index: 0;
    }
    /* Don't draw line after the last active item if it's the very last step */
    .timeline-item:last-child::before {
        display: none;
    }
    
    .timeline-title {
        font-weight: bold;
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }
    .timeline-date {
        font-size: 0.85rem;
        color: #888;
    }
    .timeline-desc {
        font-size: 0.9rem;
        margin-top: 0.5rem;
        color: var(--cedila-text);
    }
</style>

<div class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('user.orders.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Retour aux commandes
        </a>
        
        @if($order->status == 'received')
            <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold">
                    <i class="fa-solid fa-ban me-1"></i> Annuler la commande
                </button>
            </form>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: var(--cedila-title);">
                    @if($order->status == 'finished')
                        Livrée
                    @elseif($order->status == 'delivery')
                        En livraison
                    @elseif($order->status == 'prep')
                        En préparation
                    @elseif($order->status == 'confirmed')
                        Confirmée
                    @elseif($order->status == 'cancelled')
                        <span class="text-danger">Annulée</span>
                    @else
                        En attente
                    @endif
                </h2>
                <h4 class="fw-bold">{{ $order->created_at->format('d/m/Y H:i:s') }}</h4>
                <p class="text-muted">Commande #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                @if($order->status == 'cancelled')
                    <div class="text-center py-4">
                        <i class="fa-solid fa-ban fa-4x text-danger mb-3"></i>
                        <h4 class="fw-bold text-danger">Commande Annulée</h4>
                        <p class="text-muted">Le restaurant n'a pas pu valider votre commande. Veuillez nous contacter pour plus d'informations.</p>
                    </div>
                @else
                    <ul class="timeline mb-0">
                        <!-- Commande reçue -->
                        <li class="timeline-item active">
                            <div class="timeline-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="timeline-title">Commande reçue</div>
                            <div class="timeline-date">{{ $order->created_at->format('d/m/Y H:i:s') }}</div>
                        </li>

                        <!-- Confirmation du vendeur -->
                        @php $isConfirmed = $order->confirmed_at || $order->prep_at || $order->delivery_at || $order->finished_at; @endphp
                        <li class="timeline-item {{ $isConfirmed ? 'active' : '' }}">
                            <div class="timeline-icon">
                                @if($isConfirmed) <i class="fa-solid fa-check"></i> @endif
                            </div>
                            <div class="timeline-title">Confirmation du vendeur</div>
                            @if($isConfirmed)
                                <div class="timeline-date">{{ $order->confirmed_at ? $order->confirmed_at->format('d/m/Y H:i:s') : $order->created_at->format('d/m/Y H:i:s') }}</div>
                                <div class="timeline-desc">Le vendeur a vérifié la disponibilité des produits.</div>
                            @endif
                        </li>

                        <!-- Préparation -->
                        @php $isPrep = $order->prep_at || $order->delivery_at || $order->finished_at; @endphp
                        <li class="timeline-item {{ $isPrep ? 'active' : '' }}">
                            <div class="timeline-icon">
                                @if($isPrep) <i class="fa-solid fa-check"></i> @endif
                            </div>
                            <div class="timeline-title">Préparation</div>
                            @if($isPrep)
                                <div class="timeline-date">{{ $order->prep_at ? $order->prep_at->format('d/m/Y H:i:s') : '' }}</div>
                            @endif
                        </li>

                        <!-- Livraison (uniquement si le type est livraison) -->
                        @if($order->delivery_type == 'delivery')
                            @php $isDelivery = $order->delivery_at || $order->finished_at; @endphp
                            <li class="timeline-item {{ $isDelivery ? 'active' : '' }}">
                                <div class="timeline-icon">
                                    @if($isDelivery) <i class="fa-solid fa-check"></i> @endif
                                </div>
                                <div class="timeline-title">Livraison</div>
                                @if($isDelivery)
                                    <div class="timeline-date">{{ $order->delivery_at ? $order->delivery_at->format('d/m/Y H:i:s') : '' }}</div>
                                    @if($order->delivery_driver)
                                        <div class="timeline-desc">Votre livreur s'appelle <span class="fw-bold text-uppercase" style="color: var(--cedila-title);">{{ $order->delivery_driver }}</span></div>
                                    @endif
                                @endif
                            </li>
                        @endif

                        <!-- Livrée / Terminée -->
                        @php $isFinished = $order->finished_at; @endphp
                        <li class="timeline-item {{ $isFinished ? 'active' : '' }}">
                            <div class="timeline-icon">
                                @if($isFinished) <i class="fa-solid fa-check"></i> @endif
                            </div>
                            <div class="timeline-title">
                                @if($order->delivery_type == 'delivery') Livrée @else Récupérée @endif
                            </div>
                            @if($isFinished)
                                <div class="timeline-date">{{ $order->finished_at->format('d/m/Y H:i:s') }}</div>
                            @endif
                        </li>
                    </ul>
                @endif
            </div>
            
            <!-- Détails de la commande au bas -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                <h5 class="fw-bold mb-3 text-center">Détail de la commande</h5>
                <hr>
                @foreach($order->items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->quantity }}x {{ $item->menuItem->name ?? 'Article' }}</span>
                        <span class="fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between mb-0">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5" style="color: var(--cedila-title);">{{ number_format($order->total_price, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
