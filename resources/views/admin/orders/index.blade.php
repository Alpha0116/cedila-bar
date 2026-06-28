@extends('admin.layout')

@section('admin_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="color: var(--cedila-title);">Toutes les Commandes</h3>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4 py-3 rounded-top-start">N° Commande</th>
                        <th class="border-0 px-4 py-3">Client</th>
                        <th class="border-0 px-4 py-3">Détails</th>
                        <th class="border-0 px-4 py-3 text-center">Type</th>
                        <th class="border-0 px-4 py-3 text-end">Total</th>
                        <th class="border-0 px-4 py-3 text-center">Statut</th>
                        <th class="border-0 px-4 py-3 rounded-top-end text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-navy">#{{ $order->id }}</td>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td class="px-4 py-3">
                            <ul class="list-unstyled mb-0 small">
                                @foreach($order->items as $item)
                                    <li>
                                        <strong>{{ $item->quantity }}x {{ $item->menuItem->name ?? 'Article inconnu' }}</strong>
                                        @if($item->special_request)
                                            <div class="text-danger ps-2"><i class="fa-solid fa-triangle-exclamation"></i> {{ $item->special_request }}</div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @if($order->special_request)
                                <div class="text-danger small mt-2 fw-bold"><i class="fa-solid fa-pen-to-square"></i> Note : {{ $order->special_request }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($order->delivery_type == 'delivery')
                                <span class="badge bg-info"><i class="fa-solid fa-motorcycle me-1"></i> Livraison</span>
                                <div class="small text-muted mt-1">{{ $order->delivery_address }}</div>
                            @else
                                <span class="badge bg-secondary"><i class="fa-solid fa-bag-shopping me-1"></i> Sur place/Emporter</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="small fw-bold">{{ $order->total_price }} FCFA</div>
                            
                            <div class="mt-2">
                                @if($order->payment_method == 'cash')
                                    <span class="badge bg-primary w-100 mb-1"><i class="fa-solid fa-wallet"></i> Cash</span>
                                @elseif($order->payment_method == 'mobile')
                                    <span class="badge bg-warning text-dark w-100 mb-1"><i class="fa-solid fa-mobile-screen-button"></i> Mobile</span>
                                @endif
                                
                                @if($order->needs_cutlery)
                                    <span class="badge bg-success w-100"><i class="fa-solid fa-utensils"></i> Couverts</span>
                                @else
                                    <span class="badge bg-light text-dark border w-100"><i class="fa-solid fa-xmark"></i> Sans couverts</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                                @php
                                    $statusColors = [
                                        'received' => 'bg-secondary',
                                        'confirmed' => 'bg-primary',
                                        'prep' => 'bg-warning text-dark',
                                        'delivery' => 'bg-info',
                                        'finished' => 'bg-success',
                                        'cancelled' => 'bg-danger'
                                    ];
                                    $statusColor = $statusColors[$order->status] ?? 'bg-secondary';
                                    $statusLabels = [
                                        'received' => 'Nouvelle',
                                        'confirmed' => 'Confirmée',
                                        'prep' => 'En préparation',
                                        'delivery' => 'En livraison/Prête',
                                        'finished' => 'Terminée',
                                        'cancelled' => 'Annulée'
                                    ];
                                    $statusLabel = $statusLabels[$order->status] ?? strtoupper($order->status);
                                @endphp
                                <span class="badge {{ $statusColor }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                @if($order->status == 'received')
                                    <div class="d-flex gap-2 justify-content-end">
                                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-check me-1"></i> Accepter</button>
                                        </form>
                                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark me-1"></i> Refuser</button>
                                        </form>
                                    </div>
                                @elseif($order->status == 'cancelled')
                                    <span class="text-danger fw-bold"><i class="fa-solid fa-ban"></i> Commande refusée</span>
                                @else
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-flex flex-column gap-2 align-items-end">
                                        @csrf
                                        <div class="d-flex align-items-center gap-2">
                                            <select name="status" class="form-select form-select-sm status-select" style="width: auto;">
                                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                                <option value="prep" {{ $order->status == 'prep' ? 'selected' : '' }}>Préparation</option>
                                                @if($order->delivery_type == 'delivery')
                                                    <option value="delivery" {{ $order->status == 'delivery' ? 'selected' : '' }}>Livraison</option>
                                                @endif
                                                <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Terminée</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-check"></i></button>
                                        </div>
                                        @if($order->delivery_type == 'delivery' && $order->status != 'finished')
                                            <input type="text" name="delivery_driver" class="form-control form-control-sm driver-input mt-1" style="max-width: 200px;" placeholder="Nom du livreur" value="{{ $order->delivery_driver }}">
                                        @endif
                                    </form>
                                @endif
                            </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Aucune commande trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
