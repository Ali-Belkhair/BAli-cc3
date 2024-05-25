<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:contact-list|contact-create|contact-edit|contact-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:contact-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:contact-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:contact-delete'], ['only' => ['destroy']]);
    }
   

    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('contacts.index', compact('contacts'));
    }

    
    public function create()
    {
        return view('contacts.create');
    }

    
    public function store(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
        ]);

        $contacts = Contact::create($request->all());
        $contacts->save();

        return redirect()->route('contacts.index')
            ->with('success', 'contacts created successfully.');
    }

   
    public function show(Contact $contacts)
    {
        return view('contacts.show', compact('contacts'));
    }

   
    public function edit(Contact $contacts)
    {
        return view('contacts.edit', compact('contacts'));
    }


    public function update(Request $request, Contact $contacts)
    {
        request()->validate([
            'user_id' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
        ]);

        $contacts->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contacts updated successfully');
    }

    public function destroy(Contact $contacts)
    {
        $contacts->delete(); 

        return redirect()->route('contacts.index')
            ->with('success', 'Contacts deleted successfully');
    }
}