@extends('layouts.main')

@section('title', 'Ajouter un Slide')

@section('content')
<div class="container">
    <h2>Ajouter un Slide</h2>
    <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
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
