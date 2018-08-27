<?php

namespace App;

use Illuminate\Http\Request;
use Laravel\Spark\CanJoinTeams;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    use CanJoinTeams;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'country',
        'name',
        'email',
        'language'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'two_factor_reset_code',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }
    
    
}