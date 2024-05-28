<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        return view('pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50'],
                'role_id' => ['required']
            ]);
            // dd($request->all());
            if (!$request->password) {
                $role = Role::findOrFail($request->role_id);
                $user = User::whereId($id)
                    ->lockForUpdate()
                    ->first();
                $user->removeRole($user->role);
                $user->assignRole($role->name);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id
                ]);
                // dd($user);
            } else {
                $role = Role::findOrFail($request->role_id);
                $user = User::whereId($id)
                    ->lockForUpdate()
                    ->first();
                $user->removeRole($user->role);
                $user->assignRole($role->name);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'password' => bcrypt($request->password)
                ]);
            }
            DB::commit();
            return redirect(route('users.index'))->with('success', 'Berhasil update user!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::whereId($id)->lockForUpdate()->first();
            $user->delete();
            DB::commit();
            return redirect(route('pages.users.index'))->with('success', 'Berhasil hapus <b>' . $user->name . '</b>');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
