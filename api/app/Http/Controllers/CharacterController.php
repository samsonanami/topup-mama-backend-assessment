<?php


namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;
use App\Http\Resources\CharacterResource;

/**
 * 
 * @group 2.Characters APIs
 * 
 */
class CharacterController extends Controller
{
    /**
     * 
     * List Characters
     * 
     * Display a listing of all the characters.
     *
     * 
     * 
     */
    public function index()
    {
        $characters = Character::all();
        return response()->json($characters);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'gender' => 'required|string',
            'culture' => 'required|string',
            'born' => 'required|string',
            'titles' => 'required|json',
            'aliases' => 'required|json',
            'father' => 'string',
            'mother' => 'string',
            'spouse' => 'string',
            'allegiances' => 'json',
            'books' => 'json',
            'playedBy' => 'json',
            'tvSeries' => 'json',
            'playedBy' => 'json',
            'father' => 'string',
        ]);
        $character = Character::create($request->all());
        return response()->json(new CharacterResource($character));
    }
    public function show($id)
    {
        $character = Character::find($id);
        return response()->json(new CharacterResource($character));
    }
    public function update(Request $request, $id)
    {
        $character = Character::find($id);
        $character->update($request->all());
        return response()->json(new CharacterResource($character));
    }
    public function destroy($id)
    {
        $character = Character::find($id);
        $character->delete();
        return response()->json('Item deleted successfully');
    }
}
