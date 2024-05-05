<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index($anime_id)
{
    $anime = Anime::findOrFail($anime_id);
    $episodes = Episode::all();
    return view('episodes.index', compact('anime', 'episodes'));
}


public function create($anime_id)
{
    $anime = Anime::findOrFail($anime_id);
    return view('episodes.create', compact('anime'));
}


public function store(Request $request, $anime_id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'number' => 'required|integer',
        'air_date' => 'nullable|date',
        'summary' => 'nullable|string'
    ]);

    $episode = new Episode([
        'title' => $request->title,
        'number' => $request->number,
        'air_date' => $request->air_date,
        'summary' => $request->summary,
        'anime_id' => $anime_id
    ]);

    $episode->save();

    // Redirect to the episodes index for the specific anime
    return redirect()->route('episodes.index', $anime_id);
}


public function edit($id)
{
    $episode = Episode::findOrFail($id);
    return view('episodes.edit', compact('episode'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'number' => 'required|integer',
        'air_date' => 'nullable|date',
        'summary' => 'nullable|string'
    ]);

    $episode = Episode::findOrFail($id);
    $episode->update($request->all());

    return redirect()->route('episodes.index');
}
public function destroy($id)
{
    $episode = Episode::findOrFail($id);
    $episode->delete();

    return redirect()->route('episodes.index');
}
}
