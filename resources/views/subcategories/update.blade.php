@extends('layouts.main')

@section('title', 'Modifier une sous-catégorie')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier une sous-catégorie</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('subcategories.update', $subCategory->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT') <!-- Indiquer une requête PUT pour la mise à jour -->

              <div class="form-group">
                <label for="exampleInputName1">Nom de la sous-catégorie</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ old('name', $subCategory->name) }}" placeholder="Nom" required>
              </div>

              <div class="form-group">
                <label for="category">Catégorie associée</label>
                <select class="form-control" id="category" name="category_id" required>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Ajouter une nouvelle image (si souhaitée)</label>
                <input type="file" name="image" class="form-control">
                <!-- Affichage de l'image actuelle s'il y en a une -->
                @if ($subCategory->image)
                  <div class="mt-2">
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/'.$subCategory->image) }}" alt="Image actuelle" style="width: 100px; height: 100px;">
                  </div>
                @endif
              </div>

              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('subcategories.index') }}" class="btn btn-light">Annuler</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
