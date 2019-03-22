<?php namespace Briddle\Export;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name' => 'Export',
            'description' => 'Download your plugins and themes',
            'author' => 'Briddle',
            'icon' => 'icon-download'
        ];
    }    
    
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Export',
                'description' => 'Download your plugins and themes',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-download',
                'url'         => Backend::url('briddle/export/download'),
                'order'       => 500,
                'keywords'    => 'export',
                'permissions' => ['briddle.export.export']
            ]
        ];
    }
    
    public function registerSchedule($schedule)
    {
 //       $schedule->command('cache:clear')->daily();
 //       $schedule->call(function () {
 //           \Db::table('recent_users')->delete();
 //       })->daily();
 
 //       $schedule->exec('')->cron('* * * * *');
    }    
    
}
