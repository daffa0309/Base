<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class TestingRepository
{

    public function datatable(Request $request)
    {
        $model = Account::with('roles');

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('username', function ($data) {
                return $data->username;
            })
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('email', function ($data) {
                return $data->email;
            })
            ->editColumn('role_id', function ($data) {
                if ($data->role_id == 1) {
                    return '<span class="badge rounded-pill badge-primary">Administrator</span>';
                } elseif($data->role_id == 2){
                    return '<span class="badge rounded-pill badge-success">Himatik</span>';
                }
                    return '<span class="badge rounded-pill badge-secondary">Kabupaten</span>';
                // return ucwords($data->role->name);
                return ucwords($data->roles->name);
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="badge rounded-pill badge-success">Active</span>';
                }
                    return '<span class="badge rounded-pill badge-danger">Deactive</span>';
            })
            ->addColumn('action', function ($data) {
                $result = '<div class="text-center">';
                $result .= action_button(route('user.detail', $data->id),'Detail', ['primary'], ['detail']);
                $result .= action_button(route('user.detail', $data->id),'Edit', ['warning'], ['edit']);
                $result .= action_form(route('user.destroy', $data->id),'DELETE',['danger'],'Delete');
                $result .= '</div>';

                return $result;
            })

            ->rawColumns(['action', 'status', 'role_id'])
            ->make(true);
    }

    public function getData(String $id = null)
    {
        if ($id) {
            $data = Account::with('roles')->whereId($id)->first();
            if (!$data) {
                return [404, 'Data tidak ditemukan!'];
            }

            return [200, [
                'name'                 => $data->name,
                'email'                => $data->email,
                'username'             => $data->username,
                'foto'                 => $data->foto,
                'whatsapp'             => $data->whatsapp,
                'slack'                => $data->slack,
                'role_id'              => $data->role_id,
                'role_name'            => $data->roles,
            ]];
        }

        return Account::with('roles')->orderBy('role_id', 'asc')->get();
    }
}
