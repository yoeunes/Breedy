<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    
    protected $table = 'colors';
    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_color', 'team_id'];
    
    public function animals()
    {
        return $this->hasMany('App\Animal');
    }
    
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    
    /*
     * Accessors
     */
    public function getNameColorAttribute($value)
    {
        return ucwords($value);
    }
    
}
