<?php

namespace App\Http\Controllers;

use App\Models\Dashboardhome;
use App\Models\MenuRoles;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $menus = Menus::with('childs.childs.childs')->orderBy('no', 'asc')->whereHas('menuroles', function($q) {
            $q->where('roles_id', Auth::user()->role_id);
        })->get();


        // dd($menus->toArray());

        $menuroles = MenuRoles::where('roles_id', Auth::user()->role_id)->first();

        $dashboardhomes = Dashboardhome::whereHas('roles', function($q) {
            $q->where('roles_id', Auth()->user()->role_id);
        })->get();

        return view('layouts.pages.index', compact('menus', 'menuroles', 'dashboardhomes'));
    }
}
