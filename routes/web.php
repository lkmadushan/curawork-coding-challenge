<?php

use App\Http\Controllers\AcceptedConnectionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingConnectionsController;
use App\Http\Controllers\OutgoingConnectionsController;
use App\Http\Controllers\SuggestedConnectionsController;

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
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/suggested-connections', [SuggestedConnectionsController::class, 'index'])
        ->name('connections.suggested.index');
    Route::post('/suggested-connections', [SuggestedConnectionsController::class, 'store'])
        ->name('connections.suggested.store');

    Route::get('/outgoing-connections', [OutgoingConnectionsController::class, 'index'])
        ->name('connections.outgoing.index');
    Route::delete('/outgoing-connections/{user}', [OutgoingConnectionsController::class, 'destroy'])
        ->name('connections.outgoing.destroy');

    Route::get('/incoming-connections', [IncomingConnectionsController::class, 'index'])
        ->name('connections.incoming.index');
    Route::post('/incoming-connections', [IncomingConnectionsController::class, 'store'])
        ->name('connections.incoming.store');

    Route::get('/accepted-connections', [AcceptedConnectionsController::class, 'index'])
        ->name('connections.accepted.index');
    Route::delete('/accepted-connections/{user}', [AcceptedConnectionsController::class, 'destroy'])
        ->name('connections.accepted.destroy');
});
