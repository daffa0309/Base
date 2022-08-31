<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Roles;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenusController extends Controller
{
    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function datatable(Request $request)
    {
        return $this->repository->datatable($request);
    }

    public function index()
    {
        $roles = Roles::get();
        $datas = $this->repository->getData();

        return view('layouts.pages.menu.index', compact('datas', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validator('rules'));
        list($code, $data) = $this->repository->saveData($request);



        if ($code === 200) {
            Alert::success('Menu berhasil ditambahkan!');
            return redirect()->route('menu.index');
            // return response()->json($request);
        }
    }

    public function detail($id)
    {
        list($code,$data) = $this->repository->getData($id);
        return response()->json($data, $code);
    }

    public function edit($id)
    {
        $menu   = Menus::with('roles')->whereId($id)->firstOrFail();
        $parent = Menus::select('id', 'name')->get();
        $roles  = Roles::get();

        return view('layouts.pages.menu.edit', compact('menu', 'parent', 'roles'));
    }

    public function update(Request $request, $id)
    {
        list($code, $data) = $this->repository->saveData($request,$id);

        if ($code === 200) {
            Alert::success('Menu Berhasil disimpan!');
            return redirect()->route('menu.index');
        }
    }

    public function destroy($id)
    {
        list($code, $data) = $this->repository->deleteData($id);

        if ($code === 200) {
            Alert::success('Menu berhasil dihapus!');
            return redirect()->route('menu.index');
        }
    }

    public function getRoles(){
        $data = Menus::with('roles')->where('id', 1)->first();

        if ($data->roles->count()) {
            # code...
            foreach ($data->roles as $item) {
                # code...
                return $item->count();
            }
        }

        // return response()->json($data);
    }

}
