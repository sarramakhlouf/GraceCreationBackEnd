@extends('layouts.main')

@section('title', 'Modifier Inventaire')

@section('content')
<div class="container">
    <h1>Modifier l'Inventaire</h1>

    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_id">ID du Produit</label>
            <input type="number" class="form-control" id="product_id" name="product_id" value="{{ old('product_id', $inventory->product_id) }}" required>
        </div>

        <div class="form-group">
            <label for="depot_id">ID du Dépôt</label>
            <input type="number" class="form-control" id="depot_id" name="depot_id" value="{{ old('depot_id', $inventory->depot_id) }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantité</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('qquantite', $inventory->quantite) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
