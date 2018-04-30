<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Card' => 'App\Policies\CardPolicy',
        'App\Policy' => 'App\Policies\PromotionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define("view-shop", function($user, $shop){
            return $user->id === $shop->owner_id;
        });

        // gate for view the reward of by card
        Gate::define('view-reward', function ($user, $template_id) {

            $cards = \App\Card::where('user_id', '=', $user->id)->get();

            foreach ($cards as $card) {
                # code...
                if ($card->template_id == $template_id){
                    return true;
                }
            }
            return false;
        });

        // gate check not owner
        Gate::define('not-owner', function ($user) {
            //
            return $user->role === 'employees' || $user->role === 'customer';
        });

        // gate for employee only
        Gate::define('employee-only', function ($user) {
            //
            return $user->role === 'employee';
        });
    }
}
