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

Route::get('/notion', function () {
    $entities = \Notion::search()->query()->asCollection();
    $entities = $entities->sortBy(function ($item) {
        return $item->getObjectType();
    });
    return view('notion_base', ['entities' => $entities]);
});

Route::get('/notion/page/{pageId}', function ($pageId) {
    return view('notion_page', ['page' => \Notion::pages()->find($pageId), 'blocks' => \Notion::block($pageId)->children()]);
});

Route::get('/notion/database/{databaseId}', function ($databaseId) {
    return view('notion_database', ['database' => \Notion::databases()->find($databaseId), 'entries' => \Notion::database($databaseId)->query()->asCollection()]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
