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
                                    <li>{{ $item->quantity }}x {{ $item->menuItem->name ?? 'Article inconnu' }}</li>
                                @endforeach
                            </ul>
                            @if($order->special_request)
                                <div class="text-danger small mt-1"><i class="fa-solid fa-triangle-exclamation"></i> {{ $order->special_request }}</div>
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
                        <td class="px-4 py-3 text-end fw-bold">{{ $order->total_price }} FCFA</td>
                        <td class="px-4 py-3 text-center">
                            @php
                                $statusColors = [
                                    'received' => 'bg-warning text-dark',
                                    'prep' => 'bg-primary',
                                    'delivery' => 'bg-info',
                                    'finished' => 'bg-success'
                                ];
                                $statusColor = $statusColors[$order->status] ?? 'bg-secondary';
                                $statusLabels = [
                                    'received' => 'Reçue',
                                    'prep' => 'En préparation',
                                    'delivery' => 'En livraison/Prête',
                                    'finished' => 'Terminée'
                                ];
                                $statusLabel = $statusLabels[$order->status] ?? strtoupper($order->status);
                            @endphp
                            <span class="badge {{ $statusColor }}">{{ $statusLabel }}</span>
                        </td>
                        <td class="px-4 py-3 text-end">
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-flex align-items-center justify-content-end">
                                @csrf
                                <select name="status" class="form-select form-select-sm me-2 w-auto" onchange="this.form.submit()">
                                    <option value="received" {{ $order->status == 'received' ? 'selected' : '' }}>Reçue</option>
                                    <option value="prep" {{ $order->status == 'prep' ? 'selected' : '' }}>Préparation</option>
                                    <option value="delivery" {{ $order->status == 'delivery' ? 'selected' : '' }}>Livraison</option>
                                    <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Terminée</option>
                                </select>
                            </form>
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
