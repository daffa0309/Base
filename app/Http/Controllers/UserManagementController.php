<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Roles;
use App\Models\Values;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use PDF;


class UserManagementController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function datatable(Request $request)
    {
        return $this->repository->datatable($request);
    }

    public function index()
    {
        $roles  = Roles::get();
        $datas  = $this->repository->getData();
        return view('layouts.pages.users.index', compact('datas', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->repository->validator('rules'));

        list($code, $data) = $this->repository->saveData($request);

        if ($code === 200) {
            Alert::success('User berhasil ditambahkan!');
            return redirect()->route('user.index');
        }
    }

    public function detail($id)
    {
        list($code, $data) = $this->repository->getData($id);
        return response()->json($data, $code);
    }

    public function update(Request $request, $id)
    {
        list($code, $data) = $this->repository->saveData($request, $id);

        if ($code === 200) {
            Alert::success('User berhasil disimpan!');
            return redirect()->route('user.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        list($code, $data) = $this->repository->deleteData($id);
        if ($code === 200) {
            Alert::success('User berhasil dihapus!');
            return redirect()->route('user.index');
        }
    }

    public function export(Request $request)
    {
        if ($request->filter != 0) {
            $users = Account::with('roles')->where('role_id', $request->filter)->get();
        } else {
            $users = Account::with('roles')->get();
        }

        // $users = Accounts::get();
        $pdf = PDF::loadView('layouts.pages.users.userexport', compact('users'))->setPaper('a4', '');
        Storage::put('public/pdf/User-Table-Visidata-' . Carbon::now()->toDateString() . '.pdf', $pdf->output());
        return  $pdf->download('User-Table-Visidata-' . Carbon::now()->toDateString() . '.pdf');
    }
}
