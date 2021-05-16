<?php

use FiveamCode\LaravelNotionApi\Notion;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/notion', function() {
    $notion = new Notion();
    return view('notion_base', ['entities' =>  $notion->search()->query()]);
});

Route::get('/notion/page/{pageId}', function($pageId) {
    $notion = new Notion();
    return view('notion_page', ['page' => $notion->pages()->find($pageId), 'blocks' => $notion->block($pageId)->children()]);
});

Route::get('/notion/database/{databaseId}', function($databaseId) {
    $notion = new Notion();
    return view('notion_database', ['database' => $notion->databases()->find($databaseId), 'entries' => $notion->database($databaseId)->query()]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
