<?php

namespace App\Http\Controllers\Admin;

use Session;
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

    public function search(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.booking'));
        }

        $bookings = Booking::getList($params);
        $counters = User::getAll(['account_type' => config('ticketing.account_type.counter')]);

        $request->session()->put(config('ticketing.session.admin.booking'), $params);
        return view('pages.admin.booking.search', ['params' => $params, 'bookings' => $bookings, 'counters' => $counters]);
    }

    public function step1(Request $request) {
        $showtime = date("Y-m-d H:i:s");
        $events = Event::getAvailableList($showtime);
        return view('pages.admin.booking.step1', ['events' => $events]);
    }

    public function getEvent(Request $request) {
        $event_id = $request->input('event_id');
        if (empty($event_id)) {
            return response()->json(['result' => 'invalid']);
        }
        $event = Event::getById($event_id);
        if (empty($event)) {
            return response()->json(['result' => 'invalid']);
        }

        $shows = Show::getAvailableList(['event_id' => $event_id, 'showtime' => date("Y-m-d H:i:s"), 'status' => config('ticketing.available.yes')]);

        return response()->json(['result' => 'success', 'event' => $event, 'shows' => $shows]);
    }

    public function step2(Request $request) {
        // $show_id = $request->input('show_id');
        // if (empty($show_id)) {
        //     return redirect()->route('admin-booking-step1');
        // }
        $show_id = 36;
        $show = Show::getById($show_id);
        if (empty($show)) {
            return redirect()->route('admin-booking-step1');
        }

        $event_id = $request->input('event_id');
        if(empty($event_id)) {
            return redirect()->route('admin-booking-step1');
        }

        $event = Event::getById($event_id);
        $prices = Price::getListByEvent($event_id);
        //$promotions = 

        $venue = Venue::getById($event->venue_id);
        $seats = Venue::getSeatsByVenue($event->venue_id);

        return view('pages.admin.booking.step2', ['event' => $event, 'show' => $show, 'prices' => $prices, 'venue' => $venue, 'seats' => $seats]);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.booking.new');
        }
        $booking = Booking::getById($id);
        return view('pages.admin.booking.edit', ['booking' => $booking]);
    }

    public function saveEvent(Request $request) {
        $event = $request->input();
        if (empty($event)) {
            return redirect()->route('admin-event-list');
        }
        if (empty($event['status']) || !(config('ticketing.available.yes') == $event['status'])) {
            $event['status'] = config('ticketing.available.no');
        }

        if (empty($event['id'])) {
            $event['id'] = Event::insert($event);
        } else {
            Event::update($event);
        }

        if ($request->has('event_image')) {
            $request->file('event_image')->storeAs('uploads/events', $event['id'], 'public');
        }

        return redirect()->route('admin-event-list');
    }

    public function getEventImage($id) {
        if (empty($id)) {
            $id = 0;
        }
        if (Storage::disk('public')->exists('uploads/events/' . $id)) {
            return Storage::disk('public')->download('uploads/events/' . $id);
        }
        return Storage::disk('public')->download('uploads/events/0');
    }

    public function getPrice(Request $request) {
        $event_id = $request->input('event_id');
        if (empty($event_id)) {
            return redirect()->route('admin-event-list');
        }

        $event = Event::getById($event_id);
        if (empty($event)) {
            return redirect()->route('admin-event-list');
        }
        $price_list = Price::getListByEvent($event_id);
        return view('pages.admin.event.price', ['event' => $event, 'price_list' => $price_list]);
    }

    public function savePrice(Request $request) {
        $event_id = $request->input('event_id');
        $arr_ticket_type = $request->input('ticket_type');
        $arr_price = $request->input('price');
        $arr_status = $request->input('status');

        if (empty($event_id)) {
            return redirect()->route('admin-event-list');
        }

        for ($i = 0; $i < count($arr_ticket_type); $i++) {
            $price = [
                'event_id' => $event_id,
                'ticket_type' => $arr_ticket_type[$i],
                'price' => $arr_price[$i],
                'status' => ($arr_status[$i] == 1) ? config('ticketing.available.yes') : config('ticketing.available.no'),
            ];

            Price::save($price);
        }

        return redirect()->route('admin-event-list');
    }

    public function getShows(Request $request) {
        $event_id = $request->input('event_id');
        if (empty($event_id)) {
            $event_id = $request->session()->get(config('ticketing.session.admin.show'));
            if (empty($event_id)) {
                return redirect()->route('admin-event-list');
            }
        }

        $event = Event::getById($event_id);
        if (empty($event)) {
            return redirect()->route('admin-event-list');
        }
        $shows = Show::getListByEvent($event_id);
        $price_list = Price::getListByEvent($event_id);

        $request->session()->put(config('ticketing.session.admin.show'), $event_id);
        return view('pages.admin.show.list', ['event' => $event, 'shows' => $shows, 'price_list' => $price_list]);
    }

    public function editShow(Request $request) {
        $id = $request->input('id');
        $event_id = $request->input('event_id');
        $show = NULL;
        $event = NULL;
        if (!empty($id)) {
            $show = Show::getById($id);
        }
        if (!empty($event_id)) {
            $event = Event::getById($event_id);
        }
        $venues = Venue::getList(['status' => config('ticketing.available.yes')]);
        return view('pages.admin.show.edit', ['show' => $show, 'event' => $event, 'venues' => $venues]);
    }

    public function saveShow(Request $request) {
        $show = $request->input();
        if (empty($show)) {
            echo json_encode(['result' => 'invalid']);
            exit;
        }

        $showtime = date_create_from_format('Y-m-d h:i a', $show['date_time']);
        $show['date_time'] = date_format($showtime, 'Y-m-d H:i:s');

        if (empty($show['status'])) {
            $show['status'] = config('ticketing.available.no');
        } else {
            $show['status'] = config('ticketing.available.yes');
        }

        if (empty($show['id'])) {
            $show['id'] = Show::insert($show);
        } else {
            Show::update($show);
        }
        echo json_encode(['result' => 'success']);
        exit;
    }

    public function step3(Request $request) {
        $event_id = $request->input('event_id');
        $show_id = $request->input('show_id');
        return view('pages.admin.booking.step3', ['show_id' => $show_id, 'event_id' => $event_id]);
    }

    public function saveBooking(Request $request) {
        $client_name = $request->input('client_name');
        $client_email = $request->input('client_email');
        $client_phone = $request->input('client_phone');
        $creator_id = $request->input('event_id');

        $userdata = Session::get('MELAKA_TICKETING_USER');

        if(empty($userdata)) {
            return redirect()->route('home');
        }

        $paradata = array(
            'uid' => $userdata->uid,
            'account_type' => $userdata->account_type,
            'creator_id' => $creator_id,
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'phone' => '12345678',
            'password' => '123',
            'is_active' => $userdata->is_active
        );

        return redirect()->route('admin-booking');
    }
}
