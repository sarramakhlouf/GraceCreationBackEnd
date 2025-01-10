@extends('layouts.main')

@section('title', 'Ajouter une sous-catégorie')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter une sous-catégorie</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('subcategories.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="exampleInputName1">Nom de la sous-catégorie</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Nom de la sous-catégorie" value="{{ old('name') }}" required>
              </div>

              <div class="form-group">
                  <label for="categorySelect">Catégorie parente</label>
                  <select class="form-control" id="categorySelect" name="category_id" required>
                      <option value="" disabled selected>Choisissez une catégorie</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                              {{ $category->name }}
                          </option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label>Ajouter l'image de la sous-catégorie</label>
                  <input type="file" name="image" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-gradient-primary me-2">Ajouter</button>
              <button type="reset" class="btn btn-light">Réinitialiser</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><br>
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
