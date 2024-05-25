<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index','home','show']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home(){
        $products = Product::orderBy('id')->Paginate(10);
        return view('products.index', compact('products'));
    } 

    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all() ;
        return view('products.create',compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description'  => 'required|string' ,
            'image_url'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' ,
            'categorie_id'  => 'required|numeric' 
        ]);

        $path = $request->file('image_url')->store('public/images');

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->categorie_id = $request->input('categorie_id');
        $product->image_url = Storage::url($path);

        $product->save();
        
        // Fire the event
        event(new ProductCreated($product));

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $categories = Categorie::all() ;
        return view('products.edit', compact('product','categories'));
    }

   

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'price' => 'required|numeric',
            'description'  => 'required|string' ,
            'image_url'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' ,
            'categorie_id'  => 'required|numeric' 
        ]);

        // Remove _token from the data
        $dataWithoutToken = collect($request->all())->except('_token','_method')->toArray();


        $image = $request->file('image_url')->store('public/images') ;
        $dataWithoutToken['image_url']=$image ; 

        $product->update($dataWithoutToken);
        

        // Now you can save the Product
        $product->save();


        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        // Delete the product image from storage
        if ($product->image_url) {
            $imagePath = str_replace('/storage', 'public', $product->image_url);
            Storage::delete($imagePath);
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}