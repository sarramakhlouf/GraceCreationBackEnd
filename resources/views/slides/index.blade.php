@extends('layouts.main')

@section('title', 'Liste des Slides')

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

                        <h4 class="card-title">Liste des Slides</h4>
                        <p class="card-description"> Consultez et gérez vos slides</p>

                        <!-- Formulaire de recherche -->
                        <form method="GET" action="{{ route('categories.index') }}" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher une catégorie" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ms-2"> Rechercher </button>
                        </form>

                        <!-- Bouton Ajouter -->
                        <a href="{{ route('slides.create') }}" class="btn btn-success mb-3">
                            <i class="fas fa-plus"></i> Ajouter un Slide
                        </a>

                        <!-- Table des Slides -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($slides as $slide)
                                        <tr>
                                            <td>
                                                @if ($slide->image)
                                                    <img src="{{ asset('storage/' . $slide->image) }}" alt="Slide" class="table-img">
                                                @else
                                                    <p>Aucune image</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> <!-- 📝 Icône Modifier -->
                                                </a>
                                                <form action="{{ route('slides.destroy', $slide->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce slide ?')">
                                                        <i class="fas fa-trash"></i> <!-- 🗑️ Icône Supprimer -->
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Aucun slide trouvé</td>
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
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 14px;
    }
</style>

@endsection
