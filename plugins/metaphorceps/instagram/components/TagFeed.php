<?php namespace Metaphorceps\Instagram\Components;

use Cms\Classes\ComponentBase;
use Instagram\Instagram;
use Metaphorceps\Instagram\Models\Settings;
use \Cache;
use \Carbon\Carbon;

class TagFeed extends ComponentBase
{
    use \Metaphorceps\Instagram\Classes\MakeKeyTrait;

    public $media;

    public function componentDetails()
    {
        return [
            'name'        => 'Tag Feed',
            'description' => 'Instagram media based on a specified tag.'
        ];
    }

    public function defineProperties()
    {
        return [
            'tag' => [
                'title'             => 'Tag',
                'description'       => 'The tag on which to retrieve media.',
                'type'              => 'string',
                'validationPattern' => '^(?=\s*\S).*$',
                'validationMessage' => 'The Tag property is required'
            ],
            'limit' => [
                'title'             => 'Limit',
                'description'       => 'The number of media to be displayed (20 maximum).',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The Limit property should be numeric'
            ],
            'cache' => [
                'title'             => 'Cache',
                'description'       => 'The number of minutes to cache the media.',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The Cache property should be numeric'
            ]
        ];
    }

    public function onRun()
    {
        $key = $this->makeKey();

        if (Cache::has($key))
        {
            $this->media = $this->page['media'] = Cache::get($key);
        }
        else
        {
            $settings = Settings::instance();
            $api = new Instagram();
            $api->setClientID($settings->client_id);

            if ($settings->access_token)
            {
                $api->setAccessToken($settings->access_token);
            }

            $this->media = $this->page['media'] = $api->getTagMedia($this->property('tag'), array('count' => $this->property('limit', 10)));

            $expires_at = Carbon::now()->addMinutes($this->property('cache'));
            Cache::put($key, $this->media, $expires_at);
        }
    }
}