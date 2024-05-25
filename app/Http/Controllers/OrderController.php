<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:order-list|order-create|order-edit|order-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:order-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:order-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:order-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all() ;
        return view('orders.index',compact('orders')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request()->validate([
            'user_id'=>'required|numeric',
            'product_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'order_date'=>'required',
        ]);
        $orders = Order::create($request) ;
        $orders->save() ;

        return redirect()->route('orders.index') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }


    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        request()->validate([
            'user_id'=>'required|numeric',
            'product_id'=>'required|numeric',
            'quantity'=>'required|numeric',
            'order_date'=>'required',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'order updated successfully');
    }

   
    public function destroy(Order $order)
    {
        $order->delete(); 

        return redirect()->route('orders.index')
            ->with('success', 'Product deleted successfully');
    }
}