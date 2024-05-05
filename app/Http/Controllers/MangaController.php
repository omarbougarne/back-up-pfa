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

        $request->validate([
            'name' => 'required|string|max:255',

        ]);


        $manga = new Manga();
        $manga->name = $request->input('name');

        $manga->save();


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
    $manga = Manga::findOrFail($id);
    return view('mangas.edit', compact('manga'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',

        ]);


        $manga = Manga::findOrFail($id);


        $manga->name = $request->input('name');

        $manga->save();


        return redirect()->route('mangas.index')->with('success', 'Manga updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $manga = Manga::findOrFail($id);
        $manga->delete();


        return redirect()->route('mangas.index')->with('success', 'Manga deleted successfully.');
    }
}
