<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Role extends Base
{
    private static $table = 'role';
    private static $table_role_url = 'role_url';
    private static $table_admin_role = 'admin_role';

    public static function save($role) {
        DB::table(static::$table_admin_role)
            ->updateOrInsert(
                ['user_id' => $role['user_id'], 'role_id' => $role['role_id']],
                ['level' => $role['level']]
            );
    }

    public static function delete($role) {
        DB::table(static::$table_admin_role)
            ->where('role_id', '=', $role['role_id'])
            ->where('user_id', '=', $role['user_id'])
            ->delete();
    }

    public static function getList($user_id) {
        $roles = DB::table(static::$table)
                    ->leftJoin(static::$table_admin_role, function ($join) use ($user_id) {
                        $join->on('role.id', '=', 'admin_role.role_id');
                        $join->on('admin_role.user_id', DB::raw("'".$user_id."'"));
                    })
                    ->select('role.*', 'admin_role.user_id', 'admin_role.level')
                    ->get();
        return $roles;
    }

}