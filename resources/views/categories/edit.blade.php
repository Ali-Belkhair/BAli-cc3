@extends('layouts.master')


@section('content')
    <div class="container mt-4">
        <h1>Create New Categorie</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $categorie = $categorie ) }}" method="POST">
            @csrf 
            @method('PUT')
            <div class="form-group">
                <label for="name">Categorie Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>  
            </div>

        </form>
    </div>
@endsection
