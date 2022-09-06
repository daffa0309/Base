<?php

namespace App\Http\Controllers;

use App\Models\Dashboardhome;
use App\Models\MenuRoles;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class DashboardController extends Controller
{
    //
    public function index(){
        $menus = Menus::with('childs.childs.childs')->orderBy('no', 'asc')->whereHas('menuroles', function($q) {
            $q->where('roles_id', Auth::user()->role_id);
        })->get();

        $setting    =   Settings::firstOrFail();

        // dd($menus->toArray());

        $menuroles = MenuRoles::where('roles_id', Auth::user()->role_id)->first();
        $ticket = $this->anotherTicket();

        $dashboardhomes = Dashboardhome::whereHas('roles', function($q) {
            $q->where('roles_id', Auth()->user()->role_id);
        })->get();

        return view('layouts.pages.index', compact('menus', 'menuroles', 'dashboardhomes','ticket', 'setting'));
    }
    public function anotherTicket()
    {
        $setting    =   Settings::firstOrFail();
        $user       =   Auth::user()->name;
        $server     =   $setting->tableauserverexternal;
        $targetsite = null;


        extract($_POST);
        $ch = curl_init();

        $certificate_location = asset('/storage/CA.PEM');
        if($targetsite != "" && $targetsite != null)
        {
            $fields_string ='username='.$user.'&target_site='.$targetsite.'&submittable=Get Ticket';
        }
        else
        {
            $fields_string ='username='.$user.'&submittable=Get Ticket';
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/trusted');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, $fields_string);
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;

    }
}
