@extends('layouts.main')

@section('title', 'Modifier catégorie')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier une catégorie</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT') <!-- Indiquer une requête PUT pour la mise à jour -->

              <div class="form-group">
                <label for="exampleInputName1">Nom de catégorie</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ old('name', $category->name) }}" placeholder="Nom" required>
              </div>

              <div class="form-group">
                <label>Ajouter l'image de catégorie (si souhaitée)</label>
                <input type="file" name="image" class="form-control">
                <!-- Affichage de l'image actuelle s'il y en a une -->
                @if ($category->image)
                  <div class="mt-2">
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/'.$category->image) }}" alt="Image actuelle" style="width: 100px; height: 100px;">
                  </div>
                @endif
              </div>

              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('categories.index') }}" class="btn btn-light">Annuler</a>
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
