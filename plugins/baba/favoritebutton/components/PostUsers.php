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

class PostUsers extends ComponentBase {

    /**
     * Reference to the page name for linking to posts.
     * @var string
     */
    public $postPage;

    public function componentDetails() {
        return [
            'name' => 'Post Users',
            'description' => ''
        ];
    }

    public function defineProperties() {
        return [
            'post_id' => [
                'title' => 'Post Id',
                'description' => '',
                'type' => 'number',
            ],
        ];
    }

    public function getPostIdOptions() {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function init() {
        $this->addCss('assets/favoritebutton.css');
        $this->addJs('assets/jquery.easyPaginate.js');
        $this->addJs('assets/myfavoriteposts.js');
    }

    public $posts = [];

    public function onRender() {
        //dd($this->property('post_id'));
        $users = \RainLab\User\Models\User::join('baba_favorites_favorites as ff', function($join){
            $join->on('users.id','=','ff.user_id');
        })->where('ff.favoriteable_id', $this->property('post_id'))
                ->where('favoriteable_type', \RainLab\Blog\Models\Post::class)->get();
//        dd($users);
        $this->page['users'] = $users;
    }

    public function onRun() {
    }

}
