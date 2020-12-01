<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Ticket extends Base
{
    private static $table = 'ticket';
    private static $table_venue_seat = 'venue_seat';

    public static function getSeats($params) {
        $query = DB::table(static::$table_venue_seat)
                    ->leftJoin(static::$table, function ($join) use ($params) {
                        $join->on('venue_seat.id', '=', 'ticket.seat_id');
                        $join->on('ticket.show_id', '=', $params['show_id']);
                    })
                    ->where('venue_seat.venue_id', '=', $params['venue_id'])
                    ->select('venue_seat.*', 'ticket.booking_id', 'ticket.ticket_type', 'ticket.price_id', 'ticket.status');
        $seats = $query->get();
        return $seats;
    }

}