@extends('layouts.main')

@section('title', 'Ajouter un Filtre')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <h4 class="card-title">Ajouter un Filtre</h4><br>
              <form class="forms-sample" method="POST" action="{{ route('filters.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="filterName">Nom du Filtre</label>
                    <input type="text" class="form-control" id="filterName" name="name" placeholder="Nom du filtre" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="typeSelect">Type de Filtre</label>
                    <select class="form-control" id="typeSelect" name="type_id" required>
                        <option value="" disabled selected>Choisissez un type</option>
                        @foreach ($typefilters as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ajouter une Icône</label>
                    <input type="file" name="icon" class="form-control" required>
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
