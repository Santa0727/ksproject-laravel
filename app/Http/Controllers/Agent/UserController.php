<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPaymentType;

class UserController extends Controller
{

    public function search(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.agent.user'));
        }
        
        $login_agent = $request->session()->get(config('ticketing.login_user'));
        if ($login_agent->account_type == config('ticketing.account_type.agent')) {
            if (empty($params['account_type'])) {
                $params['account_type'] = [
                    config('ticketing.account_type.sub_agent_lv3')
                ];
            }
        } else if ($login_agent->account_type == config('ticketing.account_type.sub_agent_lv3')) {
            $params['account_type'] = [
                config('ticketing.account_type.sub_agent_lv4')
            ];
        }
        $params['agent_uid'] = $request->session()->get(config('ticketing.login_user'))->uid;

        $params['order_field'] = 'uid';
        $params['order_op'] = 'asc';
        $users = User::getList($params);

        $request->session()->put(config('ticketing.session.agent.user'), $params);
        return view('pages.agent.user.search', ['params' => $params, 'users' => $users]);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.agent.user.edit');
        }

        $user = User::getById($id);
        if (empty($user)) {
            return view('pages.agent.user.edit');
        }

        $login_agent = $request->session()->get(config('ticketing.login_user'));
        if ($login_agent->account_type == config('ticketing.account_type.agent')) {
            if (!($user->account_type == config('ticketing.account_type.sub_agent_lv3'))) {
                return redirect()->route('agent-user');
            }
        } else if ($login_agent->account_type == config('ticketing.account_type.sub_agent_lv3')) {
            if (!($user->account_type == config('ticketing.account_type.sub_agent_lv4'))) {
                return redirect()->route('agent-user');
            }
        }
        $pos = strpos($user->uid, $login_agent->uid);
        if (!($pos === 0)) {
            return redirect()->route('agent-user');
        }

        return view('pages.agent.user.edit', ['user' => $user]);
    }

    public function save(Request $request) {
        $user = $request->input();
        if (empty($user)) {
            return redirect()->route('agent-user');
        }
        if (empty($user['is_active']) || !(config('ticketing.account_active.yes') == $user['is_active'])) {
            $user['is_active'] = config('ticketing.account_active.no');
        }

        $login_agent = $request->session()->get(config('ticketing.login_user'));
        if (empty($user['id'])) {
            if ($login_agent->account_type == config('ticketing.account_type.agent')) {
                $user['account_type'] = config('ticketing.account_type.sub_agent_lv3');
            } else if ($login_agent->account_type == config('ticketing.account_type.sub_agent_lv3')) {
                $user['account_type'] = config('ticketing.account_type.sub_agent_lv4');
            }
            $user['creator_id'] = $login_agent->id;
            $user['password'] = Hash::make($user['password']);

            $agent_type = substr($login_agent->uid, 0, 1);
            $parent_number = substr($login_agent->uid, 1);

            $max_number = User::getAgentMaxNumber($user['account_type'], $agent_type, $parent_number);
            $user['uid'] = $agent_type . '-' . ($max_number + 1);

            $user['id'] = User::insert($user);
        } else {
            $temp = User::getById($user['id']);
            if (empty($temp)) {
                return redirect()->route('agent-user');
            }
            if ($login_agent->account_type == config('ticketing.account_type.agent')) {
                if (!($temp->account_type == config('ticketing.account_type.sub_agent_lv3'))) {
                    return redirect()->route('agent-user');
                }
            } else if ($login_agent->account_type == config('ticketing.account_type.sub_agent_lv3')) {
                if (!($temp->account_type == config('ticketing.account_type.sub_agent_lv4'))) {
                    return redirect()->route('agent-user');
                }
            }
            if (!(strpos($temp->uid, $login_agent->uid) === 0)) {
                return redirect()->route('agent-user');
            }
            User::update($user);
        }

        if ($request->has('photo')) {
            $request->file('photo')->storeAs('uploads/users', $user['id'], 'public');
        }

        return redirect()->route('agent-user');
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