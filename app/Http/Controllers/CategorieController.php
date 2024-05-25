<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CatagorieController extends Controller 
{

    function __construct()
    {
        $this->middleware(['permission:categorie-list|categorie-create|categorie-edit|categorie-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:categorie-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:categorie-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:categorie-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Categorie::latest()->paginate(15);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $categorie = Categorie::create($request->all());
        $categorie->save();

        return redirect()->route('categories.index')
            ->with('success', 'Categories created successfully.');
    }


    public function show(Categorie $categorie)
    {
        return view('categories.show', compact('categorie'));
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }


    public function update(Request $request, Categorie $categorie)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $categorie->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categorie updated successfully');
    }


    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categorie deleted successfully');
    }
}
