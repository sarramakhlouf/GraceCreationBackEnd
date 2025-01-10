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
                  <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="nom" value="{{ old('name') }}" required>
              </div>
              <div class="form-group">
                  <label for="exampleTextarea1">Description du produit</label>
                  <textarea class="form-control" id="exampleTextarea1" name="description" rows="4" required>{{ old('description') }}</textarea>
              </div>
              <div class="form-group">
                  <label for="exampleInputPrice">Prix</label>
                  <input type="number" step="0.01" class="form-control" id="exampleInputPrice" name="price" placeholder="prix" value="{{ old('price') }}" required>
              </div>
              <div class="form-group">
                  <label for="exampleSelectAvailable">Disponible</label>
                  <select class="form-select" id="exampleSelectAvailable" name="available" required>
                      <option value="1">Oui</option>
                      <option value="0">Non</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectPromotion">Promotion</label>
                <select class="form-select" id="exampleSelectPromotion" name="promotion" onchange="togglePromoPriceField()" required>
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
              </div>
              <div class="form-group" id="promoPriceField" style="display: none;">
                <label for="exampleInputPromoPrice">Prix promotionnel</label>
                <input type="number" step="0.01" class="form-control" id="exampleInputPromoPrice" name="promo_price" placeholder="Prix promotionnel" value="{{ old('promo_price') }}">
              </div>
              <div class="form-group">
                  <label>Ajouter l'image de produit</label>
                  <input type="file" name="image" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputCategory">Sous-catégorie</label>
                  <input type="number" class="form-control" id="exampleInputCategory" name="subcategory_id" placeholder="ID de la sous-catégorie" value="{{ old('subcategory_id') }}" required>
              </div>
              <div class="form-group">
                <label for="exampleSelectPack">Pack</label>
                <select class="form-select" id="exampleSelectPack" name="pack" onchange="togglepackIdField()" required>
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
              </div>
              <div class="form-group" id="packIdField" style="display: none;">
                <label for="exampleInputpackId">Pack Id</label>
                <input type="number" step="0.01" class="form-control" id="exampleInputpackId" name="pack_id" placeholder="Pack Id" value="{{ old('pack_id') }}">
              </div>
              <button type="submit" class="btn btn-gradient-primary me-2">Ajouter</button>
              <button type="reset" class="btn btn-light">Re-remplir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <br>
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
  function togglePromoPriceField() {
    const packIdField = document.getElementById('promoPriceField');
    const promotionSelect = document.getElementById('exampleSelectPromotion');
    if (promotionSelect.value == '1') {
        promoField.style.display = 'block';
    } else {
        promoField.style.display = 'none';
    }
  }
  function togglepackIdField() {
    const packIdField = document.getElementById('packIdField');
    const packSelect = document.getElementById('exampleSelectPack');
    
    if (packSelect.value == '0') {
        packIdField.style.display = 'block'; // Affiche le champ si la valeur de pack est 0
    } else {
        packIdField.style.display = 'none'; // Cache le champ sinon
    }
  }

}
</script>
@endsection