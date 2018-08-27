<?php

namespace App\Http\Controllers;

use App\Race;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaceController extends Controller
{
    
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*
     * Display a listing of the resource.
     */
    public function index(Team $team, Race $race)
    {
        return response(Race::where('team_id', Auth::user()->currentTeam->id)->orderBy('name_race', 'ASC')->get()->toJson());
    }
    
    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team, Race $race)
    {
        $this->validate($request, [
            'name_race' => 'required|min:2|max:255'
        ]);
        
        $race = new Race;
        $race->name_race = $request->name_race;
        $race->team_id = Auth::user()->currentTeam->id;
        $race->save();
    }
    
    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team, Race $race)
    {
        $this->validate($request, [
            'name_race' => 'required|min:2|max:255'
        ]);
        
        $race->name_race = $request->name_race;
        $race->save();
        
    }
    
    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, Race $race)
    {
        $race->delete();
    }
}
