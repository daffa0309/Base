<?php

namespace App\Repositories;

use App\Models\Logs;
use App\Models\MenuRoles;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;


class MenuRepository
{
    public function validator($type)
    {
        if ($type == 'rules') {
            return [
                'name'        => 'required|max:100',
                'parent_id'   => 'required',
                // 'value'       => 'required',
                'url'         => 'required|max:100',
                'role'        => 'required',
                'urlview'     => 'required|max:100',
                'no'          => 'required',
                // 'site_id'     => '',
                'hide'        => 'required',
                'icon'        => 'max:100',
            ];
        } elseif ($type == 'attributes') {
            return [
                'name'        => 'Name',
                'parent_id'   => 'Parent Menu',
                // 'value'       => 'Value',
                'url'         => 'Url Website',
                'role'        => 'Role',
                'urlview'     => 'Url Tableau',
                'no'          => 'Number',
                'site_id'     => 'Site',
                'hide'        => 'Hide',
                'icon'        => 'Icon',
            ];
        }
    }

    public function datatable(Request $request)
    {
        $model = Menus::with('menuroles', 'childs')->orderBy('parent_id', 'asc');

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('ref', function ($data) {
                return $data->ref;
            })
            ->editColumn('url', function ($data) {
                return $data->url;
            })
            ->editColumn('urlview', function ($data) {
                return Str::limit($data->urlview, 50, '...');
            })
            ->editColumn('parent_id', function ($data) {
                return $data->parent_id;
            })
            ->editColumn('icon', function ($data) {
                return $data->icon;
            })
            ->addColumn('action', function ($data) {
                $result = '<div class="text-center">';
                $result .= action_button(route('menu.detail', $data->id),'Detail', ['primary'], ['detail']);
                $result .= href_button(route('menu.edit', $data->id),'Edit', ['warning']);
                $result .= action_form(route('menu.destroy', $data->id),'DELETE',['danger'],'Delete');
                $result .= '</div>';
                return $result;
            })

            ->rawColumns(['action', 'status', 'urlview'])
            ->make(true);
    }

    public function getData(String $id = null)
    {
        if ($id) {
            $data = Menus::with('roles')->whereId($id)->first();
            if (!$data) {
                return [404, 'Data tidak ditemukan!'];
            }
            return [200, [
                'parent_id'     => $data->parent_id,
                'site_id'       => $data->site_id,
                'value'         => $data->value,
                'name'          => $data->name,
                'ref'           => $data->ref,
                'url'           => $data->url,
                'urlview'       => $data->urlview,
                'no'            => $data->no,
                'hide'          => $data->hide,
                'icon'          => $data->icon,
                'role_name'     => $data->roles,
            ]];
        }

        return Menus::with('roles')->orderBy('parent_id', 'ASC')->get();
    }

    public function saveData(Request $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $menu = null;
            if ($id) {
                # code...
                $menu = Menus::with('roles')->whereId($id)->firstOrFail();
                $menu->update([
                    'parent_id'     => $request->parent_id,
                    'site_id'       => $request->site_id,
                    'value'         => $request->value,
                    'name'          => $request->name,
                    'ref'           => $request->ref,
                    'url'           => $request->url,
                    'urlview'       => $request->urlview,
                    'no'            => $request->no,
                    'hide'          => $request->hide,
                    'icon'          => $request->icon,
                ]);

                $menu->roles->menus_id = $menu->id;
                $menu->roles->roles_id = $menu->roles()->sync($request->role);

                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'U',
                    'module'    => 'Menu',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);

            } else {
                $menu = Menus::create([
                    'parent_id'     => $request->parent_id ,
                    'site_id'       => 0,
                    'value'         => $request->value,
                    'name'          => $request->name,
                    'ref'           => $request->ref,
                    'url'           => $request->url,
                    'urlview'       => $request->urlview,
                    'no'            => $request->no,
                    'hide'          => $request->hide,
                    'icon'          => $request->icon,
                ]);

                foreach ($request->role as $roles) {
                    MenuRoles::create([
                        'menus_id'  => $menu->id,
                        'roles_id'  => $roles
                    ]);
                }
                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'C',
                    'module'    => 'Menu',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return [200, $menu];
    }

    public function deleteData($id)
    {
        $menu = null;
        DB::beginTransaction();
        try {
            $menu = Menus::whereId($id)->firstOrFail();
            $menu->delete();

            Logs::create([
                'uuid'      => Uuid::uuid4(),
                'username'  => Auth()->user()->name,
                'activity'  => 'D',
                'module'    => 'Menu',
                'url'       => \Request::url(),
                'from'      => 'Website',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return [200, $menu];
    }
}
