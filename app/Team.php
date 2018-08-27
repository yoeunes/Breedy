<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    protected $fillable = [
        'name',
        'slug',
        'street1',
        'street2',
        'city',
        'state',
        'zip',
        'country',
        'companyName',
        'companyNumber',
        'vat',
        'bankAccount',
        'bicSwift',
        'addInfos'
    ];
    
    /*
     * Get the list of animals for current team
     */
    public function animals()
    {
        return $this->hasMany('App\Animal');
    }
    
    public function types()
    {
        return $this->hasMany('Type');
    }
    
    public function races()
    {
        return $this->hasMany('Race');
    }
    
    public function contacts()
    {
        return $this->hasMany('Contact');
    }
    
    public function customers()
    {
        return $this->hasMany('Customer');
    }
    
    public function reservations()
    {
        return $this->belongsTo('Reservation');
    }
}
