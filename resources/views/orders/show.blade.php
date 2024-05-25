@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Name Ctaegorie  : {{ $categorie->name }} | ID: {{ $categorie->id }} </h2>
                <h5>Created AT : {{ $categorie->created_at }} </h5>
            </div>
        </div>
    </div>
@endsection
