<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class User extends Base
{
    private static $table = 'user';

    public static function insert($user) {
        $id = DB::table(static::$table)->insertGetId([
                'uid' => $user['uid'],
                'account_type' => $user['account_type'],
                'creator_id' => $user['creator_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'discount' => empty($user['discount']) ? NULL : $user['discount'],
                'password' => $user['password'],
                'created_time' => date('Y-m-d H:i:s'),
                'free' => empty($user['free']) ? NULL : $user['free'],
                'is_active' => $user['is_active'],
        ]);
        return $id;
    }

    public static function update($user) {
        DB::table(static::$table)
            ->where('id', $user['id'])
            ->update([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'discount' => empty($user['discount']) ? NULL : $user['discount'],
                'free' => empty($user['free']) ? NULL : $user['free'],
                'is_active' => $user['is_active'],
            ]);
    }

    public static function password($user) {
        DB::table(static::$table)
            ->where('id', $user['id'])
            ->update([
                'password' => $user['password']
            ]);
    }

    public static function visit($id) {
        DB::table(static::$table)
            ->where('id', $id)
            ->update(['last_login' => date("Y-m-d H:i:s")]);
    }

    public static function getById($id) {
        $user = DB::table(static::$table)->where('id', $id)->first();
        return $user;
    }

    public static function getByUid($uid) {
        $user = DB::table(static::$table)->where('uid', $uid)->first();
        return $user;
    }

    public static function getByEmail($email) {
        $user = DB::table(static::$table)->where('email', $email)->first();
        return $user;
    }

    public static function getAgentMaxNumber($agent_level, $agent_type, $parent_number) {
        $query = DB::table(static::$table)
                    ->where('account_type', '=', $agent_level);
        if ($agent_level == config('ticketing.account_type.agent')) {
            $query = $query->where('uid', 'like', $agent_type . $parent_number . '____');
            $query = $query->orderBy('uid', 'desc');
        } else if ($agent_level == config('ticketing.account_type.sub_agent_lv3')) {
            $query = $query->where('uid', 'like', $agent_type . $parent_number . '-%');
            $query = $query->where('uid', 'not like', $agent_type . $parent_number . '-%-%');
            $query = $query->orderBy(DB::raw('LENGTH(`uid`)'), 'desc');
            $query = $query->orderBy('uid', 'desc');
        } else if ($agent_level == config('ticketing.account_type.sub_agent_lv3')) {
            $query = $query->where('uid', 'like', $agent_type . $parent_number . '-%');
        }
        $query = $query->orderBy(DB::raw('LENGTH(`uid`)'), 'desc')
                    ->orderBy('uid', 'desc')
                    ->offset(0)->limit(1);
        $user = $query->first();
        if (empty($user)) {
            if ($agent_level == config('ticketing.account_type.agent')) {
                return 1000;
            } else {
                return 0;
            }
        }
        if ($agent_level == config('ticketing.account_type.agent')) {
            return (int) substr($user->uid, strlen($parent_number) + 1);
        } else {
            return (int) substr($user->uid, strlen($parent_number) + 2);
        }
    }

    public static function getCount($params) {
        $query = DB::table(static::$table)->select(DB::raw('count(*) as rows'));
        $query = static::where($query, $params);
        $total = $query->first();
        return $total->rows;
    }

    public static function getList(&$params) {
        $total = static::getCount($params);
        static::setPageinfo($params, $total);

        if ($total == 0) {
            return array();
        }

        $query = DB::table(static::$table);
        $query = static::where($query, $params);
        if (empty($params['order_field'])) {
            $query = $query->orderBy('id', 'desc');
        } else {
            $query = $query->orderBy($params['order_field'], $params['order_op']);
        }
        $query = $query->take($params['rows'])->skip($params['rows'] * ($params['page'] - 1));

        $users = $query->get();
        return $users;
    }
    public static function getAll($params) {
        $query = DB::table(static::$table);
        $query = static::where($query, $params);
        if (empty($params['order_field'])) {
            $query = $query->orderBy('id', 'desc');
        } else {
            $query = $query->orderBy($params['order_field'], $params['order_op']);
        }

        $users = $query->get();
        return $users;
    }

    private static function where($query, $params) {
        if (!empty($params['account_type'])) {
            if (is_array($params['account_type'])) {
                $query = $query->where(function ($where) use ($params) {
                    $first = true;
                    foreach ($params['account_type'] as $account_type) {
                        if ($first) {
                            $where->where('account_type', '=', $account_type);
                            $first = false;
                        } else {
                            $where->orWhere('account_type', '=', $account_type);
                        }
                    }
                });
            } else {
                $query = $query->where('account_type', '=', $params['account_type']);
            }
        }
        if (!empty($params['keyword'])) {
            $query = $query->where('uid', 'like', '%'.$params['keyword'].'%')
                        ->where('name', 'like', '%'.$params['keyword'].'%')
                        ->where('email', 'like', '%'.$params['keyword'].'%');
        }
        if (!empty($params['agent_uid'])) {
            $query = $query->where('uid', 'like', $params['agent_uid'].'_%');
        }
        return $query;
    }

}