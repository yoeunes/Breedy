<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsPreferencesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
           'language' => 'required'
        ]);
        
        $request->user()->forceFill([
           'language' => $request->language
        ])->save();
    }
}
