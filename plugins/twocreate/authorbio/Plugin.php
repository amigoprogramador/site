<?php namespace TwoCreate\AuthorBio;

use Event;
use October\Rain\Auth\Models\User as User;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'twocreate.authorbio::lang.plugin.name',
            'description' => 'twocreate.authorbio::lang.plugin.description',
            'author'      => 'František "SNIPI" Čaník',
            'icon'        => 'icon-user',
            'iconSvg'     => 'plugins/twocreate/authorbio/assets/img/plugin-icon.svg',
            'homepage'    => 'https://www.snipi.sk/october-cms/'
        ];
    }


    public function boot()
    {
        // Extend all backend form usage
                
        Event::listen('backend.form.extendFields', function($widget) {

            if (!$widget->getController() instanceof \Backend\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \Backend\Models\User) {
                return;
            }


            $widget->addTabFields([
                'user_position_name' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.biography',
                    'label'   => 'twocreate.authorbio::lang.fields.user_position_name',
                    'type'    => 'dropdown',
                    'options' => ['twocreate.authorbio::lang.roles.author','twocreate.authorbio::lang.roles.editor_in_chief','twocreate.authorbio::lang.roles.editor','twocreate.authorbio::lang.roles.colaborative','twocreate.authorbio::lang.roles.photographer'],
                    'span'  => 'full'
                ],
                'short_biography' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.biography',
                    'label'   => 'twocreate.authorbio::lang.fields.short_biography',
                    'type'    => 'textarea',
                    'size'  => 'medium'
                ],
                'biography' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.biography',
                    'label'   => 'twocreate.authorbio::lang.fields.biography',
                    'type'    => 'richeditor',
                    'size'  => 'huge'
                ],
                'facebook_link' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.social_networks',
                    'label'   => 'twocreate.authorbio::lang.fields.facebook_link',
                    'type'    => 'text',                    
                ],
                'linkedin_link' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.social_networks',
                    'label'   => 'twocreate.authorbio::lang.fields.linkedin_link',
                    'type'    => 'text',                    
                ],
                'twitter_link' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.social_networks',
                    'label'   => 'twocreate.authorbio::lang.fields.twitter_link',
                    'type'    => 'text',                    
                ],
                'instagram_link' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.social_networks',
                    'label'   => 'twocreate.authorbio::lang.fields.instagram_link',
                    'type'    => 'text',                    
                ],
                'youtube_link' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.social_networks',
                    'label'   => 'twocreate.authorbio::lang.fields.youtube_link',
                    'type'    => 'text',                    
                ],
                'primary_phone' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.contact_informations',
                    'label'   => 'twocreate.authorbio::lang.fields.primary_phone',
                    'type'    => 'text',                    
                ],
                'mobile_phone' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.contact_informations',
                    'label'   => 'twocreate.authorbio::lang.fields.mobile_phone',
                    'type'    => 'text',                    
                ],
                'skype_username' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.contact_informations',
                    'label'   => 'twocreate.authorbio::lang.fields.skype_username',
                    'type'    => 'text',                    
                ],
                'public_email' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.contact_informations',
                    'label'   => 'twocreate.authorbio::lang.fields.public_email',
                    'type'    => 'text',                    
                ],
                'private_email' => [
                    'tab'  => 'twocreate.authorbio::lang.tabs.contact_informations',
                    'label'   => 'twocreate.authorbio::lang.fields.private_email',
                    'type'    => 'text',                    
                ],


            ]);

            // Remove a Surname field
            //$widget->removeField('surname');
        });
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
