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
                        <button type="submit" class="btn btn-primary ms-2"> Rechercher </button>
                    </form>

                    <!-- Bouton Ajouter -->
                    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Ajouter une catégorie
                    </a>

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
                          @forelse ($categories as $category)
                          <tr>
                            <td>
                              @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="table-img">
                              @else
                                N/A
                              @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                              <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> <!-- 📝 Icône Modifier -->
                              </a>

                              <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
                                  <i class="fas fa-trash"></i> <!-- 🗑️ Icône Supprimer -->
                                </button>
                              </form>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="3" class="text-center">Aucune catégorie trouvée</td>
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

<!-- Ajout du CDN FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
  .page-body-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
  }

  .table-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
  }

  .btn-sm {
      padding: 4px 8px;
      font-size: 14px;
  }
</style>

@endsection
