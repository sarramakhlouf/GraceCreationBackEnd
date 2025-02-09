@extends('layouts.main')

@section('title', 'Liste des Commandes')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h4 class="card-title">Liste des Commandes</h4>
                        <p class="card-description"> Consultez et gérez vos commandes</p>

                        <!-- Formulaire de recherche -->
                        <form method="GET" action="{{ route('commandes.index') }}" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher une commande (nom client, produit...)" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                        </form>

                        <!-- Table des Commandes -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Commande</th>
                                        <th>Nom du Client</th>
                                        <th>Produit(s)</th>
                                        <th>Quantité</th>
                                        <th>Prix Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                            @foreach ($order->orderLines as $orderLine)
                                                <p>{{ $orderLine->product->name }}</p>
                                            @endforeach
                                            </td>
                                            <td>
                                            @foreach ($order->orderLines as $orderLine)
                                                <p>{{ $orderLine->quantity }}</p>
                                            @endforeach
                                            </td>
                                            <td>
                                            @php
                                                $total = 0;
                                                foreach ($order->orderLines as $orderLine) {
                                                $total += $orderLine->quantity * $orderLine->price;
                                                }
                                            @endphp
                                            {{ $total }} TND
                                            </td>
                                            <td>{{ $order->status == 0 ? 'En attente' : ($order->status == 1 ? 'Validée' : 'Annulée') }}</td>
                                            <td>
                                                @if($order->status == 0)
                                                    <form action="{{ route('commandes.validate', $order->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Valider</button>
                                                    </form>

                                                    <form action="{{ route('commandes.cancel', $order->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Annuler</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune commande trouvée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-body-wrapper{
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
    }
</style>
@endsection
