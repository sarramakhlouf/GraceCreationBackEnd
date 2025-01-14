@extends('layouts.main')

@section('title', 'Modifier un dépôt')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h4 class="card-title">Modifier un dépôt</h4>
        <form method="POST" action="{{ route('depots.update', $depot->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom du dépôt</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $depot->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
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
