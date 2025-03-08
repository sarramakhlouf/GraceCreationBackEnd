@extends('layouts.main')

@section('title', 'Liste des Inventaires')

@section('content')
<div class="container">
    <h1>Liste des Inventaires</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('inventories.index') }}" class="mb-3">
        <input type="text" name="search" placeholder="Recherche par produit, dépôt ou quantité" class="form-control">
        <button type="submit" class="btn btn-primary"> Rechercher </button>
    </form>
    <a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Ajouter un Inventaire
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Dépôt</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->product ? $inventory->product->name : 'Product not found' }}</td>
                    <td>{{ $inventory->depot_id }}</td>
                    <td>{{ $inventory->quantite }}</td>
                    <td>
                        <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modifier </a>
                        <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .page-body-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
  }

    .btn-sm {
      padding: 4px 8px;
      font-size: 14px;
    }
</style>

@endsection
