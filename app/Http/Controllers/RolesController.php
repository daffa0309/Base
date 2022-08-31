<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use RealRashid\SweetAlert\Facades\Alert;


class RolesController extends Controller
{
    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $datas = $this->repository->getData();

        return view('layouts.pages.role.index', compact('datas'));
    }

    public function detail($id)
    {
        list($code,$data) = $this->repository->getData($id);
        return response()->json($data, $code);
    }

    public function store(Request $request)
    {
        # code...
        $this->validate($request, $this->repository->validator('rules'));
        list($code, $data) = $this->repository->saveData($request);

        if ($code === 200) {
            # code...
            Alert::success('Role berhasil ditambahkan!');
            return redirect()->route('role.index');
        }
    }

    public function update(Request $request, $id)
    {
        # code...
        list($code, $data) = $this->repository->saveData($request, $id);

        if ($code === 200) {
            Alert::success('Role berhasil ditambahkan!');
            return redirect()->route('role.index');
        }
    }

    public function destroy($id)
    {
        list($code, $data) = $this->repository->deleteData($id);

        if ($code == 200) {
            Alert::success('Role berhasil dihapus!');
            return redirect()->route('role.index');
        }
    }
}
