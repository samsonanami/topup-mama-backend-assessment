<?php


namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;
use App\Http\Resources\CharacterResource;
use App\Traits\ApiResponse;

/**
 * 
 * @group 2.Characters APIs
 * 
 */
class CharacterController extends Controller
{
    use ApiResponse;
    /**
     * 
     * List Characters
     * 
     * Display a listing of all the characters.
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Characters found!",
     *    "data": [
     *        {
     *            "name": "Jon Snow",
     *            "gender": "Male",
     *            "culture": "Northmen",
     *            "born": "In 283 AC",
     *            "died": "\"\"",
     *            "titles": "[\"Lord Commander of the Night's Watch\"]",
     *            "aliases": "[\"Lord Snow\", \"Ned Stark's Bastard\", \"The Snow of Winterfell\", \"The Crow-Come-Over\", \"The 998th Lord Commander of the Night's Watch\", \"The Bastard of Winterfell\", \"The Black Bastard of the Wall\", \"Lord Crow\"]",
     *            "father": "",
     *            "mother": null,
     *            "spouse": null,
     *            "allegiances": null,
     *            "books": null,
     *            "povBooks": null,
     *            "tvSeries": null,
     *            "playedBy": null
     *        }
     *    ]
     *}
     * 
     */
    public function index()
    {
        $characters = Character::all();
        return $this->successResponse(CharacterResource::collection($characters), 'Characters found!', 200);
    }
    /**
     * 
     * Show a character by ID
     * 
     * Display a single character by it's unique ID.
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Character found!",
     *    "data": [
     *        {
     *            "name": "Jon Snow",
     *            "gender": "Male",
     *            "culture": "Northmen",
     *            "born": "In 283 AC",
     *            "died": "\"\"",
     *            "titles": "[\"Lord Commander of the Night's Watch\"]",
     *            "aliases": "[\"Lord Snow\", \"Ned Stark's Bastard\", \"The Snow of Winterfell\", \"The Crow-Come-Over\", \"The 998th Lord Commander of the Night's Watch\", \"The Bastard of Winterfell\", \"The Black Bastard of the Wall\", \"Lord Crow\"]",
     *            "father": "",
     *            "mother": null,
     *            "spouse": null,
     *            "allegiances": null,
     *            "books": null,
     *            "povBooks": null,
     *            "tvSeries": null,
     *            "playedBy": null
     *        }
     *    ]
     *}
     * 
     */
    public function show($id)
    {
        $character = Character::find($id);
        return $this->successResponse(CharacterResource::collection($characters), 'Characters found!', 200);
    }
    /**
     * 
     * Update Character
     * 
     * This endpoint creates a character
     * 
     * @bodyParam name string required The name of the character. Example: Jon Snow
     * @bodyParam gender string The gender  of the character. Example: Male
     * @bodyParam culture string The culture of the character. Example: Northmen
     * @bodyParam born date The date of birth of the character. Example: In 283 AC
     * @bodyParam titles array The titles of the character. Example: ["Lord Commander of the Night's Watch"]
     * @bodyParam aliases array The aliases of the character. Example: ["Lord Snow", "Ned Stark's Bastard"]
     * @bodyParam father string The father of the character.
     * @bodyParam mother string The mother of the character.
     * @bodyParam spouse string The spouse of the character.
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Character updated!",
     *    "data": [
     *        {
     *            "name": "Jon Snow",
     *            "gender": "Male",
     *            "culture": "Northmen",
     *            "born": "In 283 AC",
     *            "died": "\"\"",
     *            "titles": "[\"Lord Commander of the Night's Watch\"]",
     *            "aliases": "[\"Lord Snow\", \"Ned Stark's Bastard\", \"The Snow of Winterfell\", \"The Crow-Come-Over\", \"The 998th Lord Commander of the Night's Watch\", \"The Bastard of Winterfell\", \"The Black Bastard of the Wall\", \"Lord Crow\"]",
     *            "father": "",
     *            "mother": null,
     *            "spouse": null,
     *            "allegiances": null,
     *            "books": null,
     *            "povBooks": null,
     *            "tvSeries": null,
     *            "playedBy": null
     *        }
     *    ]
     *}
     * 
     */
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
        return $this->successResponse(CharacterResource::collection($character), 'Character created!', 200);
    }
    /**
     * 
     * Update Character
     * 
     * This endpoint allows you to update a character
     * 
     * @queryParam ID integer required The unique identifies for the character. Example: 3
     * @bodyParam name string required The name of the character. Example: Jon Snow
     * @bodyParam gender string The gender  of the character. Example: Male
     * @bodyParam culture string The culture of the character. Example: Northmen
     * @bodyParam born date The date of birth of the character. Example: In 283 AC
     * @bodyParam titles array The titles of the character. Example: ["Lord Commander of the Night's Watch"]
     * @bodyParam aliases array The aliases of the character. Example: ["Lord Snow", "Ned Stark's Bastard"]
     * @bodyParam father string The father of the character.
     * @bodyParam mother string The mother of the character.
     * @bodyParam spouse string The spouse of the character.
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Character updated!",
     *    "data": [
     *        {
     *            "name": "Jon Snow",
     *            "gender": "Male",
     *            "culture": "Northmen",
     *            "born": "In 283 AC",
     *            "died": "\"\"",
     *            "titles": "[\"Lord Commander of the Night's Watch\"]",
     *            "aliases": "[\"Lord Snow\", \"Ned Stark's Bastard\", \"The Snow of Winterfell\", \"The Crow-Come-Over\", \"The 998th Lord Commander of the Night's Watch\", \"The Bastard of Winterfell\", \"The Black Bastard of the Wall\", \"Lord Crow\"]",
     *            "father": "",
     *            "mother": null,
     *            "spouse": null,
     *            "allegiances": null,
     *            "books": null,
     *            "povBooks": null,
     *            "tvSeries": null,
     *            "playedBy": null
     *        }
     *    ]
     *}
     * 
     */
    public function update(Request $request, $id)
    {
        $character = Character::find($id);
        $character->update($request->all());
        return $this->successResponse(CharacterResource::collection($character), 'Character updated!', 200);
    }
    /**
     * 
     * Delete Character
     * 
     * This endpoint allows you to delete a character
     * 
     * @queryParam ID integer required The unique identifies for the character. Example: 3
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Character deleted!",
     *    "data": [
     *        {
     *            "name": "Jon Snow",
     *            "gender": "Male",
     *            "culture": "Northmen",
     *            "born": "In 283 AC",
     *            "died": "\"\"",
     *            "titles": "[\"Lord Commander of the Night's Watch\"]",
     *            "aliases": "[\"Lord Snow\", \"Ned Stark's Bastard\", \"The Snow of Winterfell\", \"The Crow-Come-Over\", \"The 998th Lord Commander of the Night's Watch\", \"The Bastard of Winterfell\", \"The Black Bastard of the Wall\", \"Lord Crow\"]",
     *            "father": "",
     *            "mother": null,
     *            "spouse": null,
     *            "allegiances": null,
     *            "books": null,
     *            "povBooks": null,
     *            "tvSeries": null,
     *            "playedBy": null
     *        }
     *    ]
     *}
     * 
     */
    public function destroy($id)
    {
        $character = Character::find($id);
        $character->delete();
        return $this->successResponse(CharacterResource::collection($character), 'Character deleted!', 200);
    }
}
