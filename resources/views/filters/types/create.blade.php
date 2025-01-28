@extends('layouts.main')

@section('title', 'Ajouter un type de filtre')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter un type de filtre</h4>
            <br>

            <!-- Formulaire d'ajout -->
            <form class="forms-sample" method="POST" action="{{ route('typefilter.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="typeInput">Type de filtre</label>
                  <input 
                      type="text" 
                      class="form-control @error('type') is-invalid @enderror" 
                      id="typeInput" 
                      name="type" 
                      placeholder="Entrez le type de filtre" 
                      value="{{ old('type') }}" 
                      required>
                  
                  <!-- Gestion des erreurs -->
                  @error('type')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <!-- Boutons d'action -->
              <button type="submit" class="btn btn-gradient-primary me-2">Ajouter</button>
              <button type="reset" class="btn btn-light">Réinitialiser</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Gestion des erreurs générales -->
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
