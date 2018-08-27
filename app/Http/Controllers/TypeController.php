<?php

namespace App\Http\Controllers;

use App\Team;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return response(Type::where('team_id', Auth::user()->currentTeam->id)->orderBy('name', 'ASC')->get()->toJson());
    }
    
    /**
     * Store the data
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|min:2|max:255'
        ]);
        
        $type          = new Type;
        $type->name    = $request->name;
        $type->team_id = Auth::user()->currentTeam->id;
        $type->save();
    }
    
    /**
     * Update the given type
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Team                $team
     * @param \App\Type                $type
     */
    public function update(Request $request, Team $team, Type $type)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255'
        ]);
        
        $type->name = $request->name;
        $type->save();
    }
    
    public function destroy(Request $request, Team $team, Type $type)
    {
        $type->delete();
    }
    
    
}
