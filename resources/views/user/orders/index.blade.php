@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: var(--cedila-title);">Mes Commandes et Réservations</h2>

    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4 fw-bold" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button" role="tab" aria-controls="pills-orders" aria-selected="true">
                <i class="fa-solid fa-bag-shopping me-2"></i> Commandes
            </button>
        </li>
        <li class="nav-item ms-2" role="presentation">
            <button class="nav-link rounded-pill px-4 fw-bold" id="pills-reservations-tab" data-bs-toggle="pill" data-bs-target="#pills-reservations" type="button" role="tab" aria-controls="pills-reservations" aria-selected="false">
                <i class="fa-regular fa-calendar-check me-2"></i> Réservations
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- Commandes -->
        <div class="tab-pane fade show active" id="pills-orders" role="tabpanel" aria-labelledby="pills-orders-tab" tabindex="0">
            @if($orders->isEmpty())
                <div class="alert alert-light text-center py-5 border-0 shadow-sm rounded-4">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="fw-bold">Vous n'avez pas encore passé de commande.</h5>
                    <a href="{{ route('restaurant.accueil') }}" class="btn btn-primary mt-3 rounded-pill px-4">Voir le Menu</a>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($orders as $order)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow-lg" style="cursor: pointer;" onclick="window.location.href='{{ route('user.orders.show', $order->id) }}'">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold mb-0">Commande #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h5>
                                        @if($order->status == 'finished')
                                            <span class="badge bg-success rounded-pill px-3">Livrée / Terminée</span>
                                        @elseif($order->status == 'delivery')
                                            <span class="badge bg-info text-dark rounded-pill px-3">En livraison</span>
                                        @elseif($order->status == 'prep')
                                            <span class="badge bg-warning text-dark rounded-pill px-3">En préparation</span>
                                        @elseif($order->status == 'confirmed')
                                            <span class="badge bg-primary rounded-pill px-3">Confirmée</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge bg-danger rounded-pill px-3">Annulée</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3">En attente</span>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                                    <p class="fw-bold mb-0">{{ number_format($order->total_price, 0, ',', ' ') }} FCFA</p>
                                    <hr>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Suivre la commande</a>
                                        @if($order->status == 'received')
                                            <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    <i class="fa-solid fa-ban"></i> Annuler
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Reservations -->
        <div class="tab-pane fade" id="pills-reservations" role="tabpanel" aria-labelledby="pills-reservations-tab" tabindex="0">
            @if($reservations->isEmpty())
                <div class="alert alert-light text-center py-5 border-0 shadow-sm rounded-4">
                    <i class="fa-regular fa-calendar-xmark fa-3x text-muted mb-3"></i>
                    <h5 class="fw-bold">Vous n'avez aucune réservation.</h5>
                    <button type="button" class="btn btn-primary mt-3 rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#globalReservationModal">
                        Réserver une table
                    </button>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($reservations as $res)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-chair text-primary me-2"></i> Table pour {{ $res->guests }}</h5>
                                        @if($res->status == 'confirmed')
                                            <span class="badge bg-success rounded-pill px-3">Confirmée</span>
                                        @elseif($res->status == 'cancelled')
                                            <span class="badge bg-danger rounded-pill px-3">Annulée</span>
                                        @elseif($res->status == 'pending')
                                            <span class="badge bg-secondary rounded-pill px-3">En attente</span>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($res->reservation_time)->format('H:i') ?? 'H:i' }}</p>
                                    @if($res->special_request)
                                        <p class="small mb-3"><strong>Demande :</strong> {{ $res->special_request }}</p>
                                    @endif
                                    
                                    @if($res->status == 'pending')
                                        <hr>
                                        <div class="d-flex gap-2 justify-content-end mt-2">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editReservationModal{{ $res->id }}">
                                                <i class="fa-solid fa-pen"></i> Modifier
                                            </button>
                                            <form action="{{ route('user.reservations.cancel', $res->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    <i class="fa-solid fa-ban"></i> Annuler
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Modification Réservation -->
                        <div class="modal fade" id="editReservationModal{{ $res->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-pen text-primary me-2"></i> Modifier la réservation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form action="{{ route('user.reservations.update', $res->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">Date</label>
                                                <input type="date" name="reservation_date" class="form-control" value="{{ $res->reservation_date }}" required min="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">Heure</label>
                                                <input type="time" name="reservation_time" class="form-control" value="{{ $res->reservation_time }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">Nombre de personnes</label>
                                                <input type="number" name="guests" class="form-control" value="{{ $res->guests }}" min="1" max="20" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label fw-bold small">Demande spéciale (optionnel)</label>
                                                <textarea name="special_request" class="form-control" rows="2">{{ $res->special_request }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Enregistrer les modifications</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
