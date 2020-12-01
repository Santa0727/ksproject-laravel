<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
	return view('pages.auth.login');
})->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
	Route::any('dashboard', function () {
		return view('pages.admin.dashboard');
	})->name('admin-dashboard');

	Route::any('account', 'Admin\AccountController@search')->name('admin-account');
	Route::any('account/edit', 'Admin\AccountController@edit')->name('admin-account-edit');
	Route::any('account/save', 'Admin\AccountController@save')->name('admin-account-save');
	Route::get('account/photo/{id}', 'Admin\AccountController@getPhoto');

	Route::any('account/role', 'Admin\AccountController@getRoles')->name('admin-account-role');
	Route::any('account/role/save', 'Admin\AccountController@saveRole')->name('admin-account-role-save');

	Route::any('agent', 'Admin\AgentController@search')->name('admin-agent');
	Route::any('agent/edit', 'Admin\AgentController@edit')->name('admin-agent-edit');
	Route::any('agent/save', 'Admin\AgentController@save')->name('admin-agent-save');
	Route::get('agent/photo/{id}', 'Admin\AgentController@getPhoto');

	Route::any('agent/payment_type', 'Admin\AgentController@getUserPaymentTypes')->name('admin-agent-paymenttype');
	Route::any('agent/payment_type/save', 'Admin\AgentController@saveUserPaymentType')->name('admin-agent-paymenttype-save');

	Route::any('counter', 'Admin\CounterController@search')->name('admin-counter');
	Route::any('counter/edit', 'Admin\CounterController@edit')->name('admin-counter-edit');
	Route::any('counter/save', 'Admin\CounterController@save')->name('admin-counter-save');
	Route::get('counter/photo/{id}', 'Admin\CounterController@getPhoto');

	Route::any('hall', 'Admin\VenueController@getVenues')->name('admin-hall');
	Route::any('hall/edit', 'Admin\VenueController@editVenue')->name('admin-hall-edit');
	Route::any('hall/save', 'Admin\VenueController@saveVenue')->name('admin-hall-save');
	Route::get('hall/map/{id}', 'Admin\VenueController@getSeatsMap');
	Route::any('hall/seat', 'Admin\VenueController@getSeats')->name('admin-hall-seat');
	Route::any('hall/seat/save', 'Admin\VenueController@saveSeats')->name('admin-hall-seat-save');

	Route::any('event', 'Admin\ShowController@getEvents')->name('admin-event-list');
	Route::any('event/edit', 'Admin\ShowController@editEvent')->name('admin-event-edit');
	Route::any('event/save', 'Admin\ShowController@saveEvent')->name('admin-event-save');
	Route::get('event/image/{id}', 'Admin\ShowController@getEventImage');
	Route::any('event/price', 'Admin\ShowController@getPriceList')->name('admin-event-price');
	Route::any('event/price/edit', 'Admin\ShowController@getPrice')->name('admin-event-price-edit');
	Route::any('event/price/save', 'Admin\ShowController@savePrice')->name('admin-event-price-save');
	Route::any('event/price/seats', 'Admin\ShowController@getSeats')->name('admin-event-price-seats');

	Route::any('show/schedule', 'Admin\ShowController@schedule')->name('admin-show-schedule');
	Route::any('show/list', 'Admin\ShowController@getShows')->name('admin-show-list');
	Route::any('show/edit', 'Admin\ShowController@editShow')->name('admin-show-edit');
	Route::any('show/save', 'Admin\ShowController@saveShow')->name('admin-show-save');
	Route::get('show/image/{id}', 'Admin\ShowController@getEventImage');

	Route::any('booking', 'Admin\BookingController@search')->name('admin-booking');
	Route::any('booking/step1', 'Admin\BookingController@step1')->name('admin-booking-step1');
	Route::any('booking/step1/event', 'Admin\BookingController@getEvent')->name('admin-booking-step1-event');
	Route::get('booking/event/image/{id}', 'Admin\ShowController@getEventImage');
	Route::any('booking/step2', 'Admin\BookingController@step2')->name('admin-booking-step2');
	Route::get('booking/hall/map/{id}', 'Admin\VenueController@getSeatsMap');

	// Route::any('booking/step3', function () {
	// 	return view('pages.admin.booking.step3');
	// })

	Route::any('booking/step3', 'Admin\BookingController@step3')->name('admin-booking-step3');
	Route::any('booking/save', 'Admin\BookingController@saveBooking')->name('admin-booking-save');

	Route::any('options', function () {
		return view('pages.admin.options.options');
	})->name('admin-options');

	Route::any('notifications', function () {
		return view('pages.admin.notification.list');
	})->name('admin-notifications');

	Route::any('report', function () {
		return view('pages.admin.report.list');
	})->name('admin-report');

	Route::any('promotion/package', 'Admin\PromotionController@getPackages')->name('admin-promotion-package');
	Route::any('promotion/package/edit', 'Admin\PromotionController@editPackage')->name('admin-promotion-package-edit');
	Route::any('promotion/package/save', 'Admin\PromotionController@savePackage')->name('admin-promotion-package-save');

	Route::any('promotion/event', 'Admin\PromotionController@getEvents')->name('admin-promotion-event');
	Route::any('promotion/event/edit', 'Admin\PromotionController@editEvent')->name('admin-promotion-event-edit');
	Route::any('promotion/event/save', 'Admin\PromotionController@saveEvent')->name('admin-promotion-event-save');
	Route::get('promotion/event/image/{id}', 'Admin\ShowController@getEventImage');
});

Route::prefix('agent')->middleware(['auth.agent'])->group(function () {
	Route::any('dashboard', function () {
		return view('pages.agent.dashboard');
	})->name('agent-dashboard');
	Route::any('user', 'Agent\UserController@search')->name('agent-user');
	Route::any('user/edit', 'Agent\UserController@edit')->name('agent-user-edit');
	Route::any('user/save', 'Agent\UserController@save')->name('agent-user-save');
	Route::get('user/photo/{id}', 'Agent\UserController@getPhoto');

});

Route::prefix('counter')->middleware(['auth.counter'])->group(function () {
	Route::any('dashboard', function () {
		return view('pages.counter.dashboard');
	})->name('counter-dashboard');


});

Route::prefix('booking')->group(function () {
	Route::any('show', function () {
		return view('pages.booking.show');
	})->name('booking-show');
	Route::any('ticket', 'Booking\BookingController@step2')->name('booking-ticket');
	Route::any('client', function () {
		return view('pages.booking.client');
	})->name('booking-client');
	Route::any('confirm', function () {
		return view('pages.booking.confirm');
	})->name('booking-confirm');
});
