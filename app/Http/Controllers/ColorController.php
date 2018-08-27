<?php

namespace App\Http\Controllers;

use App\Color;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
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
    public function index(Team $team, Color $color)
    {
        return response(Color::where('team_id', Auth::user()->currentTeam->id)->orderBy('name_color', 'ASC')->get()->toJson());
    }
    
    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team, Color $color)
    {
        $this->validate($request, [
            'name_color' => 'required|min:2|max:255'
        ]);
        
        $color = new Color;
        $color->name_color = $request->name_color;
        $color->team_id = Auth::user()->currentTeam->id;
        $color->save();
    }
    
    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team, Color $color)
    {
        $this->validate($request, [
            'name_color' => 'required|min:2|max:255'
        ]);
        
        $color->name_color = $request->name_color;
        $color->save();
        
    }
    
    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, Color $color)
    {
        $color->delete();
    }
}
