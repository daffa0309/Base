<?php

namespace App\Providers;

use App\Models\MenuRoles;
use App\Models\Menus;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.simple.sidebar', function ($view) {
            $menus = Menus::with('childs.childs.childs')->where('parent_id', 0)->orderBy('no', 'asc')->where('hide', 0)->whereHas('menuroles', function($q) {
                $q->where('roles_id', Auth::user()->role_id);
            })->get();
            $users = Auth::user();
            $menuRoles = MenuRoles::where('roles_id', Auth::user()->role_id)->get();

            return $view->with(compact('menus', 'menuRoles', 'users'));
        });
    }
}
