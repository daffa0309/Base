<?php

namespace App\Repositories;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Ramsey\Uuid\Uuid;

class LogRepository
{

    public function datatable(Request $request)
    {
        $model = Logs::orderBy('module', 'asc')->orderBy('created_at', 'desc');

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('username', function ($data) {
                return $data->username;
            })
            ->editColumn('activity', function ($data) {
                if ($data->activity == 'C') {
                    return '<span class="badge rounded-pill badge-primary">Create</span>';
                } elseif($data->activity == 'R'){
                    return '<span class="badge rounded-pill badge-primary">Read</span>';
                } elseif($data->activity == 'U'){
                    return '<span class="badge rounded-pill badge-primary">Update</span>';
                } elseif($data->activity == 'Li'){
                    return '<span class="badge rounded-pill badge-success">Login</span>';
                } else {
                    return '<span class="badge rounded-pill badge-warning">Change Password</span>';
                }
                return $data->activity;
            })
            ->editColumn('module', function ($data) {
                return $data->module;
            })
            ->editColumn('url', function ($data) {
                // return ucwords($data->role->name);
                return $data->url;
            })
            ->editColumn('from', function ($data) {
                if ($data->from == 'Website') {
                    return '<span class="badge rounded-pill badge-success">Website</span>';
                } else{
                    return '<span class="badge rounded-pill badge-primary">Mobile</span>';
                }
                return $data->activity;
            })
            ->editColumn('created_at', function ($data) {

                return $data->created_at->format('d F Y h:i:s A');
            })

            ->rawColumns(['action', 'activity', 'from', 'created_at'])
            ->make(true);
    }

    public function getData(String $id = null)
    {
        if ($id) {
            $data = Logs::whereId($id)->first();
            if (!$data) {
                return [404, 'Data tidak ditemukan!'];
            }

            return [200, [
                'username'       => $data->username,
                'activity'       => $data->activity,
                'module'         => $data->module,
                'url'            => $data->url,
            ]];
        }

        return Logs::orderBy('created_at', 'asc')->get();
    }
}
