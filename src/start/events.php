<?php

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Orchestra\Support\Facades\Asset;
use Orchestra\Support\Facades\Widget;

/*
|--------------------------------------------------------------------------
| Attach multiple widget for Story CMS
|--------------------------------------------------------------------------
*/

View::composer('orchestra/foundation::dashboard.index', 'Orchestra\Story\Event\DashboardHandler@onDashboardView');

Event::listen('orchestra.form: extension.kakirigi/ostreidae', function () {
    $placeholder = Widget::make('placeholder.orchestra.extensions');
    $placeholder->add('permalink')->value(View::make('kakirigi/ostreidae::widgets.help'));
});

/*
|--------------------------------------------------------------------------
| Attach Configuration Callback
|--------------------------------------------------------------------------
*/

Event::listen('orchestra.form: extension.kakirigi/ostreidae', 'Orchestra\Story\Event\ExtensionHandler@onFormView');
Event::listen('orchestra.validate: extension.kakirigi/ostreidae', function (& $rules) {
    $rules['page_permalink'] = array('required');
    $rules['post_permalink'] = array('required');
});

/*
|--------------------------------------------------------------------------
| Add asset for Markdown Editing
|--------------------------------------------------------------------------
|
| Load asset based on for markdown.
|
*/

Event::listen('kakirigi.ostreidae.editor: markdown', function () {
    $asset = Asset::container('orchestra/foundation::footer');
    $asset->script('editor', 'packages/kakirigi/ostreidae/vendor/editor/editor.js');
    $asset->style('editor', 'packages/kakirigi/ostreidae/vendor/editor/editor.css');
    $asset->script('storycms', 'packages/kakirigi/ostreidae/js/ostreidae.min.js');
    $asset->script('storycms.md', 'packages/kakirigi/ostreidae/js/ostreidae.markdown.min.js', array('editor'));
});
