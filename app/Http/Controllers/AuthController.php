<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Account;
use App\Models\Accounts;

use App\Models\Logs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login()
    {

        return view('authentication.login');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:200',
            'password' => 'required|max:100',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            # code...
            DB::beginTransaction();
            try {
                Logs::create([
                    'uuid'      => Uuid::uuid4(),
                    'username'  => Auth()->user()->name,
                    'activity'  => 'Li',
                    'module'    => 'Akses User',
                    'url'       => \Request::url(),
                    'from'      => 'Website',
                ]);
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            DB::commit();
            return redirect()->route('dashboard');
        }
        # code...
        return redirect()->route('core.login')->with('error', 'Periksa kembali username atau password anda!');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('core.login');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            toast()->error('Gagal','Password gagal diubah!')->autoClose(2000);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user = Account::whereId(Auth()->user()->id)->first();
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            toast()->success('Berhasil','Password berhasil diubah!')->autoClose(2000);
            return redirect()->route('dashboard');
        }
    }
}
