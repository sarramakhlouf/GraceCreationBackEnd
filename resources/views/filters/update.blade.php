@extends('layouts.main')

@section('title', 'Modifier un Filtre')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Modifier un Filtre</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('filters.update', $filter->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="form-group">
                <label for="filterName">Nom du Filtre</label>
                <input type="text" class="form-control" id="filterName" name="name" value="{{ old('name', $filter->name) }}" placeholder="Nom du filtre" required>
              </div>

              <div class="form-group">
                <label for="typeSelect">Type de Filtre</label>
                <select class="form-control" id="typeSelect" name="type_id" required>
                  @foreach ($typefilters as $type)
                    <option value="{{ $type->id }}" {{ $filter->type_id == $type->id ? 'selected' : '' }}>
                      {{ $type->type }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Ajouter une nouvelle Icône (si souhaitée)</label>
                <input type="file" name="icon" class="form-control">
                @if ($filter->icon)
                  <div class="mt-2">
                    <p>Icône actuelle :</p>
                    <img src="{{ asset('storage/'.$filter->icon) }}" alt="Icône actuelle" style="width: 50px; height: 50px;">
                  </div>
                @endif
              </div>
              <button type="submit" class="btn btn-gradient-primary me-2">Modifier</button>
              <a href="{{ route('filters.index') }}" class="btn btn-light">Annuler</a>
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
