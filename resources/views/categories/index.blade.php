@extends('layouts.main')

@section('title', 'Liste des catégories')

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
                    <h4 class="card-title">Liste des catégories</h4>
                    <p class="card-description"> Consultez et gérez vos catégories</p>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('categories.index') }}" class="d-flex mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une catégorie" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                    </form>

                    <!-- Bouton Ajouter -->
                    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Ajouter une catégorie</a>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($categories as $category) <!-- Correction ici: $gategory => $category -->
                          <tr>
                            <td>
                              @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                              @else
                                N/A
                              @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                              <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">Modifier</a>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="3" class="text-center">Aucune catégorie trouvée</td> <!-- Correction du colspan -->
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
@endsection
