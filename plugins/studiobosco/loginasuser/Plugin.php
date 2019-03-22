<?php namespace StudioBosco\LoginAsUser;

use Backend;
use System\Classes\PluginBase;
use StudioBosco\LoginAsUser\Classes\UserExtender;

/**
 * LoginAsUser Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Login As User',
            'description' => 'Logs you in as a certain frontend user.',
            'author'      => 'Studio Bosco',
            'icon'        => 'icon-user',
            'homepage'    => 'https://github.com/studiobosco/octobercms-loginasuser'
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
        UserExtender::boot();
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'studiobosco.loginasuser.login' => [
                'tab'   => 'rainlab.user::lang.plugin.tab',
                'label' => 'studiobosco.loginasuser::lang.plugin.login',
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'loginasuser' => [
                'label'       => 'LoginAsUser',
                'url'         => Backend::url('studiobosco/loginasuser/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['studiobosco.loginasuser.*'],
                'order'       => 500,
            ]
        ];
    }
}
