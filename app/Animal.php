<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Animal extends Model
{
    
    protected $primaryKey = 'id';
    protected $table = 'animals';
    public $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'name_full',
        'name_domestic',
        'id_number',
        'id_number_2',
        'category',
        'date_of_birth',
        'date_of_death',
        'sex',
        'color',
        'picture',
        'breeder',
        'owner',
        'sterilized',
        'notes',
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'team_id',
        'type_id',
        'race_id',
        'reservation_id'
    );

    
    /*
     * SCOPE
     */
    
    public function scopeCurrentTeam($query)
    {
        return $query->where('team_id', Auth::user()->currentTeam->id);
    }
    
    /* RELATIONS */
    
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    
    public function race()
    {
        return $this->belongsTo('App\Race');
    }
    
    public function vaccines()
    {
        return $this->hasMany('Vaccine');
    }
    
    public function visits()
    {
        return $this->hasMany('Visits');
    }
    
    public function conditions()
    {
        return $this->hasMany('Condition');
    }
    
    public function shows()
    {
        return $this->hasMany('Show');
    }
    
    public function reservation()
    {
        return $this->belongsTo('Reservation');
    }
    
    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'foster_home_id');
    }
    
    public function father()
    {
        return $this->belongsTo(Animal::class, 'father_id');
    }
    
    public function mother()
    {
        return $this->belongsTo(Animal::class, 'mother_id');
    }
    
}
