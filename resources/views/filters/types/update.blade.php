@extends('layouts.main')

@section('title', 'Modifier un type de filtre')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier un type de filtre</h4>
            <br>

            <!-- Formulaire de modification -->
            <form class="forms-sample" method="POST" action="{{ route('typefilter.update', $typefilter->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT') <!-- Méthode PUT pour la mise à jour -->

              <!-- Champ Type -->
              <div class="form-group">
                <label for="typeInput">Type de filtre</label>
                <input 
                  type="text" 
                  class="form-control @error('type') is-invalid @enderror" 
                  id="typeInput" 
                  name="type" 
                  value="{{ old('type', $typefilter->type) }}" 
                  placeholder="Entrez le type de filtre" 
                  required>
                
                <!-- Affichage des erreurs spécifiques au champ -->
                @error('type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <!-- Boutons d'action -->
              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('typefilter.index') }}" class="btn btn-light">Annuler</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Affichage des erreurs générales -->
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  </div>
</div>

<style>
  .main-panel {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
  }
</style>
@endsection
