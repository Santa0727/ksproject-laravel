<?php

namespace App\Http\Controllers\Booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Event;
use App\Models\Show;
use App\Models\Price;
use App\Models\Venue;
use App\Models\Ticket;

class BookingController extends Controller
{

    public function step2(Request $request) {
        
        $seats = Venue::getSeatsByVenue(1);

        return view('pages.booking.ticket', ['seats' => $seats]);
    }

}