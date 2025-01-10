@extends('layouts.main')

@section('title', 'Ajouter Inventaire')

@section('content')
<div class="container">
    <h1>Ajouter un Inventaire</h1>

    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="product_id">ID du Produit</label>
            <input type="number" class="form-control" id="product_id" name="product_id" required>
        </div>

        <div class="form-group">
            <label for="depot_id">ID du Dépôt</label>
            <input type="number" class="form-control" id="depot_id" name="depot_id" required>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
