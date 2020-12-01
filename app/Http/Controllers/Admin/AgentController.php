<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPaymentType;

class AgentController extends Controller
{

    public function search(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.agent'));
        }
        if (empty($params['account_type'])) {
            $params['account_type'] = [
                config('ticketing.account_type.agent')
            ];
        }

        $params['order_field'] = 'uid';
        $params['order_op'] = 'asc';
        $users = User::getList($params);

        $request->session()->put(config('ticketing.session.admin.agent'), $params);
        return view('pages.admin.agent.search', ['params' => $params, 'users' => $users]);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.agent.edit');
        }
        $user = User::getById($id);
        if (empty($user) || $user->account_type != config('ticketing.account_type.agent')) {
            return view('pages.admin.agent.edit');
        }
        return view('pages.admin.agent.edit', ['user' => $user]);
    }

    public function save(Request $request) {
        $user = $request->input();
        if (empty($user)) {
            return redirect()->route('admin-agent');
        }
        if (empty($user['is_active']) || !(config('ticketing.account_active.yes') == $user['is_active'])) {
            $user['is_active'] = config('ticketing.account_active.no');
        }

        if (empty($user['id'])) {
            $user['account_type'] = config('ticketing.account_type.agent');
            $user['creator_id'] = $request->session()->get(config('ticketing.login_user'))->id;
            $user['password'] = Hash::make($user['password']);

            $max_number = User::getAgentMaxNumber($user['account_type'], $user['agent_type'], '');
            $user['uid'] = $user['agent_type'] . ($max_number + 1);

            $user['id'] = User::insert($user);
        } else {
            User::update($user);
        }

        if ($request->has('photo')) {
            $request->file('photo')->storeAs('uploads/users', $user['id'], 'public');
        }

        return redirect()->route('admin-agent');
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

    public function getUserPaymentTypes(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return redirect()->route('admin-agent');
        }

        $user = User::getById($id);
        if (empty($user)) {
            return redirect()->route('admin-agent');
        }
        $user_payment_types = UserPaymentType::getList($user->id);
        return view('pages.admin.agent.user_payment_type', ['user' => $user, 'user_payment_types' => $user_payment_types]);
    }

    public function saveUserPaymentType(Request $request) {
        $user_payment_type = $request->input();
        if (empty($user_payment_type)) {
            echo(json_encode(['result' => 'invalid']));
            exit;
        }

        if (empty($user_payment_type['available'])) {
            UserPaymentType::delete($user_payment_type);
        } else {
            UserPaymentType::save($user_payment_type);
        }
        echo(json_encode(['result' => 'success']));
        exit;
    }

}