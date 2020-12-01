<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Package extends Base
{
    private static $table = 'package';
    private static $table_promotion_event = 'promotion_event';
    private static $table_event = 'event';

    public static function getAll() {
        $query = DB::table(static::$table);
        $packages = $query->get();
        return $packages;
    }

    public static function getById($id) {
        $query = DB::table(static::$table)
                    ->where('id', '=', $id);
        $package = $query->first();
        return $package;
    }

    public static function insert($package) {
        $id = DB::table(static::$table)->insertGetId([
                'name' => $package['name'],
                'ticket_type' => $package['ticket_type'],
                'tickets' => $package['tickets'],
                'status' => $package['status'],
        ]);
        return $id;
    }

    public static function update($package) {
        DB::table(static::$table)
            ->where('id', $package['id'])
            ->update([
                'name' => $package['name'],
                'ticket_type' => $package['ticket_type'],
                'tickets' => $package['tickets'],
                'status' => $package['status'],
            ]);
    }

    public static function getEvents() {
        $query = DB::table(static::$table_promotion_event)
                    ->join(static::$table_event, 'promotion_event.event_id', '=', 'event.id')
                    ->leftJoin(static::$table, 'promotion_event.package_id', '=', 'package.id')
                    ->select('promotion_event.*',
                        'event.title AS event_title', 'event.duration AS event_duration', 'event.from_date AS event_from_date', 'event.to_date AS event_to_date', 'event.status AS event_status',
                        'package.name AS package_name', 'package.ticket_type AS package_ticket_type', 'package.tickets AS package_tickets', 'package.status AS package_status')
                    ->orderBy('promotion_event.id', 'DESC');

        $events = $query->get();
        return $events;
    }

    public static function getEventById($id) {
        if (empty($id)) {
            return NULL;
        }

        $query = DB::table(static::$table_promotion_event)
                    ->join(static::$table_event, 'promotion_event.event_id', '=', 'event.id')
                    ->leftJoin(static::$table, 'promotion_event.package_id', '=', 'package.id')
                    ->select('promotion_event.*',
                        'event.title AS event_title', 'event.duration AS event_duration', 'event.from_date AS event_from_date', 'event.to_date AS event_to_date', 'event.status AS event_status',
                        'package.name AS package_name', 'package.ticket_type AS package_ticket_type', 'package.tickets AS package_tickets', 'package.status AS package_status')
                    ->where('promotion_event.id', '=', $id);
        $event = $query->first();
        return $event;
    }

    public static function insertEvent($event) {
        $id = DB::table(static::$table_promotion_event)->insertGetId([
                'name' => $event['name'],
                'event_id' => $event['event_id'],
                'ticket_type' => empty($event['ticket_type']) ? NULL : $event['ticket_type'],
                'package_id' => empty($event['package_id']) ? NULL : $event['package_id'],
                'from_date' => $event['from_date'],
                'to_date' => $event['to_date'],
                'quota' => $event['quota'],
                'week' => $event['week'],
                'price' => $event['price'],
                'status' => $event['status'],
                'limit_status' => $event['limit_status'],
                'limit_start' => $event['limit_start'],
                'limit_end' => $event['limit_end']
        ]);
        return $id;
    }

    public static function updateEvent($event) {
        DB::table(static::$table_promotion_event)
            ->where('id', $event['id'])
            ->update([
                'name' => $event['name'],
                'event_id' => $event['event_id'],
                'ticket_type' => empty($event['ticket_type']) ? NULL : $event['ticket_type'],
                'package_id' => empty($event['package_id']) ? NULL : $event['package_id'],
                'from_date' => $event['from_date'],
                'to_date' => $event['to_date'],
                'quota' => $event['quota'],
                'week' => $event['week'],
                'price' => $event['price'],
                'status' => $event['status'],
                'limit_status' => $event['limit_status'],
                'limit_start' => $event['limit_start'],
                'limit_end' => $event['limit_end']
            ]);
    }

    public static function getEventsForBooking($filter) {
        $query = DB::table(static::$table_promotion_event)
                    ->leftJoin(static::$table, 'promotion_event.package_id', '=', 'package.id')
                    ->select('promotion_event.*',
                        'package.name AS package_name', 'package.ticket_type AS package_ticket_type', 'package.tickets AS package_tickets', 'package.status AS package_status')
                    ->where('promotion_event.event_id', '=', $filter['event_id'])
                    ->where('promotion_event.from_date', '>=', $filter['showdate'])
                    ->where('promotion_event.to_date', '<=', $filter['showdate'])
                    ->orderBy('promotion_event.id', 'DESC');

        $events = $query->get();
        return $events;
    }

}