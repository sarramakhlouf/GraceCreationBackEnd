@extends('layouts.main')

@section('title', 'Modifier produit')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier un produit</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('produits.update', $product->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT') <!-- Indique une requête PUT pour la mise à jour -->

              <div class="form-group">
                <label for="exampleInputName1">Nom de produit</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ old('name', $product->name) }}" placeholder="Nom" required>
              </div>

              <div class="form-group">
                <label for="exampleTextarea1">Description du produit</label>
                <textarea class="form-control" id="exampleTextarea1" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
              </div>

              <div class="form-group">
                <label for="exampleInputPrice">Prix</label>
                <input type="number" step="0.01" class="form-control" id="exampleInputPrice" name="price" value="{{ old('price', $product->price) }}" placeholder="Prix" required>
              </div>

              <div class="form-group">
                <label for="exampleSelectAvailable">Disponible</label>
                <select class="form-select" id="exampleSelectAvailable" name="available" required>
                  <option value="1" {{ $product->available ? 'selected' : '' }}>Oui</option>
                  <option value="0" {{ !$product->available ? 'selected' : '' }}>Non</option>
                </select>
              </div>

              <div class="form-group">
                <label>Ajouter l'image de produit (si souhaitée)</label>
                <input type="file" name="image" class="form-control">
                <!-- Affichage de l'image actuelle s'il y en a une -->
                @if ($product->image)
                  <div class="mt-2">
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Image actuelle" style="width: 100px; height: 100px;">
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label for="exampleInputCategory">Sous-catégorie</label>
                <input type="number" class="form-control" id="exampleInputCategory" name="subcategory_id" value="{{ old('subcategory_id', $product->subcategory_id) }}" placeholder="ID de la sous-catégorie" required>
              </div>

              <div class="form-group">
                <label for="promotion">Promotion</label>
                <select class="form-select" id="promotion" name="promotion" required>
                  <option value="0" {{ $product->promotion == 0 ? 'selected' : '' }}>Non</option>
                  <option value="1" {{ $product->promotion == 1 ? 'selected' : '' }}>Oui</option>
                </select>
              </div>

              <div class="form-group">
                <label for="promo_price">Prix promotionnel</label>
                <input type="number" step="0.01" class="form-control" id="promo_price" name="promo_price" value="{{ old('promo_price', $product->promo_price) }}" placeholder="Prix promo" {{ $product->promotion == 0 ? 'disabled' : '' }}>
              </div>

              <div class="form-group">
                <label for="pack">Pack</label>
                <select class="form-select" id="pack" name="pack" required>
                  <option value="0" {{ $product->pack == 0 ? 'selected' : '' }}>Non</option>
                  <option value="1" {{ $product->pack == 1 ? 'selected' : '' }}>Oui</option>
                </select>
              </div>
              <div class="form-group" id="packIdField" style="{{ $product->pack == 0 ? 'display: block;' : 'display: none;' }}">
                  <label for="pack_id">Pack_id</label>
                  <input type="number" step="0.01" class="form-control" id="pack_id" name="pack_id" value="{{ old('pack_id', $product->pack_id) }}" placeholder="Pack_id" {{ $product->pack == 1 ? 'disabled' : '' }}>
              </div>
              <div class="form-group" id="packIdField" style="{{ $product->pack == 1 ? 'display: block;' : 'display: none;' }}">
                <label for="pack_products">Produits du pack</label>
                <select class="form-select" id="pack_products" name="pack_products[]" multiple {{ $product->pack == 0 ? 'disabled' : '' }}>
                  @foreach ($availableProducts as $availableProduct)
                    <option value="{{ $availableProduct->id }}" 
                      {{ in_array($availableProduct->name}}
                    </option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('produits.index') }}" class="btn btn-light">Annuler</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const promotionSelect = document.getElementById('promotion');
    const promoPriceInput = document.getElementById('promo_price');
    const packSelect = document.getElementById('pack');
    const packIdInput = document.getElementById('pack_id');

    if (promotionSelect && promoPriceInput) {
        promotionSelect.addEventListener('change', function () {
            if (this.value === '1') { 
                promoPriceInput.disabled = false;
            } else {
                promoPriceInput.disabled = true;
                promoPriceInput.value = ''; 
            }
        });
    }

    if (packSelect && packIdInput) {
    packSelect.addEventListener('change', function () {
        if (this.value === '0') {
            packIdInput.disabled = false; // Active le champ si packSelect est égal à 0
        } else {
            packIdInput.disabled = true; // Désactive le champ si packSelect n'est pas égal à 0
            packIdInput.value = ''; 
        }
    });
  }
});


</script>

@endsection
