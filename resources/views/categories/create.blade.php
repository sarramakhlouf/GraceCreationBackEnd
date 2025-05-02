@extends('layouts.main')

@section('title', 'Ajouter catégorie')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter une catégorie</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="exampleInputName1">Nom de la catégorie</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Nom de la catégorie" value="{{ old('name') }}" required>
              </div>
              <div class="form-group">
                  <label>Ajouter l'image de la catégorie</label>
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
