@extends('layouts.main')

@section('title', 'Les rolations produits/filtres')

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

                        <h4 class="card-title">Les rolations produits/filtres</h4>
                        <p class="card-description">Consultez et gérez vos rolations</p>

                        <!-- Formulaire de recherche -->
                        <form method="GET" action="{{ route('productfilters.index') }}" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher une rolation" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                        </form>

                        <!-- Bouton Ajouter -->
                        <a href="{{ route('productfilters.create') }}" class="btn btn-success mb-3">Ajouter une rolation</a>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Filtre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productfilters as $rolation)
                                        <tr>
                                            <td>{{ $rolation->product->name }}</td>
                                            <td>{{ $rolation->filter->name }}</td>
                                            <td>
                                                <form action="{{ route('productfilters.destroy', ['product_id' => $rolation->product_id, 'filter_id' => $rolation->filter_id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette relation ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune rolation trouvée</td>
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
