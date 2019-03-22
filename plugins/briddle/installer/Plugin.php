<?php namespace Briddle\Installer;

use System\Classes\PluginBase;
use Illuminate\Support\Facades\Log;

use System\Classes\SettingsManager;
use Backend;
use Lang;

/**
 * Plugin
 *
 * Plugin registration
 *
 * @copyright  2018 Briddle Rich Internet Applications
 */ 
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => Lang::get('briddle.installer::lang.plugin.name'),
            'description' => Lang::get('briddle.installer::lang.plugin.description'),
            'author' => 'Briddle',
            'icon' => 'icon-cog'
        ];
    }  
    
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => Lang::get('briddle.installer::lang.plugin.name'),
                'description' => Lang::get('briddle.installer::lang.plugin.description'),
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-cog',
                'url'         => Backend::url('briddle/installer/setup'),
                'order'       => 500,
                'keywords'    => 'installer',
                'permissions' => ['briddle.installer.installers']
            ]
        ];
    }
}