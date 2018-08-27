<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Color;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalBreedingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $currentTeam = Auth::user()->currentTeam->id;

        $query = Animal::where('team_id', $currentTeam)->where('category', 'breeding');

        if ($request->has('race') && !empty($request->input('race'))) {
                $query->where('race_id', $request->race);
        }
  
        if ($request->has('color') && !empty($request->input('color'))) {
            $query->where('color_id', $request->color);
        }
  
        if ($request->has('type') && !empty($request->input('type'))) {
            $query->where('type_id', $request->type);
        }
      
        $data = $query->with('type', 'race', 'color')->orderBy('created_at', 'DESC')->paginate(20)->appends(request()->except('page'));
      
      return response()->json($data);
    }

    /**
     * Search a father for autocomplete select
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function searchFather(Request $request)
    {
        $currentTeam  = Auth::user()->currentTeam->id;
        $searchfather = $request->searchfather;
        
        $data = Animal::where('team_id', $currentTeam)
                      ->where('sex', 'male')
                      ->where(function ($query) use ($searchfather) {
                          $query->where('name_full', 'like', '%' . $searchfather . '%')
                                ->orWhere('id_number', 'like', '%' . $searchfather . '%')
                                ->orWhere('id_number_2', 'like', '%' . $searchfather . '%')
                                ->orWhere('name_domestic', 'like', '%' . $searchfather . '%');
                      })->get();
        
        return response()->json($data);
    }
    
    /**
     * Search a mother for autocomplete select
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function searchMother(Request $request)
    {
        $currentTeam  = Auth::user()->currentTeam->id;
        $searchmother = $request->searchmother;
        
        $data = Animal::where('team_id', $currentTeam)
                      ->where('sex', 'female')
                      ->where(function ($query) use ($searchmother) {
                          $query->where('name_full', 'like', '%' . $searchmother . '%')
                                ->orWhere('id_number', 'like', '%' . $searchmother . '%')
                                ->orWhere('id_number_2', 'like', '%' . $searchmother . '%')
                                ->orWhere('name_domestic', 'like', '%' . $searchmother . '%');
                      })->get();
        
        return response()->json($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Animal $animal)
    {
        $this->validate($request, [
            'id_number'     => 'required|min:1|max:255|unique:animals,id_number,null,id_number,team_id,' . Auth::user()->currentTeam->id,
            'id_number_2'   => 'nullable|min:1|max:255|unique:animals,id_number_2,null,id_number_2,team_id,' . Auth::user()->currentTeam->id,
            'name_full'     => 'required|min:2|max:255',
            'date_of_birth' => 'required|date',
            'type_id'       => 'required|integer',
            'race_id'       => 'required',
            'sex'           => 'required|min:2|max:255'
        ]);

        $animal = new Animal();
        
        $animal->id_number = $request->id_number;
        $animal->name_full = $request->name_full;
        $animal->name_domestic = $request->name_domestic;
        $animal->category = 'breeding';
        $animal->date_of_birth = $request->date_of_birth;
        $animal->sex = $request->sex;
        $animal->father_id = $request->father_id;
        $animal->mother_id = $request->mother_id;
        $animal->team_id = Auth::user()->currentTeam->id;
        $animal->type_id = $request->type_id;
        $animal->race_id = $request->race_id;
        $animal->color_id = $request->color_id;

          // Create new race directly if not exist
        if ( ! is_string($request->race_id)) {
            $animal->race_id = $request->race_id;
        } else {
            $newRace = Race::create([
                'name_race' => $request->race_id,
                'team_id'   => Auth::user()->currentTeam->id
            ]);
            
            $animal->race_id = $newRace->id;
        }
        
        // Create new color directly if not exist
        if ( ! is_string($request->color_id)) {
            $animal->color_id = $request->color_id;
        } else {
            $newColor = Color::create([
                'name_color' => $request->color_id,
                'team_id'    => Auth::user()->currentTeam->id
            ]);
            
            $animal->color_id = $newColor->id;
        }
        
        // Set default value (0) to Sterilized if not fill
        if ($animal->sterilized == '') {
            $animal->sterilized = 0;
        } else {
            $animal->sterilized = $request->sterilized;
        }
        
        $animal->save();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}