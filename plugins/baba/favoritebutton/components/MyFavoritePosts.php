<?php

namespace BABA\Favoritebutton\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;
use Auth;
use Lang;
use Redirect;
use BackendAuth;
use Cms\Classes\Page;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Blog\Models\Category as BlogCategory;

class MyFavoritePosts extends ComponentBase {

    /**
     * Reference to the page name for linking to posts.
     * @var string
     */
    public $postPage;

    public function componentDetails() {
        return [
            'name' => 'My Favorite Post List',
            'description' => ''
        ];
    }

    public function defineProperties() {
        return [
            'postPage' => [
                'title' => 'rainlab.blog::lang.settings.posts_post',
                'description' => 'rainlab.blog::lang.settings.posts_post_description',
                'type' => 'dropdown',
                'default' => 'blog/post',
                'group' => 'Links',
            ],
        ];
    }

    public function getPostPageOptions() {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function init() {
        $this->addComponent('RainLab\User\Components\Account', '_account', []);
        $this->addCss('assets/favoritebutton.css');
        $this->addJs('assets/jquery.easyPaginate.js');
        $this->addJs('assets/myfavoriteposts.js');
    }

    public $posts = [];

    public function onRender() {
        $this->page['favoritedposts'] = [];
        if ($user = Auth::getUser()) {
            $list = $user->favoritesOf(\RainLab\Blog\Models\Post::class);
            $list->each(function($favo) {
                $post = $favo->favoriteable;
                if($post){
                    $params = [
                        'id' => $post->id,
                        'slug' => $post->slug,
                    ];
                    //expose published year, month and day as URL parameters
                    if ($post->published) {
                        $params['year'] = $post->published_at->format('Y');
                        $params['month'] = $post->published_at->format('m');
                        $params['day'] = $post->published_at->format('d');
                    }
                    $url = $this->controller->pageUrl($this->postPage, $params);
                    $obj = new \stdClass();
                    $obj->url = $url;
                    $obj->title = $post->title;
                    $this->posts[] = $obj;
                }
            });
            $this->page['posts'] = $this->posts;
            $this->page['favolist'] = $list;
        }
    }

    public function onRun() {
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
    }

}
