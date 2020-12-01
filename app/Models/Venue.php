<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Venue extends Base
{
    private static $table = 'venue';
    private static $table_seat = 'venue_seat';

    public static function insert($venue) {
        $id = DB::table(static::$table)->insertGetId([
                'name' => $venue['name'],
                'description' => $venue['description'],
                'status' => $venue['status'],
        ]);
        return $id;
    }

    public static function update($venue) {
        DB::table(static::$table)
            ->where('id', $venue['id'])
            ->update([
                'name' => $venue['name'],
                'description' => $venue['description'],
                'status' => $venue['status'],
            ]);
    }

    public static function getById($id) {
        $venue = DB::table(static::$table)->where('id', $id)->first();
        return $venue;
    }

    public static function getList($params) {
        $query = DB::table(static::$table);
        if (!empty($params['keyword'])) {
            $query = $query->where('name', 'like', '%' . $params['keyword'] . '%');
        }
        if (isset($params['status'])) {
            $query = $query->where('status', '=', $params['status']);
        }
        $venues = $query->get();
        return $venues;
    }

    public static function calcSeatsCount($venue_id) {
        if ($venue_id == 0) {
            return 0;
        }

        $query = DB::table(static::$table_seat)
                    ->where('venue_id', '=', $venue_id)
                    ->select(DB::raw('count(*) as rows'));
        $total = $query->first();
        return $total->rows;
    }

    public static function setSeatsCount($id, $seats_count) {
        DB::table(static::$table)
            ->where('id', '=', $id)
            ->update(['seats_count' => $seats_count]);
    }

    public static function getSeatsByVenue($venue_id) {
        if ($venue_id == 0) {
            return array();
        }

        $query = DB::table(static::$table_seat)
                    ->where('venue_id', '=', $venue_id);

        $seats = $query->get();
        return $seats;
    }

    public static function saveSeat($seat) {
        DB::table(static::$table_seat)
            ->updateOrInsert(
                ['id' => $seat['id']],
                [
                    'venue_id' => $seat['venue_id'],
                    'name' => $seat['name'],
                    'floor' => $seat['floor'],
                    'left' => $seat['left'],
                    'top' => $seat['top'],
                    'width' => $seat['width'],
                    'height' => $seat['height'],
                    'status' => $seat['status']
                ]
        );
    }

    public static function deleteSeat($id) {
        DB::table(static::$table_seat)
            ->where('id', '=', $id)->delete();
    }

}