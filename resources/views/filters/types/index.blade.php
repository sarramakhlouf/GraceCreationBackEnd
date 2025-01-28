@extends('layouts.main')

@section('title', 'Liste des types de filtres')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                    @endif

                    <h4 class="card-title">Liste des types de filtres</h4>
                    <p class="card-description"> Consultez et gérez vos types</p>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('typefilter.index') }}" class="d-flex mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher un type" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                    </form>

                    <!-- Bouton Ajouter -->
                    <a href="{{ route('typefilter.create') }}" class="btn btn-success mb-3">Ajouter un type</a>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($typefilters as $type)
                          <tr>
                            <td>{{ $type->type }}</td>
                            <td>
                              <!-- Bouton Modifier -->
                              <a href="{{ route('typefilter.edit', $type->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                              <!-- Bouton Supprimer -->
                              <form action="{{ route('typefilter.destroy', $type->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type ?')">Supprimer</button>
                              </form>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="2" class="text-center">Aucun type trouvé</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
  .page-body-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
  }
</style>
@endsection
