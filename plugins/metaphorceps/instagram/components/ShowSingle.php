<?php namespace Metaphorceps\Instagram\Components;

use Cms\Classes\ComponentBase;
use Instagram\Instagram;
use Metaphorceps\Instagram\Models\Settings;
use \Cache;
use \Carbon\Carbon;

class ShowSingle extends ComponentBase
{
    use \Metaphorceps\Instagram\Classes\MakeKeyTrait;

    public $single;

    public function componentDetails()
    {
        return [
            'name'        => 'Show Single',
            'description' => 'Show a single (public) Instagram post.'
        ];
    }

    public function defineProperties()
    {
        return [
            'url' => [
                'title'             => 'URL',
                'description'       => 'The URL of the Instagram post.',
                'type'              => 'string',
                'validationPattern' => '^(?=\s*\S).*$',
                'validationMessage' => 'The URL property is required'
            ],
            'cache' => [
                'title'             => 'Cache',
                'description'       => 'The number of minutes to cache the media.',
                'default'           => 99999,
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
            $this->single = $this->page['single'] = Cache::get($key);
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

            // Get the shortcode from the url
            $parts = explode('/p/', $this->property('url'));
            $parts = explode('/', $parts[1]);
            $shortcode = $parts[0];

            // Now get the media info
            $this->single = $this->page['single'] = $api->getMediaByShortcode($shortcode);

            // Cache it
            $expires_at = Carbon::now()->addMinutes($this->property('cache'));
            Cache::put($key, $this->single, $expires_at);
        }
    }
}