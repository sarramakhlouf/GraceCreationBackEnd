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
<script>
  $(document).ready(function() {
    $('#produits_associes').select2({
        placeholder: "Choisissez un ou plusieurs produits associés",
        allowClear: true
    });
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const promotionSelect = document.getElementById('promotion');
        const promoPriceContainer = document.getElementById('promo_price_container');
        const promoPriceInput = document.getElementById('promo_price');

        function togglePromoPriceField() {
            if (promotionSelect.value === '1') {
                promoPriceContainer.style.display = 'block';
                promoPriceInput.removeAttribute('disabled');
            } else {
                promoPriceContainer.style.display = 'none';
                promoPriceInput.setAttribute('disabled', 'disabled');
                promoPriceInput.value = ''; // Clear the input if disabled
            }
        }

        // Attach event listener to toggle the field on change
        promotionSelect.addEventListener('change', togglePromoPriceField);

        // Initialize the field on page load
        togglePromoPriceField();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const packSelect = document.getElementById('pack');
        const produitsAssociesContainer = document.getElementById('produits_associes_container');

        function toggleProduitsAssociesField() {
            if (packSelect.value === '1') {
                produitsAssociesContainer.style.display = 'block';
            } else {
                produitsAssociesContainer.style.display = 'none';
            }
        }

        // Attach event listener to toggle the field on change
        packSelect.addEventListener('change', toggleProduitsAssociesField);

        // Initialize the field on page load
        toggleProduitsAssociesField();
    });
</script>
<script>
    // Initialisation de selectpicker
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });

    // Gestion des produits sélectionnés
    $('#add-to-pack').on('click', function() {
        const selectedProducts = $('#produits_associes').val(); // Récupération des IDs sélectionnés
        const productNames = $('#produits_associes option:selected').map(function() {
            return $(this).text();
        }).get(); // Récupération des noms sélectionnés

        $('#product-list').empty(); // Nettoyer la liste avant d'ajouter de nouveaux éléments
        selectedProducts.forEach((id, index) => {
            $('#product-list').append(`<li>${productNames[index]}</li>`);
        });

        // Mettre à jour l'input caché avec les IDs sélectionnés
        $('#hidden-pack-products').val(selectedProducts.join(','));
    });
</script>
<style>
    .inline-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .inline-list li {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        display: inline-block;
    }

    .btn-small {
        padding: 5px 10px;
        font-size: 0.9rem;
    }

    .remove-item {
        margin-left: 5px;
        color: red;
        cursor: pointer;
    }

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
