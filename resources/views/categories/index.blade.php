@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Categories
                    <div class="float-end">
                        @can('categorie-create')
                            <a class="btn btn-success" href="{{ route('categorie.create') }}"> Create New Categorie</a>
                        @endcan
                    </div>
                </h2>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $categorie)
            <tr>
                <td>{{ $categorie->id }}</td>
                <td>{{ $categorie->name }}</td>
                <td>
                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('categories.show', $categorie->id) }}">Show</a>
                       
                        @can('categorie-edit')
                            <a class="btn btn-primary" href="{{ route('categories.edit', $categorie->id) }}">Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        @can('categorie-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
