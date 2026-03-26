<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Crud;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud = Crud::orderBy('id', 'DESC')->paginate(2);
        // dd($posts);
        return view('crud.index', compact('crud'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        Crud::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName ?? null,
        ]);
        return redirect()->route('crud.index')
            ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crud $crud)
    {
        return view('crud.show', compact('crud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crud $crud)
    {
        return view('crud.edit', compact('crud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $crud = Crud::findOrFail($id);

        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

       
        if ($request->hasFile('image')) {

            
            if ($crud->image && file_exists(public_path('images/' . $crud->image))) {
                unlink(public_path('images/' . $crud->image));
            }

           
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $crud->image = $imageName;
        }

        
        $crud->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $crud->image,
        ]);

        return redirect()->route('crud.index')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crud $crud): RedirectResponse
    {
        $crud->delete();

        return redirect()->route('crud.index')
            ->with('success', 'Property deleted successfully');
    }
}
