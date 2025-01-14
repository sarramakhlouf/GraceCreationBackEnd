@extends('layouts.main')

@section('title', 'Modifier Slide')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier un Slide</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('slides.update', $slide->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT') <!-- Indiquer une requête PUT pour la mise à jour -->

              <div class="form-group">
                <label>Changer l'image du Slide</label>
                <input type="file" name="image" class="form-control">
                <!-- Affichage de l'image actuelle s'il y en a une -->
                @if ($slide->image)
                  <div class="mt-2">
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/' . $slide->image) }}" alt="Image actuelle" style="width: 100px; height: 100px; object-fit: cover;">
                  </div>
                @endif
              </div>

              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('slides.index') }}" class="btn btn-light">Annuler</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><br>

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
