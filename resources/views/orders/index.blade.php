@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Orders
                    <div class="float-end">
                        @can('order-create')
                            <a class="btn btn-success" href="{{ route('orders.create') }}"> Add Order </a>
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
            <th>ID-User</th>
            <th>ID-Product</th>
            <th>Quantity</th>
            <th>Order Date </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->product_id }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->order_date }}</td>
                <td>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('orders.show', $order->id) }}">Show</a>
                       
                        @can('order-edit')
                            <a class="btn btn-primary" href="{{ route('orders.edit', $order->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('order-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
