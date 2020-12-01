<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Price extends Base
{
    private static $table = 'price';
    private static $table_venue = 'venue';
    private static $table_seat = 'venue_seat';

    public static function insert($price) {
        $id = DB::table(static::$table)->insertGetId([
            'event_id' => $price['event_id'],
            'ticket_type' => $price['ticket_type'],
            'weekday_price' => $price['weekday_price'],
            'weekend_price' => $price['weekend_price'],
            'seats' => $price['seats'],
            'status' => $price['status'],
        ]);
        return $id;
    }

    public static function update($price) {
        DB::table(static::$table)
            ->where('id', $price['id'])
            ->update([
                'ticket_type' => $price['ticket_type'],
                'weekday_price' => $price['weekday_price'],
                'weekend_price' => $price['weekend_price'],
                'seats' => $price['seats'],
                'status' => $price['status'],
            ]);
    }

    public static function getListByEvent($event_id) {
        if ($event_id == 0) {
            return array();
        }

        $query = DB::table(static::$table)
                    ->where('price.event_id', '=', $event_id)
                    ->select('price.*');

        $price_list = $query->get();
        return $price_list;
    }

    public static function getById($id) {
        $query = DB::table(static::$table)
                    ->where('price.id', '=', $id)
                    ->select('price.*');

        $price = $query->first();
        return $price;
    }

    public static function editPrice($id) {
        if ($event_id == 0) {
            return array();
        }

        $query = DB::table(static::$table)
                    ->where('event_id', '=', $event_id);

        $price_list = $query->get();
        return $price_list;
    }

}