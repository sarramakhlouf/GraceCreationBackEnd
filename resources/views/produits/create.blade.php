@extends('layouts.main')

@section('title', 'Ajouter produit')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter un produit</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Nom de produit</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Nom" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Description du produit</label>
                    <textarea class="form-control" id="exampleTextarea1" name="description" rows="4" required>{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPrice">Prix</label>
                    <input type="number" step="0.01" class="form-control" id="exampleInputPrice" name="price" placeholder="Prix" value="{{ old('price') }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleSelectAvailable">Disponible</label>
                    <select class="form-select" id="exampleSelectAvailable" name="available" required>
                        <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="promotion">Promotion</label>
                    <select class="form-select" id="promotion" name="promotion" required>
                        <option value="0" {{ old('promotion') == '0' ? 'selected' : '' }}>Non</option>
                        <option value="1" {{ old('promotion') == '1' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                <div class="form-group" id="promo_price_container" style="display: {{ old('promotion') == '1' ? 'block' : 'none' }};">
                    <label for="promo_price">Prix promotionnel</label>
                    <input type="number" step="0.01" class="form-control" id="promo_price" name="promo_price" value="{{ old('promo_price') }}" placeholder="Prix promo" {{ old('promotion') == '0' ? 'disabled' : '' }}>      
                </div>
                <div class="form-group">
                    <label>Ajouter l'image de produit</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="SubcategorySelect">Sous-Catégorie</label>
                    <select class="form-control" id="SubcategorySelect" name="subcategory_id" required>
                        <option value="" disabled selected>Choisissez une sous-catégorie</option>
                        @foreach ($subcategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ old('subcategory_id') == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pack">Pack</label>
                    <select class="form-select" id="pack" name="pack" required>
                        <option value="0" {{ old('pack') == '0' ? 'selected' : '' }}>Non</option>
                        <option value="1" {{ old('pack') == '1' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                <div class="form-group" id="produits_associes_container" style="display: {{ old('pack') == '1' ? 'block' : 'none' }};">
                    <label for="produits_associes">Produits disponibles :</label>
                    <!-- Remplacement de 'select2' par 'selectpicker' -->
                    <select id="produits_associes" name="produits_associes[]" class="form-control selectpicker" multiple data-live-search="true">
                        @foreach($produitsSansPack as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="selected-products" id="pack-products" style="display: {{ old('pack') == '1' ? 'block' : 'none' }};">
                    <h3>Produits dans le Pack :</h3>
                    <ul id="product-list" class="inline-list" name="pack_products"></ul>
                </div>

            <!-- Champ caché pour transmettre les produits dans le pack -->
            <input type="hidden" name="produits_associes[]" id="hidden-pack-products">
              <button type="submit" class="btn btn-gradient-primary me-2">Ajouter</button>
              <button type="reset" class="btn btn-light">Re-remplir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<!-- Affichage des erreurs si elles existent -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
