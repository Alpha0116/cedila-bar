@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Vue d'ensemble</h3>
    <span class="text-muted"><i class="fa-regular fa-clock me-1"></i> {{ now()->format('d/m/Y H:i') }}</span>
</div>

<div class="row g-4 mb-5">
    <!-- Stat: Commandes -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-bold mb-1">Commandes</h6>
                        <h2 class="fw-bold mb-0">{{ $orders->count() }}</h2>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-cart-shopping fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stat: Réservations -->
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background: var(--cedila-navy); color: white;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-bold mb-1">Réservations</h6>
                        <h2 class="fw-bold mb-0">{{ $reservations->count() }}</h2>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fa-regular fa-calendar-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Activité récente -->
    <div class="col-12">
        <h5 class="fw-bold mb-4" style="color: var(--cedila-title);">Activité récente</h5>
        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3 rounded-top-start">Type</th>
                                <th class="border-0 px-4 py-3">Client</th>
                                <th class="border-0 px-4 py-3">Détails</th>
                                <th class="border-0 px-4 py-3 rounded-top-end text-end">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders->take(3) as $order)
                            <tr>
                                <td class="px-4 py-3"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary"><i class="fa-solid fa-cart-shopping me-1"></i> Commande</span></td>
                                <td class="px-4 py-3 fw-bold">{{ $order->user->name }}</td>
                                <td class="px-4 py-3 text-muted">{{ $order->items->count() }} article(s) - {{ $order->total_price }} FCFA</td>
                                <td class="px-4 py-3 text-end">
                                    <span class="badge bg-secondary">{{ strtoupper($order->status) }}</span>
                                </td>
                            </tr>
                            @empty
                            @endforelse

                            @forelse($reservations->take(3) as $res)
                            <tr>
                                <td class="px-4 py-3"><span class="badge bg-navy bg-opacity-10 text-navy border border-navy" style="color: var(--cedila-title); border-color: var(--cedila-navy);"><i class="fa-regular fa-calendar-check me-1"></i> Réservation</span></td>
                                <td class="px-4 py-3 fw-bold">{{ $res->user->name }}</td>
                                <td class="px-4 py-3 text-muted">{{ $res->guests }} pers. - {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m Y H:i') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <span class="badge bg-secondary">{{ strtoupper($res->status) }}</span>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-center py-3 rounded-bottom-4">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Gérer les commandes</a>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm btn-outline-navy rounded-pill px-4" style="color: var(--cedila-title); border-color: var(--cedila-navy);">Gérer les réservations</a>
            </div>
        </div>
    </div>
</div>
@endsection
