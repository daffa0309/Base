<?php

namespace App\Repositories;

use App\Models\Logs;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Roles;
use Ramsey\Uuid\Uuid;

class RoleRepository
{

    public function validator($type)
    {
        if ($type == 'rules') {
            return [
                'name'        => 'required|unique:roles,name|max:100',
            ];
        } elseif ($type == 'attributes') {
            return [
                'name'        => 'Name',
            ];
        }
    }

    public function getData(String $id = null)
    {
        if ($id) {
            $data = Roles::whereId($id)->first();
            if (!$data) {
                return[404, 'Data tidak ditemukan'];
            }

            return [200, [
                'name'  => $data->name
            ]];
        }

        return Roles::get();
    }

    public function saveData(Request $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $role = null ;
            if ($id) {
                $role = Roles::whereId($id)->firstOrFail();
                $role->update([
                    'name'  => $request->name
                ]);
                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'U',
                    'module'    => 'Role',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);
            } else {
                $role = Roles::create([
                    'name'  => $request->name
                ]);
                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'C',
                    'module'    => 'Role',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return[200, $role];
    }

    public function deleteData($id)
    {
        $role = null;
        DB::beginTransaction();
        try {
            $role = Roles::whereId($id)->firstOrFail();
            $role->delete();

            Logs::create([
                'uuid'      => Uuid::uuid4(),
                'username'  => Auth()->user()->name,
                'activity'  => 'D',
                'module'    => 'Role',
                'url'       => \Request::url(),
                'from'      => 'Website',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return [200, $role];
    }
}
