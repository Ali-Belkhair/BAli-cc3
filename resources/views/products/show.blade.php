@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Product {{ $product->name }}
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <img src="{{ $product->image_url }}" alt="Product Image" width="20%" >
                <h2>Name:{{ $product->name }} | Price {{ $product->price }}DH </h2>
                <h4> Description: {{ $product->description }} </h4>
            </div>
        </div>
    </div>
@endsection
