<?php namespace Orchestra\Story\Routing;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Orchestra\Support\Facades\Facile;
use Orchestra\Story\Model\Content;

class HomeController extends Controller
{
    /**
     * Get landing page.
     *
     * @return Response
     */
    public function index()
    {
        $page = Config::get('kakirigi/ostreidae::default_page', '_posts_');

        if ($page === '_posts_') {
            return $this->showPosts();
        }

        return $this->showDefaultPage($page);
    }

    /**
     * Show posts.
     *
     * @return Response
     */
    public function showPosts()
    {
        $perPage = Config::get('kakirigi/ostreidae::per_page', 10);
        $posts   = Content::post()->latestPublish()->paginate($perPage);

        return Facile::view('kakirigi/ostreidae::posts')->with(array('posts' => $posts))->render();
    }

    /**
     * Show default page.
     *
     * @param  string   $slug
     * @return Response
     */
    protected function showDefaultPage($slug)
    {
        $page = Content::page()->publish()->where('slug', '=', $slug)->firstOrFail();
        $slug = preg_replace('/^_page_\//', '', $slug);

        if (! View::exists($view = "kakirigi/ostreidae::pages.{$slug}")) {
            $view = 'kakirigi/ostreidae::page';
        }

        return Facile::view($view)->with(array('page' => $page))->render();
    }
}
