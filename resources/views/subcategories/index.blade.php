@extends('layouts.main')

@section('title', 'Liste des sous-catégories')

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
                    <h4 class="card-title">Liste des sous-catégories</h4>
                    <p class="card-description"> Consultez et gérez vos sous-catégories</p>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('subcategories.index') }}" class="d-flex mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une sous-catégorie" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                    </form>

                    <!-- Bouton Ajouter -->
                    <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-3">Ajouter une sous-catégorie</a>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie parente</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($subCategories as $subCategory)
                          <tr>
                            <td>
                              @if ($subCategory->image)
                                <img src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                              @else
                                N/A
                              @endif
                            </td>
                            <td>{{ $subCategory->name }}</td>
                            <td>{{ $subCategory->category->name ?? 'N/A' }}</td> <!-- Affichage de la catégorie associée -->
                            <td>
                              <a href="{{ route('subcategories.edit', $subCategory) }}" class="btn btn-primary btn-sm">Modifier</a>
                              <form action="{{ route('subcategories.destroy', $subCategory) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?')">Supprimer</button>
                              </form>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="4" class="text-center">Aucune sous-catégorie trouvée</td>
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
    .page-body-wrapper{
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
    }
</style>
@endsection
