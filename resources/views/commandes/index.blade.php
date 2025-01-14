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
                                        <th>ID Produit</th>
                                        <th>Nom du Client</th>
                                        <th>Quantité</th>
                                        <th>Prix Total</th>
                                        <th>Date de Commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $order->product_id }}</td>
                                            <td>{{ $order->client_name }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->total_price }} €</td>
                                            <td>{{ $order->order_date->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Voir</a>
                                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?')">Supprimer</button>
                                                </form>
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

                        <!-- Pagination (si nécessaire) -->
                        {{ $orders->links() }}
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
