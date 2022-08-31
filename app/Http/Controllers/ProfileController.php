<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('layouts.pages.profile.index');
    }

    public function changephoto(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,png,jpeg',
        ]);

        $user = Account::whereId(Auth()->user()->id)->first();

        DB::beginTransaction();

        try {
            //code...
            if ($request->hasFile('photo')) {
                Storage::disk('local')->delete('public/users/' . Auth()->user()->id .'/'. basename($user->foto));
                $foto = $request->file('photo');
                $foto->storeAs('public/users/' . Auth()->user()->id, $foto->hashName());
                $user->foto = $foto->hashName();
            }

            $user->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();
        Alert::success('Data berhasil diperbaharui!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|max:100',
            'email'     => 'required|max:100',
            'username'  => 'required|max:100',
        ]);
        DB::beginTransaction();
        try {
            $user = Account::whereId(Auth()->user()->id)->first();
            $user->update([
                'name'                 => $request->name,
                'email'                => $request->email,
                'username'             => $request->username,
                'whatsapp'             => $request->whatsapp,
                'slack'                => $request->slack,
            ]);
            $user->save();
            Logs::create([
                'uuid'      => Uuid::uuid4(),
                'username'  => Auth()->user()->name,
                'activity'  => 'U',
                'module'    => 'User Profile',
                'url'       => \Request::url(),
                'from'      => 'Website',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();
        Alert::success('Data berhasil diperbaharui!');
        return redirect()->back();
    }
}
