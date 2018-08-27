<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileDetailsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Update the user's profile details.
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|min:1|max:255',
            'lastname'  => 'required|min:1|max:255',
            'email'     => 'required|email|max:255',
            'country'   => 'required'
        ]);
        
        $request->user()->forceFill([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'country'   => $request->country,
            'name'      => $request->firstname . ' ' . $request->lastname
        ])->save();
    }
}
