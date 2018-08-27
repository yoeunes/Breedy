<?php

namespace App\Contracts;

use Laravel\Spark\Spark;
use Illuminate\Support\Facades\Validator;
use Laravel\Spark\Contracts\Repositories\UserRepository;
use Laravel\Spark\Contracts\Interactions\Auth\CreateUser as Contract;

class CreateUser implements Contract
{
  /**
   * {@inheritdoc}
   */
  public function validator($request)
  {
    $validator = $this->baseValidator($request);
    
    $validator->sometimes('team_slug', 'required|alpha_dash|max:255|unique:teams,slug', function ($input) {
      return Spark::usesTeams() &&
             Spark::onlyTeamPlans() &&
             Spark::teamsIdentifiedByPath() &&
             ! isset($input['invitation']);
    });
    
    return $validator;
  }
  
  /**
   * Create a base validator instance for creating a user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Validation\Validator
   */
  protected function baseValidator($request)
  {
    return Validator::make(
      $request->all(), Spark::call(static::class.'@rules', [$request]),
      [], ['address_line_2' => __('second address line')]
    );
  }
  
  /**
   * Get the basic validation rules for creating a new user.
   *
   * @param  \Laravel\Spark\Http\Requests\Auth\RegisterRequest  $request
   * @return array
   */
  public function rules($request)
  {
    return [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|confirmed|min:'.Spark::minimumPasswordLength(),
      'vat_id' => 'nullable|max:50|vat_id',
      'terms' => 'required|accepted',
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function handle($request)
  {
    return Spark::interact(UserRepository::class.'@create', [$request->all()]);
  }
}
