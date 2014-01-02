<?php

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Orchestra\Support\Facades\Acl;
use Orchestra\Story\Facades\StoryFormat;

/*
|--------------------------------------------------------------------------
| Fire Event based on Format
|--------------------------------------------------------------------------
|
| Fire an event for selected editing format.
|
*/

Route::filter('kakirigi.ostreidae.editor', function ($request, $route, $format = '') {
    Event::fire("kakirigi.ostreidae.editor: {$format}");
});

/*
|--------------------------------------------------------------------------
| Filter Content Management
|--------------------------------------------------------------------------
|
| Filter if user can execute certain task to a post/page, e.g: edit a post.
|
*/

Route::filter('kakirigi.ostreidae', function ($request, $route, $value = '') {
    list($action, $type) = explode('-', $value);

    $acl = Acl::make('kakirigi/ostreidae');

    if (! ($acl->can("{$action} {$type}") or $acl->can("manage {$type}"))) {
        return Redirect::to(resources("ostreidae.{$type}s"));
    }
});
