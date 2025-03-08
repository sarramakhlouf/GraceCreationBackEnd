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

                    <form method="GET" action="{{ route('subcategories.index') }}" class="d-flex mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une sous-catégorie" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2"> Rechercher </button>
                    </form>

                    <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Ajouter une sous-catégorie
                    </a>

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
                                <img src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }}" class="table-img">
                              @else
                                N/A
                              @endif
                            </td>
                            <td>{{ $subCategory->name }}</td>
                            <td>{{ $subCategory->category->name ?? 'N/A' }}</td> <
                            <td>
                              <a href="{{ route('subcategories.edit', $subCategory) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> 
                              </a>
                              <form action="{{ route('subcategories.destroy', $subCategory) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?')">
                                  <i class="fas fa-trash"></i>
                                </button>
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

    .table {
        font-size: 14px;
        table-layout: fixed;
        width: 100%;
    }

    .table th, .table td {
        padding: 8px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .table-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 5px;
    }

    .btn-sm {
        padding: 3px 6px;
        font-size: 12px;
    }
</style>

@endsection
