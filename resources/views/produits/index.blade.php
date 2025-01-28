@extends('layouts.main')

@section('title', 'Liste des produits')

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
                    <h4 class="card-title">Liste des Produits</h4>
                    <p class="card-description"> Consultez et gérez vos produits</p>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('produits.index') }}" class="d-flex mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher un produit" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
                    </form>

                    <!-- Bouton Ajouter -->
                    <a href="{{ route('produits.create') }}" class="btn btn-success mb-3">Ajouter un produit</a>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Promotion</th>
                            <th>Disponible</th>
                            <th>Sous-catégorie</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($products as $product)
                          <tr>
                            <td>
                              @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                              @else
                                N/A
                              @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} DT</td>
                            <td>
                              @if ($product->promotion)
                                  Oui (Promo : {{ $product->promo_price }} DT)
                              @else
                                  Non
                              @endif
                            </td>
                            <td>{{ $product->available ? 'Oui' : 'Non' }}</td>
                            <td>{{ $product->subcategory_id }}</td>
                            <td>
                              <a href="{{ route('produits.edit', $product) }}" class="btn btn-primary btn-sm">Modifier</a>
                              <form action="{{ route('produits.destroy', $product) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="confirmDelete(this)">Supprimer</button>
                              </form>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="7" class="text-center">Aucun produit trouvé</td>
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
  /* full-page.css */
  html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
  }

  .page-body-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding-top: 50px;
      margin-top: 10px;
  }

  .main-panel {
      flex-grow: 1;
      width: 100%;
  }

  .content-wrapper {
      padding: 20px; /* Ajustez les marges selon vos besoins */
      width: 100%;
  }

  .table-responsive {
      overflow-x: auto;
  }

</style>
@endsection
