<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class AccountController extends Controller
{

    public function search(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.account'));
        }
        $params['account_type'] = config('ticketing.account_type.sub_admin');

        $users = User::getList($params);

        $request->session()->put(config('ticketing.session.admin.account'), $params);
        return view('pages.admin.account.search', ['params' => $params, 'users' => $users]);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.account.edit');
        }
        $user = User::getById($id);
        return view('pages.admin.account.edit', ['user' => $user]);
    }

    public function save(Request $request) {
        $user = $request->input();
        if (empty($user)) {
            return redirect()->route('admin-account');
        }
        if (empty($user['is_active']) || !(config('ticketing.account_active.yes') == $user['is_active'])) {
            $user['is_active'] = config('ticketing.account_active.no');
        }

        if (empty($user['id'])) {
            $user['account_type'] = config('ticketing.account_type.sub_admin');
            $user['creator_id'] = $request->session()->get(config('ticketing.login_user'))->id;
            $user['password'] = Hash::make($user['password']);
            $user['id'] = User::insert($user);
        } else {
            User::update($user);
        }

        if ($request->has('photo')) {
            $request->file('photo')->storeAs('uploads/users', $user['id'], 'public');
            //$url = Storage::url('uploads/users/2'); print_r($url); exit;
            //$url = asset($url);
        }

        return redirect()->route('admin-account');
    }

    public function getPhoto($id) {
        if (empty($id)) {
            $id = 0;
        }
        if (Storage::disk('public')->exists('uploads/users/' . $id)) {
            return Storage::disk('public')->download('uploads/users/' . $id);
        }
        return Storage::disk('public')->download('uploads/users/0');
    }

    public function getRoles(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return redirect()->route('admin-account');
        }

        $user = User::getById($id);
        if (empty($user)) {
            return redirect()->route('admin-account');
        }
        $roles = Role::getList($user->id);
        return view('pages.admin.account.role', ['user' => $user, 'roles' => $roles]);
    }

    public function saveRole(Request $request) {
        $role = $request->input();
        if (empty($role)) {
            echo(json_encode(['result' => 'invalid']));
            exit;
        }

        if (empty($role['level'])) {
            Role::delete($role);
        } else {
            Role::save($role);
        }
        echo(json_encode(['result' => 'success']));
        exit;
    }

}