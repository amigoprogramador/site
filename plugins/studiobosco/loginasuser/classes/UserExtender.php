<?php namespace StudioBosco\LoginAsUser\Classes;

use Event;
use BackendAuth;
use Lang;

class UserExtender
{
    public static function boot()
    {
        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {
            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\User\Models\User) {
                return;
            }

            $user = BackendAuth::getUser();

            if (!$user->hasAccess('studiobosco.loginasuser::loginAsUser')) {
                return;
            }

            $widget->addFields([
                'loginAsUser' => [
                    'type' => 'partial',
                    'path' => '$/studiobosco/loginasuser/partials/_widget.htm',
                    'tab' => 'rainlab.user::lang.user.account',
                ]
            ]);
        });
    }
}
