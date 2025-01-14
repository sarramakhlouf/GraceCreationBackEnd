@extends('layouts.main')

@section('title', 'Ajouter un dépôt')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h4 class="card-title">Ajouter un dépôt</h4>
        <form method="POST" action="{{ route('depots.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nom du dépôt</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nom" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</div>
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
