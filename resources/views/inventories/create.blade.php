@extends('layouts.main')

@section('title', 'Ajouter Inventaire')

@section('content')
<div class="container">
    <h1>Ajouter un Inventaire</h1>

    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="productSelect">Produit</label>
            <select class="form-control" id="productSelect" name="product_id" required>
                <option value="" disabled selected>Choisissez un produit</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="depotSelect">Dépôt</label>
            <select class="form-control" id="depotSelect" name="depot_id" required>
                <option value="" disabled selected>Choisissez un dépôt</option>
                @foreach ($depots as $depot)
                    <option value="{{ $depot->id }}" {{ old('depot_id') == $depot->id ? 'selected' : '' }}>
                        {{ $depot->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
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
