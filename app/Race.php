<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';
    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_race', 'team_id'];
    
    public function type()
    {
        return $this->hasMany('Animal');
    }
    
    public function team()
    {
        return $this->belongsTo('Team');
    }
    
    /*
     * Accessors
     */
    public function getNameRaceAttribute($value)
    {
        return ucwords($value);
    }
    
}
