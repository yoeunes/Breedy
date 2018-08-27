<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    protected $table = 'types';
    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'team_id'];
    
    /*
     * Relations
     */
    public function animals()
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
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
}
