<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Venue;

class VenueController extends Controller
{

    public function getVenues(Request $request) {
        $params = $request->input();
        if (empty($params)) {
            $params = $request->session()->get(config('ticketing.session.admin.venue'));
        }

        $venues = Venue::getList($params);

        $request->session()->put(config('ticketing.session.admin.venue'), $params);
        return view('pages.admin.venue.list', ['params' => $params, 'venues' => $venues]);
    }

    public function editVenue(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.venue.edit');
        }
        $venue = Venue::getById($id);
        return view('pages.admin.venue.edit', ['venue' => $venue]);
    }

    public function saveVenue(Request $request) {
        $venue = $request->input();
        if (empty($venue)) {
            return redirect()->route('admin-hall');
        }
        if (empty($venue['status']) || !(config('ticketing.available.yes') == $venue['status'])) {
            $venue['status'] = config('ticketing.available.no');
        }

        if (empty($venue['id'])) {
            $venue['id'] = Venue::insert($venue);
        } else {
            Venue::update($venue);
        }

        if ($request->has('seats_map')) {
            $request->file('seats_map')->storeAs('uploads/seats_map', $venue['id'], 'public');
        }

        return redirect()->route('admin-hall');
    }

    public function getSeatsMap($id) {
        if (empty($id)) {
            $id = 0;
        }
        if (Storage::disk('public')->exists('uploads/seats_map/' . $id)) {
            return Storage::disk('public')->download('uploads/seats_map/' . $id);
        }
        return Storage::disk('public')->download('uploads/seats_map/0');
    }

    public function getSeats(Request $request) {
        $veune_id = $request->input('venue_id');
        if (empty($veune_id)) {
            return redirect()->route('admin-hall');
        }

        $venue = Venue::getById($veune_id);
        if (empty($venue)) {
            return redirect()->route('admin-hall');
        }
        $seats = Venue::getSeatsByVenue($veune_id);
        return view('pages.admin.venue.seat', ['venue' => $venue, 'seats' => $seats]);
    }

    public function saveSeats(Request $request) {
        $params = $request->input();
        if (empty($params) || empty($params['seat_id'])) {
            echo json_encode(['result' => 'invalid']);
            exit;
        }
        $venue_id = $params['venue_id'];
        for($i = 0; $i < count($params['seat_name']); $i++) {
            $seat = [
                'id' => $params['seat_id'][$i],
                'venue_id' => $venue_id,
                'name' => $params['seat_name'][$i],
                'floor' => $params['seat_floor'][$i],
                'left' => $params['seat_left'][$i],
                'top' => $params['seat_top'][$i],
                'width' => $params['seat_width'][$i],
                'height' => $params['seat_height'][$i],
                'status' => ($params['seat_status'][$i] == 1) ? config('ticketing.available.yes') : config('ticketing.available.no')
            ];
            Venue::saveSeat($seat);
        }
        if (!empty($params['delete_id'])) {
            foreach ($params['delete_id'] as $id) {
                Venue::deleteSeat($id);
            }
        }
        $seats_count = Venue::calcSeatsCount($venue_id);
        Venue::setSeatsCount($venue_id, $seats_count);
        echo json_encode(['result' => 'success']);
        exit;
    }

}