<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Event;
use App\Models\Price;
use App\Models\Show;
use App\Models\Venue;

class PromotionController extends Controller
{

    public function getPackages(Request $request) {
        $packages = Package::getAll();

        return view('pages.admin.promotion.package_list', ['packages' => $packages]);
    }

    public function editPackage(Request $request) {
        $id = $request->input('id');
        if (empty($id)) {
            return view('pages.admin.promotion.package_edit');
        }
        $package = Package::getById($id);
        return view('pages.admin.promotion.package_edit', ['package' => $package]);
    }

    public function savePackage(Request $request) {
        $package = $request->input();
        if (empty($package)) {
            echo json_encode(['result' => 'invalid']);
            exit;
        }
        if (empty($package['status']) || !(config('ticketing.available.yes') == $package['status'])) {
            $package['status'] = config('ticketing.available.no');
        }

        if (empty($package['id'])) {
            $package['id'] = Package::insert($package);
        } else {
            Package::update($package);
        }

        echo json_encode(['result' => 'success']);
        exit;
    }

    public function getEvents(Request $request) {
        $events = Package::getEvents();

        return view('pages.admin.promotion.event_list', ['events' => $events]);
    }

    public function editEvent(Request $request) {
        $id = $request->input('id');
        $packages = Package::getAll();
        $shows = Event::getAll(array());
        if (empty($id)) {
            return view('pages.admin.promotion.event_edit', ['packages' => $packages, 'shows' => $shows]);
        }
        $event = Package::getEventById($id);
        return view('pages.admin.promotion.event_edit', ['event' => $event, 'packages' => $packages, 'shows' => $shows]);
    }

    public function saveEvent(Request $request) {
        $event = $request->input();
        if (empty($event)) {
            echo json_encode(['result' => 'invalid']);
            exit;
        }

        if (empty($event['status']) || !(config('ticketing.available.yes') == $event['status'])) {
            $event['status'] = config('ticketing.available.no');
        }

        if (empty($event['id'])) {
            $event['id'] = Package::insertEvent($event);
        } else {
            Package::updateEvent($event);
        }
        echo json_encode(['result' => 'success']);
        exit;
    }

}