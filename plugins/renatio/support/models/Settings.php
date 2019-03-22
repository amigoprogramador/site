<?php

namespace Renatio\Support\Models;

use Backend\Models\User;
use Model;
use Config;

/**
 * Class Settings
 * @package Renatio\Support\Models
 */
class Settings extends Model
{

    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string
     */
    public $settingsCode = 'renatio_support_settings';

    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    /**
     * @inheritdoc
     */
    public function initSettingsData()
    {
        foreach ($this->getDefaultSettings() as $key => $setting) {
            $this->{$key} = $setting;
        }
    }

    /**
     * @return array
     */
    private function getDefaultSettings()
    {
        $admin = User::first();

        if ($admin) {
            return [
                'support_team' => [
                    [
                        'name'  => $admin->full_name,
                        'email' => $admin->email
                    ]
                ]
            ];
        }

        return [];
    }

}
