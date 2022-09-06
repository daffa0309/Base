<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ViewdashboardController extends Controller
{
    //
    public function viewdashboard($name)
    {
        $setting    =   Settings::firstOrFail();
        # code...
        if ($menu = Menus::where('name', $name)->whereHas('menuroles', function ($q) {
            $q->where('roles_id', Auth::user()->role_id);
        })->first()) {
            $thisurl = $menu->urlview;
        } elseif ($menu = Menus::where('name', $name)->whereHas('menuroles', function ($q) {
            $q->where('roles_id', Auth::user()->role_id);
        })->first()) {
            $thisurl = $menu->urlview;
        } else {
            return redirect('/')->with('warning', 'URL Not Found');
        }

        // $ticket = $this->getTicket();
        
        $ticket = $this->anotherTicket();
        return view('layouts.pages.viewdashboard', compact('thisurl', 'name', 'menu', 'ticket', 'setting'));
    }

    public function getTicket(){
        $setting    =   Settings::firstOrFail();
        $user       =   Auth::user()->name;
        $server     =   $setting->tableauserverexternal;
        $targetsite = null;

        //extract data from the post
        extract($_POST);

        // var_dump($targetsite);

        //set POST variables
        $url = $server.'/trusted';
        if($targetsite != "" && $targetsite != null)
        {
            $fields_string ='username='.$user.'&target_site='.$targetsite.'&submittable=Get Ticket';
        }
        else
        {
            $fields_string ='username='.$user.'&submittable=Get Ticket';
        }
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, $fields_string);

        
        //execute post
        $response = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $response;
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
