<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    public function searchAnimalAdoption(Request $request)
    {

         $data = Animal::where('id', $id)
                    ->where('category', 'adoption')
                    ->count();
    
        return response()->json($data);
    }

   
}
