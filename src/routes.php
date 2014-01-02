<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Orchestra\Support\Facades\App;
use Orchestra\Support\Facades\Resources;

/*
|--------------------------------------------------------------------------
| Frontend Routing
|--------------------------------------------------------------------------
*/

Route::group(App::group('kakirigi/ostreidae', 'blog'), function () {
    $page = Config::get('kakirigi/ostreidae::permalink.page');
    $post = Config::get('kakirigi/ostreidae::permalink.post');

    Route::get($post, 'Orchestra\Story\Routing\PostController@show')
        ->where('{slug}', '(^[posts|rss])');

    Route::get('posts', 'Orchestra\Story\Routing\HomeController@showPosts');

    Route::get($page, 'Orchestra\Story\Routing\PageController@show')
        ->where('{slug}', '(^[posts|rss])');

    Route::get('/', 'Orchestra\Story\Routing\HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Backend Routing
|--------------------------------------------------------------------------
*/

Event::listen('orchestra.started: admin', function () {
    $story = Resources::make('ostreidae', array(
        'name'    => 'Ostreidae Blog',
        'uses'    => 'restful:Orchestra\Story\Routing\Api\HomeController',
        'visible' => Auth::check(),
    ));

    $story['posts'] = 'resource:Orchestra\Story\Routing\Api\PostsController';
    $story['pages'] = 'resource:Orchestra\Story\Routing\Api\PagesController';
});
