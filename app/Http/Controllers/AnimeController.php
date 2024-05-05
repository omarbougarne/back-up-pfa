<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\Studio;
use App\Models\Manga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{

    public function index(Request $request)
{
    $search = $request->query('search');

    if ($search) {
        $animes = Anime::where(DB::raw('LOWER(title)'), 'LIKE', '%' . strtolower($search) . '%')
            ->with('studio')
            ->get(); // Removing paginate
    } else {
        $animes = Anime::with('studio')->get(); // Removing paginate
    }

    // Fetching the latest anime added
    $latestAnime = Anime::latest()->first();

    return view('anime.index')->with([
        'animes' => $animes,
        'latestAnime' => $latestAnime, // passing the latest anime to the view
    ]);
}


// Import the User model if not already imported

public function userList(Request $request)
{
    $user = Auth::user(); // Retrieve the authenticated user
    $animes = $user->animes; // Retrieve animes associated with the authenticated user
    return view('anime.user_list')->with('animes', $animes)->with('user', $user);
}





// Inside your controller method
public function addToUserList(Request $request, $id)
{
    // Retrieve the authenticated user's ID
    $userId = Auth::id();

    $anime = Anime::find($id);
    if (!$anime) {
        return redirect(route('animes.index'))->with('error', 'Anime not found');
    }

    // Attach the anime to the authenticated user's list
    $user = Auth::user();
    $user->animes()->attach($anime, ['user_id' => $userId]);

    $userName = $user->name;

    return redirect(route('animes.user_list'))->with('success', $anime->title . ' added to ' . $userName . '\'s list');
}
public function removeFromUserList($id)
{
    $user = Auth::user();
    $anime = $user->animes()->find($id);

    if (!$anime) {
        return redirect(route('animes.user_list'))->with('error', 'Anime not found in your list');
    }

    $user->animes()->detach($anime);

    return redirect(route('animes.user_list'))->with('success', $anime->title . ' removed from your list');
}


public function showUserList($userId)
{
    // Retrieve the user's list of anime
    $user = User::findOrFail($userId); // Assuming you have a User model
    $animes = $user->animes()->with('studio')->get();

    // Pass the user and the list of anime to the view
    return view('anime.user_list', ['animes' => $animes, 'user' => $user]);
}





    public function searchInUserList(Request $request)
    {
        $search = $request->query('search');


        $animes = $request->animes()->where('title', 'LIKE', '%' . $search . '%')->withPivot('rating');


        return view('anime.user_list')->with('animes', $animes);
    }

public function removeFromList(Request $request, $id)
{
    $anime = Anime::find($id);

    if (!$anime) {
        return redirect(route('animes.index'))->with('error', 'Anime not found');
    }

    // Remove the anime from the database
    $anime->delete();

    return redirect(route('animes.index'))->with('success', $anime->title . ' has been removed');
}

public function create()
{
    $studios = StudioController::getStudios();
    $mangas = Manga::all(); // Fetch all mangas
    $categories = ['action', 'comedy', 'drama', 'adventure', 'fantasy', 'sci-fi', 'mystery', 'thriller', 'sports', 'supernatural', 'historical']; // Define categories

    return view('anime.create')->with('studios', $studios)->with('mangas', $mangas)->with('categories', $categories);
}


public function store(Request $request)
{
    try {
        $request->validate($this->getRules());

        $anime = new Anime();
        $anime->title = $request->input('title');
        $anime->synopsis = $request->input('synopsis');
        $anime->category = $request->input('category');

        if ($request->image) {
            $anime->image = $request->image->store('images', 'public');
        }

        // Attach manga_id to the anime
        $anime->manga_id = $request->input('manga_id');

        $anime->studio_id = $request->input('studio');

        // Add category


        $anime->save();

        return redirect(route('animes.index'));
    } catch (\Exception $e) {
        // Log or display the error message
        dd($e->getMessage());
    }
}


public function showUserRating($id)
{
    // Find the anime
    $anime = Anime::findOrFail($id);

    // Get the authenticated user's rating for the anime
    $userRating = auth()->user()->animes()->find($anime->id)->pivot->rating ?? null;

    // Pass the anime and user rating to the view
    return view('anime.show', compact('anime', 'userRating'));
}





public function addUserRating(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'rating' => 'required|numeric|min:1|max:10', // Adjust validation rules as needed
    ]);

    // Find the anime by its ID
    $anime = Anime::findOrFail($id);

    // Attach the user's rating to the anime using the pivot table
    auth()->user()->animes()->syncWithoutDetaching([$anime->id => [
        'rating' => $request->rating,
    ]]);

    return redirect()->back()->with('success', 'Rating added successfully');
}




