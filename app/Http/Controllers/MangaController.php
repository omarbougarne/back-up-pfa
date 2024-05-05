<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangas = Manga::all();
        return view('mangas.index', compact('mangas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mangas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        // Create a new manga instance
        $manga = new Manga();
        $manga->name = $request->input('name');
        // Set other fields as needed
        $manga->save();

        // Redirect to the index page with a success message
        return redirect()->route('mangas.index')->with('success', 'Manga created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mangas = Manga::findOrFail($id);
        return view('mangas.show', compact('mangas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $manga = Manga::findOrFail($id); // Change variable name to $manga
    return view('mangas.edit', compact('manga')); // Pass $manga to the view
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        // Find the manga by ID
        $manga = Manga::findOrFail($id);

        // Update the manga with the new data
        $manga->name = $request->input('name');
        // Update other fields as needed
        $manga->save();

        // Redirect to the index page with a success message
        return redirect()->route('mangas.index')->with('success', 'Manga updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the manga by ID and delete it
        $manga = Manga::findOrFail($id);
        $manga->delete();

        // Redirect to the index page with a success message
        return redirect()->route('mangas.index')->with('success', 'Manga deleted successfully.');
    }
}
