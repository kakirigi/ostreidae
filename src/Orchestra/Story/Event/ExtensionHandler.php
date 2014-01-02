<?php namespace Orchestra\Story\Event;

use Orchestra\Support\Facades\Form;
use Orchestra\Story\Facades\StoryFormat;
use Orchestra\Story\Model\Content;

class ExtensionHandler
{
    /**
     * Handle on form view.
     *
     * @param  \Illuminate\Support\Fluent       $model
     * @param  \Orchestra\Html\Form\FormBuilder $form
     * @return void
     */
    public function onFormView($model, $form)
    {
        $form->extend(function ($form) use ($model) {
            $form->fieldset('Page Management', function ($fieldset) {
                $fieldset->control('select', 'default_format', function ($control) {
                    $control->label('Default Format');
                    $control->options(StoryFormat::getParsers());
                });

                $fieldset->control('select', 'default_page', function ($control) {
                    $pages = array_merge(
                        array('_posts_' => 'Display Posts'),
                        Content::page()->publish()->lists('title', 'slug')
                    );
                    $control->label('Default Page');
                    $control->options($pages);
                });

                $fieldset->control('text', 'Page Permalink', 'page_permalink');
                $fieldset->control('text', 'Post Permalink', 'post_permalink');
            });
        });
    }
}
