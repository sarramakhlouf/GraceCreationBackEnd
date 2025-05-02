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

            <form method="GET" action="{{ route('produits.index') }}" class="d-flex mb-3">
              <input type="text" name="search" class="form-control" placeholder="Rechercher un produit" value="{{ request('search') }}">
              <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
            </form>

            <a href="{{ route('produits.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Ajouter un produit</a>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Promo</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                    <tr>
                      <td>
                        @if ($product->image)
                          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                          N/A
                        @endif
                      </td>
                      <td>{{ $product->name }}</td>
                      <td title="{{ $product->description }}">{{ Str::limit($product->description, 30) }}</td>
                      <td>{{ $product->price }} DT</td>
                      <td>{{ $product->promotion ? 'Oui ('.$product->promo_price.' DT)' : 'Non' }}</td>
                      <td>{{ $product->available ? 'Oui' : 'Non' }}</td>
                      <td>{{ $product->subcategory_id }}</td>
                      <td>
                        <a href="{{ route('produits.edit', $product) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <form action="{{ route('produits.destroy', $product) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center">Aucun produit trouvé</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
              {{ $products->links('pagination::default') }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
