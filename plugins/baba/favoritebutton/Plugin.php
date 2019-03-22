<?php namespace BABA\Favoritebutton;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use Rainlab\Blog\Components\Post as PostComponent;
use Rainlab\Blog\Models\Post as PostModel;
use Session;
use Db;

class Plugin extends PluginBase
{
   /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User'];
    public $table_views = 'baba_blogviews_views';
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Favorite Button',
            'description' => 'Adds a favorite feature to your October models.',
            'author'      => 'BABA',
            'icon'        => 'icon-star'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->implement[] = 'BABA.Favoritebutton.Behaviors.Favoriteability';
        });
          PostComponent::extend(function($component) {
            if ($this->app->runningInBackend()) {
                return;
            }
            // getting slug value using logic from Cms\Classes\Controller setComponentPropertiesFromParams
            $routerParameters = $component->getController()->getRouter()->getParameters();
            $slugValue = $component->property('slug');
            $slugValueFromUrl = null;

            if (preg_match('/^\{\{([^\}]+)\}\}$/', $slugValue, $matches)) {
                $paramName = trim($matches[1]);

                if (substr($paramName, 0, 1) == ':') {
                    $routeParamName = substr($paramName, 1);
                    $slugValueFromUrl = array_key_exists($routeParamName, $routerParameters)
                        ? $routerParameters[$routeParamName]
                        : null;

                }
            }

            if (!$slugValueFromUrl)
                return;

            if (!Session::has('postsviewed')) {
                Session::put('postsviewed', []);
            }

            $post = PostModel::where('slug', $slugValueFromUrl)->first();

            if (!is_null($post) && !in_array($post->getKey(), Session::get('postsviewed'))) {
                $this->setViews($post);

                Session::push('postsviewed', $post->getKey());
            }

            return true;
        });

        PostModel::extend(function($model) {
            $model->addDynamicMethod('getViewsAttribute', function() use ($model) {
                $obj = Db::table('vdomah_blogviews_views')
                    ->where('post_id', $model->getKey());

                $out = 0;
                if ($obj->count() > 0) {
                    $out = $obj->first()->views;
                }

                return $out;
            });
        });
    }
     public function setViews($post, $views = null)
    {
        $obj = Db::table($this->table_views)
            ->where('post_id', $post->getKey());

        if ($obj->count() > 0) {
            $row = $obj->first();
            if (!$views) {
                $views = ++$row->views;
            }
            $obj->update(['views' => $views]);
        } else {
            if (!$views) {
                $views = 1;
            }
            Db::table($this->table_views)->insert([
                'post_id' => $post->getKey(),
                'views'   => $views
            ]);
        }
    }
    public function registerComponents()
    {
        return [
            '\BABA\Favoritebutton\Components\FavoriteButton' => 'favoriteButton',
            '\BABA\Favoritebutton\Components\MyFavoritePosts' => 'myFavoritePosts',
            '\BABA\Favoritebutton\Components\PostUsers' => 'postUsers'
        ];
    }
}
