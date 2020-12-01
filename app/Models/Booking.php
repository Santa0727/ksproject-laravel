<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Booking extends Base
{
    private static $table = 'booking';
    private static $table_event = 'event';
    private static $table_show = 'show';
    private static $table_user = 'user';
    private static $table_ticket = 'ticket';

    public static function insert($user) {
        $id = DB::table(static::$table)->insertGetId([
                // 'account_type' => $user['account_type'],
                'creator_id' => $user['uid'],
                'client_name' => $user['name'],
                'client_email' => $user['email'],
                'client_phone' => $user['phone'],
                // 'password' => $user['password'],
                'created_time' => date('Y-m-d H:i:s'),
                // 'is_active' => $user['is_active'],
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
                    ->where('account_type', '=', $agent_level)
                    ->where('uid', 'like', $agent_type . $parent_number . '____')
                    ->orderBy('uid', 'desc')
                    ->offset(0)->limit(1);
        $user = $query->first();
        if (empty($user))
            return 1000;
        return (int) substr($user->uid, strlen($user->uid) - 4);
    }

    public static function getCount($params) {
        $query = DB::table(static::$table)
                    ->join(static::$table_show, 'booking.show_id', '=', 'show.id')
                    ->join(static::$table_event, 'show.event_id', '=', 'event.id')
                    ->leftJoin(static::$table_user . ' AS creator', 'booking.creator_id', '=', 'creator.id')
                    ->leftJoin(static::$table_ticket . ' AS ticket', 'booking.id', '=', 'ticket.booking_id')
                    ->select(DB::raw('count(distinct booking.id) as rows'));
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

        $query = DB::table(static::$table)
                    ->join(static::$table_show, 'booking.show_id', '=', 'show.id')
                    ->join(static::$table_event, 'show.event_id', '=', 'event.id')
                    ->leftJoin(static::$table_user . ' AS creator', 'booking.creator_id', '=', 'creator.id')
                    ->leftJoin(static::$table_ticket . ' AS ticket', 'booking.id', '=', 'ticket.booking_id')
                    ->groupBy('booking.id')
                    ->select('booking.*', 'show.date_time AS show_date_time', 'event.title AS event_title');
        $query = static::where($query, $params);
        if (empty($params['order_field'])) {
            $query = $query->orderBy('booking.id', 'desc');
        } else {
            $query = $query->orderBy($params['order_field'], $params['order_op']);
        }
        $query = $query->take($params['rows'])->skip($params['rows'] * ($params['page'] - 1));

        $booking = $query->get();
        return $booking;
    }

    public static function getListAD() {
        $query = DB::table(static::$table)
                    ->join(static::$table_show, 'booking.show_id', '=', 'show.id')
                    ->join(static::$table_event, 'show.event_id', '=', 'event.id')
                    ->leftJoin(static::$table_user . ' AS creator', 'booking.creator_id', '=', 'creator.id')
                    ->leftJoin(static::$table_ticket . ' AS ticket', 'booking.id', '=', 'ticket.booking_id')
                    ->groupBy('booking.id')
                    ->select('booking.*', 'show.date_time AS show_date_time', 'event.title AS event_title');
        $booking = $query->get();
        return $booking;
    }

    private static function where($query, $params) {
        if (!empty($params['from_date'])) {
            $query = $query->where(DB::raw('Date(booking.created_time) >= \'' . $params['from_date'] . '\''));
        }
        if (!empty($params['to_date'])) {
            $query = $query->where(DB::raw('Date(booking.created_time) <= \'' . $params['to_date'] . '\''));
        }
        if (!empty($params['payment_type'])) {
            $query = $query->where('booking.payment_type', '=', $params['payment_type']);
        }
        if (!empty($params['ticket_type'])) {
            $query = $query->where('ticket.ticket_type', '=', $params['ticket_type']);
        }
        if (!empty($params['counter'])) {
            $query = $query->where('booking.creator_id', '=', $params['counter']);
        }
        if (!empty($params['agent'])) {
            $query = $query->where('creator.uid', '=', $params['agent']);
        }
        return $query;
    }

}