<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Ramsey\Uuid\Uuid;

class UserRepository
{
    public function validator($type)
    {
        if ($type == 'rules') {
            return [
                'username'       => 'required|max:100',
                'name'           => 'required|max:100',
                'email'          => 'required|max:100|email',
                'role_id'        => 'required|integer',
                // 'value'          => 'required|max:45',
            ];
        } elseif ($type == 'attributes') {
            return [
                'username'       => 'Username',
                'name'           => 'Name',
                'email'          => 'Email',
                'role_id'        => 'Role',
                // 'value'          => 'Value',
            ];
        }
    }

    public function datatable(Request $request)
    {
        $model = Account::with('roles')->orderBy('role_id', 'asc');

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
            $data = Account::with('roles', 'values')->whereId($id)->first();
            if (!$data) {
                return [404, 'Data tidak ditemukan!'];
            }

            return [200, [
                'name'                 => $data->name,
                'email'                => $data->email,
                'username'             => $data->username,
                'foto'                 => $data->foto,
                'whatsapp'             => $data->whatsapp,
                'status'             => $data->status,

                'slack'                => $data->slack,
                'role_id'              => $data->role_id,
                'role_name'            => $data->roles,
                'value'                => $data->value,
                // 'value_name'           => $data->values->name,
            ]];
        }

        return Account::with('roles', 'values')->orderBy('role_id', 'asc')->get();
    }

    public function saveData(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $account = null;
            if ($id) {
                $account = Account::whereId($id)->firstOrFail();
                $account->update([
                    'name'                 => $request->name,
                    'email'                => $request->email,
                    'username'             => $request->username,
                    // 'foto'                 => $request->foto,
                    'whatsapp'             => $request->whatsapp,
                    'slack'                => $request->slack,
                    'role_id'              => $request->role_id,
                    'value'                => 0,
                ]);

                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'U',
                    'module'    => 'User',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);

            } else {
                $account = Account::create([
                    // 'id'                   => $request->id,
                    'name'                 => $request->name,
                    'email'                => $request->email,
                    'username'             => $request->username,
                    'password'             => Hash::make(123456),
                    // 'foto'                 => $request->foto,
                    'whatsapp'             => $request->whatsapp,
                    'slack'                => $request->slack,
                    'role_id'              => $request->role_id,
                    'status'               => 1,
                    'value'                => 0,
                ]);
                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'C',
                    'module'    => 'User',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return [200, $account];
    }

    public function deleteData($id)
    {
        $account = null;
        DB::beginTransaction();
        try {
            $account = Account::whereId($id)->firstOrFail();
            $account->delete();

            Logs::create([
                'uuid'      => Uuid::uuid4(),
                'username'  => Auth()->user()->name,
                'activity'  => 'D',
                'module'    => 'User',
                'url'       => \Request::url(),
                'from'      => 'Website',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return [200, $account];
    }
}