public function editUserRating(Request $request, $id)
{
    auth()->user()->animes()->updateExistingPivot($id, ['rating' => $request->rating]);

    return redirect()->back()->with('success', 'Rating updated successfully');
}

public function deleteUserRating(Request $request, $id)
{
    auth()->user()->animes()->detach($id);

    return redirect()->back()->with('success', 'Rating deleted successfully');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    // Find the anime along with its status
    $anime = Anime::with(['episodes', 'comments'])->findOrFail($id);
    $comment = new Comment();
    // Get the authenticated user's rating and status for the anime
    $userAnime = auth()->user()->animes()->find($anime->id)->pivot ?? null;
    $userRating = $userAnime ? $userAnime->rating : null;
    $userStatus = $userAnime ? $userAnime->status : null;

    // Pass the anime, comment, user rating, and user status to the view
    if ($anime) {
        return view('anime.show', compact('anime', 'comment', 'userRating', 'userStatus'));
    } else {
        return abort(404);
    }
}


    public function updateStatus(Request $request, Anime $anime)
    {
        $validatedData = $request->validate([
            'status' => ['required', 'in:plan to watch,completed,dropped'],
        ]);

        $anime->update(['status' => $validatedData['status']]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }








    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anime = Anime::find($id);

        $studios = StudioController::getStudios();

        return view('anime.edit')->with('anime', $anime)->with('studios', $studios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getRules());

        $anime = Anime::find($id);

        $anime->title = $request->input('title');
        $anime->synopsis = $request->input('synopsis');

        if ($request->image) {
            if ($anime->image && Storage::exists($anime->image)) {
                Storage::delete($anime->image);
            }

            $anime->image = $request->image->store('images' , 'public');
        }


        $anime->studio_id = $request->input('studio');

        $anime->save();

        return redirect(route('animes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anime = Anime::find($id);

        Storage::delete($anime->image);
        $anime->delete();

        return redirect(route('animes.index'));
    }

    public function editComment($id)
    {
        $comment = Comment::find($id);



        $anime = $comment->anime;

        return view('anime.show', compact('anime', 'comment'));
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);



        $request->validate([
            'body' => 'required',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('animes.show', $comment->anime_id);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);



        $comment->delete();

        return back();
    }

    // public function updateWatched(Request $request, $id)
    // {
    //     // Validating the input
    //     // $request->validate([
    //     //     'watched' => 'required|integer|min:0|max:' . Anime::find($id)->episodes,
    //     // ]);

    //     // Find the entry in the pivot table for this anime and user
    //     $userAnime = $request->animes()->where('anime_id', $id)->first();

    //     // Update "watched" in the pivot table
    //     $userAnime->pivot->update(['watched' => $request->watched]);

    //     return redirect(route('animes.user_list'));
    // }

    public function storeComment(Request $request, $id)
{
    $request->validate([
        'body' => 'required',
    ]);

    $anime = Anime::findOrFail($id);

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = $request->user()->id; // Assign the user ID

    $anime->comments()->save($comment);

    return back();
}

    public function getRules()
    {
        $rules = [
            'title' => 'required|max:100',
            'synopsis' => 'required|max:3000',
            'image' => 'required|mimes:jpg,jpeg,png',
        ];
        return $rules;
    }

    public function getRulesMessages()
    {
        $msg = [
            'title.*' => '',
            'synopsis.*' => '',
            'image.*' => '',
            'score.*' => '',
        ];
        return $msg;
    }
}
