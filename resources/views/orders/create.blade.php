@extends('layouts.master')


@section('content')
    <div class="container mt-4">
        <h1>Create New Order By {{ $order->user }} </h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
                <label for="product_id">Product ID </label>
                <input type="number" class="form-control" id="product_id" name="product_id" required>
                <label for="quantity">User </label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>

            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> 

        </form>
    </div>
@endsection
