<?php

use Orchestra\Support\Facades\Acl;
use Orchestra\Support\Facades\App;
use Orchestra\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Attach Memory to ACL
|--------------------------------------------------------------------------
*/

Acl::make('kakirigi/ostreidae')->attach(App::memory());

/*
|--------------------------------------------------------------------------
| Allow Configuration to be managed via Database
|--------------------------------------------------------------------------
*/

Config::map('kakirigi/ostreidae', array(
    'default_format' => 'kakirigi/ostreidae::config.default_format',
    'default_page'   => 'kakirigi/ostreidae::config.default_page',
    'per_page'       => 'kakirigi/ostreidae::config.per_page',
    'page_permalink' => 'kakirigi/ostreidae::config.permalink.page',
    'post_permalink' => 'kakirigi/ostreidae::config.permalink.post',
));
