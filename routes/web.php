<?php

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
    return inertia('Welcome');
})->name('welcome');

Route::get(
    '/post',
    function () {

        request()->validate(
            [
                'field' => 'in:id,title',
                'direction' => 'in:desc,asc',
            ]
        );

        $query = \App\Models\Post::query();

        if (request('search')) {
            $query->where('title', 'like', '%' .  request('search') . '%');
        }

        // Sort by
        if (request()->has(['field', 'direction'])) {
            $query->orderby(request('field'), request('direction'));
        }

        return Inertia::render(
            'Post',
            [
                'posts' => $query->get(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]
        );
    }
)->name('post');
