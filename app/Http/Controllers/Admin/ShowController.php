<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Price;
use App\Models\Show;
use App\Models\Venue;

class ShowController extends Controller
{

    public function getEvents(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.event'));
        }

        $events = Event::getList($params);

        $request->session()->put(config('ticketing.session.admin.event'), $params);
        return view('pages.admin.event.list', ['params' => $params, 'events' => $events]);
    }

    public function editEvent(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            $venues = Venue::getList(['status' => config('ticketing.available.yes')]);
            return view('pages.admin.event.edit', ['venues' => $venues]);
        }
        $event = Event::getById($id);
        return view('pages.admin.event.edit', ['event' => $event]);
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

    public function getPriceList(Request $request) {
        $event_id = $request->input('event_id');
        if (empty($event_id)) {
            return redirect()->route('admin-event-list');
        }

        $event = Event::getById($event_id);
        if (empty($event)) {
            return redirect()->route('admin-event-list');
        }
        $price_list = Price::getListByEvent($event_id);
        return view('pages.admin.event.price_list', ['event' => $event, 'price_list' => $price_list]);
    }

    public function getPrice(Request $request) {
        $price = $request->input();
        if (empty($price['event_id'])) {
            return view('pages.admin.event.price_edit');
        }
        $event = Event::getById($price['event_id']);
        if (empty($event)) {
            return view('pages.admin.event.price_edit');
        }
        $seats = Venue::getSeatsByVenue($event->venue_id);

        if (empty($price['id'])) {
            return view('pages.admin.event.price_edit', ['seats' => $seats]);
        }
        $price = Price::getById($price['id']);
        if (empty($price)) {
            return view('pages.admin.event.price_edit', ['seats' => $seats]);
        }
        return view('pages.admin.event.price_edit', ['price' => $price, 'seats' => $seats]);
    }

    public function savePrice(Request $request) {
        $price = $request->input();
        if (empty($price['seats'])) {
            $price['seats'] = '';
        } else {
            $price['seats'] = json_encode($price['seats']);
        }
        if (empty($price['id'])) {
            Price::insert($price);
        } else {
            Price::update($price);
        }

        echo json_encode(['result' => 'success']);
        exit;
    }

    public function schedule(Request $request) {
        $params = $request->input();
        if (empty($params['event_id'])) {
            return redirect()->route('admin-event-list');
        }

        $event = Event::getById($params['event_id']);
        if (empty($event)) {
            return redirect()->route('admin-event-list');
        }

        if (empty($params['year']) || empty($params['month'])) {
            $params['year'] = date_format(date_create($event->from_date), 'Y');
            $params['month'] = date_format(date_create($event->from_date), 'n');
        }

        return view('pages.admin.show.schedule', ['params' => $params, 'event' => $event]);
    }

    public function getShows(Request $request) {
        $params = $request->input();
        if (empty($params['event_id']) || empty($params['year']) || empty($params['month'])) {
            return response()->json(['result' => 'invalid']);
        }
        $shows = Show::getList($params);
        return response()->json(['result' => 'success', 'params' => $params, 'shows' => $shows]);
    }

    public function editShow(Request $request) {
        $params = $request->input();
        if (empty($params['event_id']) || empty($params['showdate'])) {
            return view('pages.admin.show.edit');
        }

        $shows = Show::getList($params);
        return view('pages.admin.show.edit', ['params' => $params, 'shows' => $shows]);
    }

    public function saveShow(Request $request) {
        $params = $request->input();
        if (empty($params['event_id']) || empty($params['showdate'])) {
            return response()->json(['result' => 'invalid']);
        }
        if (empty($params['showtime'])) {
            Show::delete(['event_id' => $params['event_id'], 'showdate' => $params['showdate']]);
            return response()->json(['result' => 'success']);
        }

        $temp = ['3:00 pm' => 0, '8:00 pm' => 0];
        for ($i = 0; $i < count($params['showtime']); $i++) {
            $showtime = $params['showtime'][$i];
            $status = $params['status'][$i];

            $temp[$showtime] = 1;

            $showtime = date_create_from_format('Y-m-d h:i a', $params['showdate'] . ' ' . $showtime);
            $hows[] = [];
            Show::save([
                'event_id' => $params['event_id'],
                'date_time' => date_format($showtime, 'Y-m-d H:i:s'),
                'status' => $status
            ]);
        }
        foreach ($temp as $showtime => $value) {
            if ($value == 0) {
                $showtime = date_create_from_format('Y-m-d h:i a', $params['showdate'] . ' ' . $showtime);
                Show::delete([
                    'event_id' => $params['event_id'],
                    'showtime' => date_format($showtime, 'Y-m-d H:i:s')
                ]);
            }
        }
        return response()->json(['result' => 'success']);
    }

}