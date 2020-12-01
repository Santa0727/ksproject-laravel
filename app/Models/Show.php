<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Show extends Base
{
    private static $table = 'show';
    private static $table_venue = 'venue';

    public static function insert($show) {
        $id = DB::table(static::$table)->insertGetId([
                'event_id' => $show['event_id'],
                'venue_id' => $show['venue_id'],
                'date_time' => $show['date_time'],
                'status' => $show['status'],
        ]);
        return $id;
    }

    public static function update($show) {
        DB::table(static::$table)
            ->where('id', $show['id'])
            ->update([
                'venue_id' => $show['venue_id'],
                'date_time' => $show['date_time'],
                'status' => $show['status'],
            ]);
    }

    public static function save($show) {
        DB::table(static::$table)
            ->updateOrInsert(
                ['event_id' => $show['event_id'], 'date_time' => $show['date_time']],
                ['status' => $show['status']]
            );
    }

    public static function delete($filter) {
        $query = DB::table(static::$table);
        if (!empty($filter['event_id'])) {
            $query = $query->where('event_id', '=', $filter['event_id']);
        }
        if (!empty($filter['showdate'])) {
            $query = $query->where(DB::raw('DATE(`date_time`)'), $filter['showdate']);
        }
        if (!empty($filter['showtime'])) {
            $query = $query->where('date_time', '=', $filter['showtime']);
        }
        $query->delete();
    }

    public static function getById($id) {
        $show = DB::table(static::$table)->where('id', $id)->first();
        return $show;
    }

    public static function getListByEvent($event_id) {
        if ($event_id == 0) {
            return array();
        }
        
        $query = DB::table(static::$table)
                    ->join(static::$table_venue, 'show.venue_id', '=', 'venue.id')
                    ->where('show.event_id', '=', $event_id)
                    ->select('show.*', 'venue.name AS venue_name')
                    ->orderBy('show.date_time', 'asc');

        $shows = $query->get();
        return $shows;
    }

    public static function getList($filter) {
        $query = DB::table(static::$table);
        if (!empty($filter['event_id'])) {
            $query = $query->where('event_id', '=', $filter['event_id']);
        }
        if (!empty($filter['year'])) {
            $query = $query->where(DB::raw('YEAR(`date_time`)'), $filter['year']);
        }
        if (!empty($filter['month'])) {
            $query = $query->where(DB::raw('MONTH(`date_time`)'), $filter['month']);
        }
        if (!empty($filter['showdate'])) {
            $query = $query->where(DB::raw('DATE(`date_time`)'), $filter['showdate']);
        }
        $query = $query->orderBy('date_time', 'ASC');

        $shows = $query->get();
        return $shows;
    }

    
    public static function getAvailableList($filter) {
        $query = DB::table(static::$table);
        if (!empty($filter['event_id'])) {
            $query = $query->where('event_id', '=', $filter['event_id']);
        }
        if (!empty($filter['showtime'])) {
            $query = $query->where('date_time', '>', $filter['showtime']);
        }
        if (!empty($filter['status'])) {
            $query = $query->where('status', '=', $filter['status']);
        }
        $query = $query->orderBy('date_time', 'ASC');

        $shows = $query->get();
        return $shows;
    }

}