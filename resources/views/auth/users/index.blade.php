@extends('layouts.main')

@section('title', 'Liste des administrateurs')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Liste des administrateurs</h3>
    </div>
    <form method="GET" action="{{ route('users.index') }}">
      <input type="text" name="search" placeholder="Rechercher un utilisateur" class="form-control">
      <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
    </form>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Administrateurs</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nom & prénom</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
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
