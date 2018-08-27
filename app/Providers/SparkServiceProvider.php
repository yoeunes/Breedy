<?php

namespace App\Providers;

use App\Contracts\CreateUser;
use App\Contracts\Register;
use Carbon\Carbon;
use Configuration\ParamsScriptVariables;
use Laravel\Cashier\Cashier as Cashier;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Spark;


class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor'   => 'Breedy',
        'product'  => 'Abonnement',
        'street'   => 'Rue des BG, 25',
        'location' => 'Verviers - 4800',
        'phone'    => '+32 478 12 48 99',
    ];
    
    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;
    
    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'matt@gmail.com'
    ];
    
    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = false;
    
    
    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        // Use new Register & CreateUser class for disable Team registration on register
        $this->app->bind('Laravel\Spark\Contracts\Interactions\Auth\Register', Register::class);
        $this->app->bind('Laravel\Spark\Contracts\Interactions\Auth\CreateUser', CreateUser::class);
        
        Cashier::useCurrency('eur', '€');
        Spark::collectEuropeanVat('BE');
        Spark::useStripe()->noCardUpFront()->teamTrialDays(30);
        Spark::chargeTeamsPerMember();
        
        Spark::freeTeamPlan(__('Free'))
             ->features([
                 __('Maximum 25 animals'),
                 __('1 member maximum')
             ]);
        
        Spark::teamPlan(__('Premium'), 'team-basic')
             ->price(6.99)
             ->features([
                 __('Unlimited animals'),
                 __('Multi-member management')
             ]);
        
        
        Spark::teamPlan(__('Premium'), 'team-basic-yearly')
             ->price(69.99)
             ->yearly()
             ->features([
                 __('Unlimited animals'),
                 __('Multi-member management')
             ]);
        
        
        Spark::validateUsersWith(function () {
            return [
                'firstname' => 'required|min:1',
                'lastname'  => 'required|min:1',
                'country'   => 'required|min:1',
                'email'     => 'required|email|max:255|unique:users',
                'password'  => 'required|confirmed|min:6',
                'terms'     => 'required|accepted',
                'language'  => 'required'
            ];
        });
        
        Spark::createUsersWith(function ($request) {
            $user = Spark::user();
            
            $data = $request->all();
            
            $user->forceFill([
                'firstname'                  => $data['firstname'],
                'lastname'                   => $data['lastname'],
                'name'                       => '',
                'country'                    => $data['country'],
                'email'                      => $data['email'],
                'language'                   => $data['language'],
                'password'                   => bcrypt($data['password']),
                'last_read_announcements_at' => Carbon::now(),
                'trial_ends_at'              => Carbon::now()->addDays(Spark::trialDays()),
            ])->save();
            
            return $user;
        });
        
        Spark::useRoles([
            'administrator' => 'Administrateur',
            'member'        => 'Membre',
        ]);
        
    }
}
