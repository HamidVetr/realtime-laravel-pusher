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

use App\Events\TestEvent;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * pusher with bridge package
 */

Route::get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
        'test-event',
        array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});

Route::get('/notifications', 'NotificationController@getIndex');
Route::post('/notifications/notify', 'NotificationController@postNotify');

/**
 * pusher with laravel events
 */

Route::get('/broadcast', function() {
    event(new TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('welcome');
});