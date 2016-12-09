<?php

Route::get('/', 'ClientController@index')->name('client.home');
Route::get('/page', 'ClientController@demo');

Route::match(['get', 'post'], 'locations/{location?}', 'ClientController@room')->name('client.room');
Route::match(['get', 'post'], 'map-data.json', 'ClientController@roomMaker')->name('client.marker');
Route::get('photo.json/{id}', 'ClientController@__photo_room')->name('client.photo');
Route::get('around-locations.json/{id}', 'ClientController@__around_locations')->name('client.arounds');
Route::get('rooms/{id}', 'ClientController@singleRoom')->name('room.detail');
Route::get('rooms/{id}', 'ClientController@singleRoom')->name('room.detail');

Route::get('{slug}', function () {
	return 'Đang cập nhật';
})->name('client.read');
// Route::get('rooms/libraries/{id}', function () {
//     return view('defaults/libraries-room');
// });

// Route::get('test', function () {
//     return view('default/test');
// });



Route::group(['prefix' => 'admin'], function () {

	Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
	Route::group([ 'namespace' => 'Admin' ], function () {
		Route::get('login', 'AdminController@showLoginForm')->name('admin.login');
		Route::post('login', 'AdminController@login')->name('post.login');
		Route::post('logout', 'AdminController@logout')->name('admin.logout');
		Route::get('/password/reset/{token?}', 'AdminController@showLinkRequestForm');
		Route::post('/password/email','AdminController@showResetForm');
	});

	Route::group([ 'middleware' => [ 'admin:dev' ]], function () {
		Route::get('/', 'Admin\DashboardController@index')->name('admin.home');

		Route::get('/rooms', 'Admin\HostController@listing')->name('admin.room');
		Route::delete('/rooms/{id}', 'Admin\HostController@deleteHost')->name('admin.room.delete');

		Route::resource('/amenities', 'Admin\AmenitiesController', ['except' => [ 'show' ]]);
		Route::resource('/spaces', 'Admin\SpaceController', ['except' => [ 'show' ]]);
		Route::resource('/properties', 'Admin\PropertyController', ['except' => [ 'show' ]]);
		Route::resource('/kinds', 'Admin\KindController', ['except' => [ 'show' ]]);
		Route::resource('/bed_types', 'Admin\BedTypeController', ['except' => [ 'show' ]]);
		Route::resource('/locations', 'Admin\LocationsController', ['except' => [ 'show' ]]);
		
		Route::get('settings/interface', 'Admin\SettingsController@interface')->name('settings.interface');
		Route::get('settings/interface/ins/{id}', 'Admin\SettingsController@insInterface')->name('settings.locations_ins');
		Route::post('settings/interface/position', 'Admin\SettingsController@updatePosition')->name('settings.position');
		Route::post('settings/interface/config', 'Admin\SettingsController@updateConfig')->name('settings.config');
		Route::delete('settings/interface/delete/{id}', 'Admin\SettingsController@deleteElement')->name('settings.delete_elem');

		/*Pages*/
		Route::resource('categories', 'Admin\CategoriesController', ['except' => [ 'show' ]]);
		Route::resource('pages', 'Admin\PagesController', ['except' => [ 'show' ]]);
		Route::resource('posts', 'Admin\PostsController', ['except' => [ 'show' ]]);

		/*Menu route*/
		Route::get('menus', 'Admin\MenuController@index')->name('menus.index');
		Route::get('menus/create', 'Admin\MenuController@create')->name('menus.create');
		Route::post('menus/srote', 'Admin\MenuController@store')->name('menus.store');
		Route::put('menus/{id}/update', 'Admin\MenuController@update')->name('menus.update');
		Route::delete('menus/delete/{id?}', 'Admin\MenuController@destroy')->name('menus.delete');
		Route::get('menus/{id}/builder/', 'Admin\MenuController@builder')->name('menus.builder');
		Route::delete('menu/delete_menu_item/{id?}', 'Admin\MenuController@delete_menu')->name('menus.delete_menu_item');
		Route::post('menu/add_item', 'Admin\MenuController@add_item')->name('menus.add_item');
		Route::put('menu/update_menu_item', 'Admin\MenuController@update_item')->name('menus.update_menu_item');
		Route::post('menu/order', 'Admin\MenuController@order_item')->name('menus.order_item');
		Route::post('menu/add-related', 'Admin\MenuController@addRelated')->name('menus.related');


		/*Setting gernerate*/
		Route::get('settings', 'Admin\SettingsController@index')->name('web.settings');
		Route::post('settings', 'Admin\SettingsController@save');
		Route::post('settings/create', 'Admin\SettingsController@create')->name('web.settings.create');
		Route::delete('settings/{id}', 'Admin\SettingsController@delete')->name('web.settings.delete');
		Route::get('settings/move_up/{id}', 'Admin\SettingsController@move_up')->name('web.settings.move_up');
		Route::get('settings/move_down/{id}', 'Admin\SettingsController@move_down')->name('web.settings.move_down');
		Route::get('settings/delete_value/{id}', 'Admin\SettingsController@delete_value')->name('web.settings.delete_value');


		/*FILE*/

		Route::any('files/connector', 'Admin\FileController@anyConnector')->name('file.connect');
		Route::get('files/file-manager', 'Admin\FileController@getFileManager')->name('file.viewFile');


		Route::group([ 'prefix' => 'become-a-host' ], function () {
			Route::group([ 'namespace' => 'Host' ], function () {
				Route::get('create/{room?}', 'RoomController@index')->name('admin.room.create');

				Route::get('basic/{room?}', 'BasicRegisterController@getForm')->name('host.basic');
				Route::post('register-host/{room?}', 'BasicRegisterController@postForm')->name('host.register');
				Route::put('register-host/{room}', 'BasicRegisterController@updateForm')->name('host.update');
				
				Route::get('settings/{room?}', 'SettingHostController@getForm')->name('host.setting');
				Route::put('settings-host/{room?}', 'SettingHostController@postForm')->name('host.upsetting');
				
				Route::put('active/{room}', 'RoomController@postActiveCreate')->name('host.active');
				Route::put('status/{room}', 'RoomController@statusUpdate')->name('host.status');
				
				Route::delete('/photo/{id}', 'SettingHostController@removePhoto')->name('rm.photo');
				//step 3

				Route::get('booking-settings/{room?}', 'RoomController@getBookingCreate')->name('host.booking');

				Route::get('calendar/{room?}', 'RoomController@getCalendarCreate')->name('host.calendar');
				Route::post('calendar/{room?}', 'RoomController@postCalendarCreate')->name('host.post.calendar');

				Route::get('trip-length/{room?}', 'RoomController@getTripLengthCreate')->name('host.triplength');
				Route::post('trip-length/{room?}', 'RoomController@postTripLengthCreate')->name('host.post.triplength');

				Route::get('availability/{room?}', 'RoomController@getAvailabilityCreate')->name('host.availability');
				Route::post('availability/{room?}', 'RoomController@postAvailabilityCreate')->name('host.post.availability');

				Route::get('choose-pricing-mode/{room?}', 'RoomController@getChoosePricingModeCreate')->name('host.pricing_mode');
				Route::post('choose-pricing-mode/{room?}', 'RoomController@postChoosePricingModeCreate')->name('host.post.pricing_mode');
				
				Route::get('price/{room?}', 'RoomController@getPriceCreate')->name('host.price');
				Route::post('price/{room?}', 'RoomController@postPriceCreate')->name('host.post.price');

				Route::get('additional-pricing/{room?}', 'RoomController@getAdditionalPricingCreate')->name('host.addpricing');
				Route::post('additional-pricing/{room?}', 'RoomController@postAdditionalPricingCreate')->name('host.post.addpricing');
				
				Route::get('house-rules/{room?}', 'RoomController@getHouseRulesCreate')->name('host.rules');
				Route::post('house-rules/{room?}', 'RoomController@postHouseRulesCreate')->name('host.post.rules');
			
				Route::get('locations-around/{room?}', 'RoomController@getLocationsAroundCreate')->name('host.locations_around');
				Route::post('locations-around/{room?}', 'RoomController@postLocationsAroundCreate')->name('host.post.locations_around');
				Route::get('api/locations-around/{room?}', 'RoomController@getAPILocationsAround');
				Route::delete('api/locations-around/{id}/{room?}', 'RoomController@deleteAPILocationsAround');

				Route::get('check-in/{room?}', 'RoomController@getCheckinCreate')->name('host.checkin');
				Route::post('check-in/{room?}', 'RoomController@postCheckinCreate')->name('host.post.checkin');
			});
		});
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index');
