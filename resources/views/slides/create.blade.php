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
@endsection
