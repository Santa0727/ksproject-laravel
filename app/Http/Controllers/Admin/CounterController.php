<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class CounterController extends Controller
{

    public function search(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.counter'));
        }
        $params['account_type'] = config('ticketing.account_type.counter');

        $users = User::getList($params);

        $request->session()->put(config('ticketing.session.admin.counter'), $params);
        return view('pages.admin.counter.search', ['params' => $params, 'users' => $users]);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.counter.edit');
        }
        $user = User::getById($id);
        return view('pages.admin.counter.edit', ['user' => $user]);
    }

    public function save(Request $request) {
        $user = $request->input();
        if (empty($user)) {
            return redirect()->route('admin-counter');
        }
        if (empty($user['is_active']) || !(config('ticketing.account_active.yes') == $user['is_active'])) {
            $user['is_active'] = config('ticketing.account_active.no');
        }
        if (empty($user['free']) || !(config('ticketing.available.yes') == $user['free'])) {
            $user['free'] = config('ticketing.available.no');
        }

        if (empty($user['id'])) {
            $user['account_type'] = config('ticketing.account_type.counter');
            $user['creator_id'] = $request->session()->get(config('ticketing.login_user'))->id;
            $user['password'] = Hash::make($user['password']);
            $user['id'] = User::insert($user);
        } else {
            User::update($user);
        }

        if ($request->has('photo')) {
            $request->file('photo')->storeAs('uploads/users', $user['id'], 'public');
        }

        return redirect()->route('admin-counter');
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

}