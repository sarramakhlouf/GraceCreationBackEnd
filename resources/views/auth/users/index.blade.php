@extends('layouts.main')

@section('title', 'Liste des utilisateurs')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Liste des utilisateurs</h3>
    </div>
    <form method="GET" action="{{ route('users.index') }}">
      <input type="text" name="search" placeholder="Rechercher un utilisateur" class="form-control">
      <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
    </form>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Utilisateurs</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Numéro de téléphone</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->first_name }}</td>
                      <td>{{ $user->last_name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone}}</td>
                      <td>
                        <a href="#" class="btn btn-sm btn-primary">Voir</a>
                        <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                      </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
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
