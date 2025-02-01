@extends('layouts.main')

@section('title', 'Modifier Inventaire')

@section('content')
<div class="container">
    <h1>Modifier l'Inventaire</h1>

    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_id">Produit</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="" disabled>Choisissez un produit</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $inventory->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="depot_id">Dépôt</label>
            <select class="form-control" id="depot_id" name="depot_id" required>
                <option value="" disabled>Choisissez un dépôt</option>
                @foreach ($depots as $depot)
                    <option value="{{ $depot->id }}" {{ old('depot_id', $inventory->depot_id) == $depot->id ? 'selected' : '' }}>
                        {{ $depot->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantité</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantite', $inventory->quantite) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<style>
  .main-panel{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
  }
</style>
@endsection
