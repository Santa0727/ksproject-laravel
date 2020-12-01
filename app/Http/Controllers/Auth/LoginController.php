<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{

    public function login(Request $request) {
        if (!$request->has(['uid', 'password'])) {
            return view('pages.auth.login');
        }

        $uid = $request->input('uid');
        $password = $request->input('password');

        $user = User::getByUid($uid);
        if ($user == NULL) {
            return view('pages.auth.login', ['uid' => $uid, 'error' => 'message.login_failed']);
        }
        if (!Hash::check($password, $user->password)) {
            return view('pages.auth.login', ['uid' => $uid, 'error' => 'message.login_failed']);
        }
        if (!($user->is_active == config('ticketing.account_active.yes'))) {
            return view('pages.auth.login', ['uid' => $uid, 'error' => 'message.login_failed']);
        }
        if ($user->account_type == config('ticketing.account_active.sub_admin')) {
            $role = Role::getList($user->id);
            $user->role = $role;
        }

        User::visit($user->id);

        unset($user->password);
        $request->session()->put(config('ticketing.login_user'), $user);

        switch ($user->account_type) {
            case config('ticketing.account_type.admin'):
            case config('ticketing.account_type.sub_admin'):
                return redirect()->route('admin-dashboard');
                break;
            case config('ticketing.account_type.agent'):
            case config('ticketing.account_type.sub_agent_lv3'):
            case config('ticketing.account_type.sub_agent_lv4'):
                return redirect()->route('agent-dashboard');
                break;
            case config('ticketing.account_type.counter'):
                return redirect()->route('counter-dashboard');
                break;
            default:
                return redirect()->route('home');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
