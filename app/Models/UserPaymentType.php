<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class UserPaymentType extends Base
{
    private static $table = 'user_payment_type';
    private static $table_user = 'user';

    public static function save($user_payment_type) {
        DB::table(static::$table)
            ->updateOrInsert(
                ['user_id' => $user_payment_type['user_id'], 'payment_type' => $user_payment_type['payment_type']],
                []
            );
    }

    public static function delete($user_payment_type) {
        DB::table(static::$table)
            ->where('user_id', '=', $user_payment_type['user_id'])
            ->where('payment_type', '=', $user_payment_type['payment_type'])
            ->delete();
    }

    public static function getList($user_id) {
        $user_payment_types = DB::table(static::$table)
                            ->where('user_id', '=', $user_id)
                            ->get();
        return $user_payment_types;
    }

}