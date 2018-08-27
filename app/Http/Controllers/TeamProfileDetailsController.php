<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamProfileDetailsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\Team                $team
   */
  public function update(Request $request, Team $team)
  {
    $this->validate($request, [
      'name'    => 'required|min:1|max:255',
      'street1' => 'required|min:1|max:255',
      'street2' => 'max:255',
      'city'    => 'required|min:1|max:255',
      'state' => 'max:255',
      'zip'     => 'required|min:1|max:255',
      'country' => 'required|min:1|max:255',
      'companyName' => 'max:255',
      'companyNumber' => 'max:255',
      'vat' => 'max:255',
      'bankAccount' => 'max:255',
      'bicSwift' => 'max:255',
      'addInfos' => 'max:2048',
    ]);
  
    abort_unless($request->user()->ownsTeam($team), 403);
    
    $team->forceFill([
      'name'          => $request->name,
      'street1'       => $request->street1,
      'street2'       => $request->street2,
      'city'          => $request->city,
      'state'         => $request->state,
      'zip'           => $request->zip,
      'country'       => $request->country,
      'companyName'   => $request->companyName,
      'companyNumber' => $request->companyNumber,
      'vat'           => $request->vat,
      'bankAccount'   => $request->bankAccount,
      'bicSwift'      => $request->bicSwift,
      'addInfos'      => $request->addInfos
    ])->save();
    
  }
  
}
