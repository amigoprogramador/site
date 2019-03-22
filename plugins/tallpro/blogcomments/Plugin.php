<?php namespace Tallpro\BlogComments;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public $require = ['RainLab.Blog', 'RainLab.User'];


    public function pluginDetails()
    {
        return [
            'name'        => 'tallpro.blogcomments::lang.plugin.name',
            'description' => 'tallpro.blogcomments::lang.plugin.description',
            'author'      => 'TallPro',
            'icon'        => 'icon-paper'
        ];
    }

    public function registerComponents()
    {
        return [
            'Tallpro\BlogComments\Components\Comments' => 'comments',
        ];
    }

    public function registerSettings()
    {
        return [
            'config' => [
                'label'       => 'Comments',
                'icon'        => 'icon-comments-o',
                'description' => 'Manage Settings.',
                'class'       => 'Tallpro\BlogComments\Models\Settings',
                'order'       => 60
            ]
        ];
    }
}
