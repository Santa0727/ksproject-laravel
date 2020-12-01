<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Event extends Base
{
    private static $table = 'event';
    private static $table_show = 'show';
    private static $table_venue = 'venue';

    public static function insert($event) {
        $id = DB::table(static::$table)->insertGetId([
                'title' => $event['title'],
                'duration' => $event['duration'],
                'description' => $event['description'],
                'venue_id' => $event['venue_id'],
                'from_date' => $event['from_date'],
                'to_date' => $event['to_date'],
                'status' => $event['status'],
        ]);
        return $id;
    }

    public static function update($event) {
        DB::table(static::$table)
            ->where('id', $event['id'])
            ->update([
                'title' => $event['title'],
                'duration' => $event['duration'],
                'description' => $event['description'],
                'from_date' => $event['from_date'],
                'to_date' => $event['to_date'],
                'status' => $event['status'],
            ]);
    }

    public static function getById($id) {
        $event = DB::table(static::$table)
                    ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
                    ->where('event.id', $id)
                    ->select(['event.*', 'venue.name AS venue_name'])
                    ->first();
        return $event;
    }

    public static function getCount($params) {
        $query = DB::table(static::$table)
                    ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
                    ->select(DB::raw('COUNT(*) as rows'));
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
                    ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
                    ->select(['event.*', 'venue.name AS venue_name']);
        $query = static::where($query, $params);
        if (empty($params['order_field'])) {
            $query = $query->orderBy('event.id', 'desc');
        } else {
            $query = $query->orderBy($params['order_field'], $params['order_op']);
        }
        $query = $query->take($params['rows'])->skip($params['rows'] * ($params['page'] - 1));

        $events = $query->get();
        return $events;
    }

    private static function where($query, $params) {
        if (!empty($params['keyword'])) {
            $query = $query->where('event.title', 'like', '%'.$params['keyword'].'%')
                        ->where('event.description', 'like', '%'.$params['keyword'].'%');
        }
        return $query;
    }

    public static function getAll($params) {
        $query = DB::table(static::$table)
                    ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
                    ->select(['event.*', 'venue.name AS venue_name']);
        $query = static::where($query, $params);
        if (empty($params['order_field'])) {
            $query = $query->orderBy('event.id', 'desc');
        } else {
            $query = $query->orderBy($params['order_field'], $params['order_op']);
        }

        $events = $query->get();
        return $events;
    }

    public static function getAvailableList($showtime) {
        // $query = DB::table(static::$table)
        //             ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
        //             ->join(static::$table_show, 'event.id', '=', 'show.event_id')
        //             ->groupBy('event.id')
        //             ->select(['event.*', 'venue.name AS venue_name'])
        //             ->where('show.date_time', '>=', $showtime)
        //             ->orderBy('event.id', 'asc');

        $query = DB::table(static::$table)
                    ->join(static::$table_venue, 'event.venue_id', '=', 'venue.id')
                    // ->join(static::$table_show, 'event.id', '=', 'show.event_id')
                    ->groupBy('event.id')
                    ->select(['event.*'])
                    ->where('event.from_date', '>=', $showtime)
                    ->orderBy('event.id', 'asc');

        $events = $query->get();

        // echo "<div style='margin-left:500px;'>";
        // var_dump($events);
        // echo "</div>";

        return $events;
    }

}
