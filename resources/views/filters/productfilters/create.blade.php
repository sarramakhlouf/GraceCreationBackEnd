@extends('layouts.main')

@section('title', 'Ajouter une relation')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter une relation</h4><br>
            <form class="forms-sample" method="POST" action="{{ route('productfilters.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="productSelect">Produit</label>
                <select class="form-control" id="productSelect" name="product_id" required>
                  <option value="" disabled selected>Choisissez un produit</option>
                  @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                      {{ $product->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label for="filterSelect">Filtre</label>
                <select class="form-control" id="filterSelect" name="filter_id" required>
                  <option value="" disabled selected>Choisissez un filtre</option>
                  @foreach ($filters as $filter)
                    <option value="{{ $filter->id }}" {{ old('filter_id') == $filter->id ? 'selected' : '' }}>
                      {{ $filter->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <button type="submit" class="btn btn-gradient-primary me-2">Ajouter</button>
              <button type="reset" class="btn btn-light">Réinitialiser</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
  .main-panel{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-top: 50px;
    margin-top: 10px;
  }
</style>
@endsection
