@extends('layouts.main')

@section('title', 'Liste des Clients')

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
                        
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h4 class="card-title">Liste des Clients</h4>
                        <p class="card-description"> Consultez vos clients enregistrés</p>

                        <!-- Formulaire de recherche -->
                        <form method="GET" action="{{ route('clients.index') }}" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un client (nom, email...)" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                        </form>

                        <!-- Table des Clients -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom du Client</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Téléphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->address }}</td>
                                            <td>{{ $client->phone }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Aucun client trouvé</td>
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
