@extends('layouts.main')

@section('title', 'Liste des Filtres')

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

                        <h4 class="card-title">Liste des Filtres</h4>
                        <p class="card-description">Consultez et gérez vos filtres</p>

                        <!-- Formulaire de recherche -->
                        <form method="GET" action="{{ route('filters.index') }}" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un filtre" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                        </form>

                        <!-- Bouton Ajouter -->
                        <a href="{{ route('filters.create') }}" class="btn btn-success mb-3">Ajouter un Filtre</a>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Icône</th>
                                        <th>Nom</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($filters as $filter)
                                        <tr>
                                            <td>
                                                @if ($filter->icon)
                                                    <img src="{{ asset('storage/' . $filter->icon) }}" alt="{{ $filter->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Aucune icône</span>
                                                @endif
                                            </td>
                                            <td>{{ $filter->name }}</td>
                                            <td>{{ $filter->type->type ?? 'Non défini' }}</td>
                                            <td>
                                                <a href="{{ route('filters.edit', $filter) }}" class="btn btn-primary btn-sm">Modifier</a>
                                                <form action="{{ route('filters.destroy', $filter) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce filtre ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun filtre trouvé</td>
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
