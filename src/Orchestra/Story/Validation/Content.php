<?php namespace Orchestra\Story\Validation;

use Orchestra\Support\Validator;

class Content extends Validator
{
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = array(
        'title'   => array('required'),
        'slug'    => array('required', 'not_in:rss,posts'),
        'content' => array('required'),
    );

    /**
     * On create scenario
     *
     * @return void
     */
    protected function onCreate()
    {
        $this->rules['slug'] = array('required', 'not_in:rss,posts', 'unique:story_contents,slug');
    }

    /**
     * On update scenario.
     *
     * @return void
     */
    protected function onUpdate()
    {
        $this->rules['slug'] = array('required', 'not_in:rss,posts', 'unique:story_contents,slug,{id}');
    }
}
