<?php

namespace BABA\Favoritebutton\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;
use Auth;
use Db;
use Lang;

class FavoriteButton extends ComponentBase {

    public function componentDetails() {
        return [
            'name' => 'Favorite Button',
            'description' => 'render a favorite button'
        ];
    }

    public function defineProperties() {
        return [
            'post_id' => [
                'description' => 'post id',
                'title' => 'post_id',
                'default' => '',
                'type' => 'string',
            ],
            'model_class' => [
                'title' => 'Model Class Fullname',
                'description' => 'Model class fullname, ex "\RainLab\Blog\Models\Post" ',
                'type' => 'dropdown',
                'default' => '\RainLab\Blog\Models\Post',
                'required' => true,
            ],
        ];
    }

    public function getModel_ClassOptions() {
        return ['\RainLab\Blog\Models\Post' => 'Post'];
    }
   public function init() {
        $this->addCss('assets/favoritebutton.css');
    }
    public function onRender() {
        $this->page['isfavorited'] = 0;
        $this->page['haspost'] = 1;
        $post_id = $this->property('post_id');
        if (!empty($post_id) && is_numeric($post_id)) {
            $this->page['postId'] = $post_id;
            $model = $this->property('model_class');
            $post = $model::find($post_id);
            $this->page['post'] = $post;
            $this->page['postviews'] = $this->getViews($post);
            if (!$post) {
                throw new ApplicationException('post id not found in ' . $model);
            }
            $user = Auth::getUser();
            if ($user && $post->isFavorited($user)) {
                $this->page['isfavorited'] = 1;
            }
        }else{
            $this->page['haspost'] = 0;
        }
    }

      protected function getViews($post)
    {
        $out = 0;
        
        if(!is_null($post)) {
            $obj = Db::table('baba_blogviews_views')
                ->where('post_id', $post->getKey());

            if ($obj->count() > 0) {
                $out = $obj->first()->views;
            }
        }
        
        return $out;
    }
    
    public function onFavoritePost() {
        if (!$user = Auth::getUser()) {
            throw new ApplicationException(Lang::get(/* You must be logged in first! */'rainlab.user::lang.account.login_first'));
        }
        $this->page['haspost'] = 1;
        $post_id = post('post_id');
        $this->page['isfavorited'] = 0;
        if (!empty($post_id) && is_numeric($post_id)) {
            $this->page['postId'] = $post_id;
            $model = $this->property('model_class');
            $post = $model::find($post_id);
            $this->page['post'] = $post;
            if ($post) {
                $res = $post->toggleFavorite($user); // auth user added to favorites this post
                if ($post->isFavorited($user)) {
                    $this->page['isfavorited'] = 1;
                }
            }else{
                $this->page['haspost'] = 0;
            }
        }
    }

}
