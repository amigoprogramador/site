<?php namespace AlekseyP\GoogleTagManager;

use System\Classes\PluginBase;

/**
 * Class Plugin
 * @package AlekseyP\GoogleTagManager
 */
class Plugin extends PluginBase
{

    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'alekseyp.googletagmanager::lang.plugin.name',
            'description' => 'alekseyp.googletagmanager::lang.plugin.description',
            'author' => 'AlekseyP',
            'icon' => 'oc-icon-google',
            'homepage' => 'https://github.com/alekseyp/octobercms-googletagmanager'
        ];
    }

    /**
     * @return array
     */
    public function registerComponents()
    {
        return [
            'AlekseyP\GoogleTagManager\Components\TagManager' => 'gtmCode'
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'config' => [
                'label' => 'alekseyp.googletagmanager::lang.plugin.name',
                'icon' => 'oc-icon-google',
                'description' => 'alekseyp.googletagmanager::lang.settings.container_id.description',
                'class' => 'AlekseyP\GoogleTagManager\Models\Settings',
                'permissions' => ['aleksey.googletagmanager.settings'],
                'order' => 600
            ]
        ];
    }
}
