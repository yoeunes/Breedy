<?php

namespace App\Configuration;

use App\Animal;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

trait ParamsScriptVariables
{
    /**
     * Get the default javascript variables for Breedy
     */
    
    public static function scriptVariables()
    {
        return [
            'locale'          => App::getLocale(),
            'homeUrl'         => Url('/home'),
            'maxFreeAnimals'  => Config::get('breedy.maxFreeAnimals'),
            'numberOfAnimals' => self::numberOfAnimals(),
            'isOnTrial'       => self::isOnTrial(),
            'isSubscribed'    => self::isSubscribed(),
            'canUseFullApp'   => self::canUseFullApp()
        ];
    }
    
    
    /**
     * Get the total of animals for auth team
     *
     * @return number || null
     */
    public static function numberOfAnimals()
    {
        $currentTeam = Auth::check() ? Auth::user()->currentTeam() : null;
        
        if (isset($currentTeam)) {
            return Auth::check() ? Animal::currentTeam()->count() : null;
        }
    }
    
    /**
     * Check if user is on trial period
     *
     * @return  boolean
     */
    public static function isOnTrial()
    {
        $currentTeam = Auth::check() ? Auth::user()->currentTeam() : null;
        
        if (Auth::check() && isset($currentTeam)) {
            if (Auth::user()->currentTeam->subscribed()) {
                return false;
            }
            
            if ( ! Auth::user()->currentTeam->onGenericTrial()) {
                return false;
            }
            
            return now()->lessThan(Auth::user()->currentTeam->trial_ends_at);
        }
    }
    
    /**
     * Check if user is subscribed to a plan
     *
     * @return bool
     */
    public static function isSubscribed()
    {
        $currentTeam = Auth::check() ? Auth::user()->currentTeam() : null;
        
        if (isset( $currentTeam )) {
            return Auth::check() ? Auth::user()->currentTeam->subscribed() : null;
        }
    }
    
    /**
     * Check if user is subscribe or if user is on trial
     *
     * @return bool
     */
    public static function canUseFullApp()
    {
        $currentTeam = Auth::check() ? Auth::user()->currentTeam() : null;
        
        if (Auth::check() && isset( $currentTeam ) ) {
            if (Auth::user()->currentTeam->subscribed() || self::isOnTrial()) {
                return true;
            }
        }
        
        return false;
    }
    
    
}
