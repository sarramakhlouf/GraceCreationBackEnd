@extends('layouts.main')

@section('title', 'Liste des dépôts')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h4 class="card-title">Liste des dépôts</h4>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('depots.index') }}" class="d-flex mb-3">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un dépôt" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
        </form>

        <a href="{{ route('depots.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Ajouter un dépôt</a>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($depots as $depot)
                        <tr>
                            <td>{{ $depot->id }}</td>
                            <td>{{ $depot->name }}</td>
                            <td>
                                <a href="{{ route('depots.edit', $depot->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form action="{{ route('depots.destroy', $depot->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Aucun dépôt trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

    .btn-sm {
      padding: 4px 8px;
      font-size: 14px;
    }
</style>
@endsection
