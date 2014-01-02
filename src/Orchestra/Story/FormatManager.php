<?php namespace Orchestra\Story;

use Closure;
use Illuminate\Support\Manager;
use Orchestra\Support\Str;

class FormatManager extends Manager
{
    /**
     * List of available parsers.
     *
     * @var array
     */
    protected $parsers = array(
        'markdown' => 'Markdown',
    );

    /**
     * Create an instance of the plain-text driver.
     *
     * @return \Orchestra\Story\Parsers\Plain
     */
    protected function createPlainDriver()
    {
        $this->parsers['plain'] = 'Plain';

        return new Parsers\Plain($this->app);
    }

    /**
     * Create an instance of the Markdown driver.
     *
     * @return \Orchestra\Story\Parsers\Markdown
     */
    protected function createMarkdownDriver()
    {
        return new Parsers\Markdown($this->app);
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string   $name
     * @param  Closure  $callback
     * @return void
     */
    public function extend($name, Closure $callback)
    {
        $this->parsers[Str::camel($name)] = Str::title($name);

        return parent::extend($name, $callback);
    }

    /**
     * Get list of parsers.
     *
     * @return array
     */
    public function getParsers()
    {
        return $this->parsers;
    }

    /**
     * Get available parser, or use the default.
     *
     * @param  string   $name
     * @return string
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->getParsers())) {
            return $name;
        }

        return $this->getDefaultDriver();
    }

    /**
     * Create Default driver.
     *
     * @param  string   $name
     * @return string
     */
    protected function getDefaultDriver()
    {
        return $this->app['config']->get('kakirigi/ostreidae::config.default_format', 'markdown');
    }
}
