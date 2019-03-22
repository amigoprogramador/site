<?php namespace Metaphorceps\Instagram;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Instagram Toolkit',
            'description' => 'Provides integration with Instagram.',
            'author'      => 'Kyle McLuckie',
            'icon'        => 'icon-instagram'
        ];
    }

    public function registerComponents()
    {
        return [
            'Metaphorceps\Instagram\Components\TagFeed' => 'tagFeed',
            'Metaphorceps\Instagram\Components\UserFeed' => 'userFeed',
            'Metaphorceps\Instagram\Components\ShowSingle' => 'showSingle',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Instagram',
                'icon'        => 'icon-instagram',
                'description' => 'Configure Instagram authentication parameters.',
                'class'       => 'Metaphorceps\Instagram\Models\Settings',
                'order'       => 211
            ]
        ];
    }
}