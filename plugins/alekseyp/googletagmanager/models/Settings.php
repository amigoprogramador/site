<?php namespace AlekseyP\GoogleTagManager\Models;

use October\Rain\Database\Model;

/**
 * Class Settings
 * @package AlekseyP\GoogleTagManager\Models
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
    public $settingsCode = 'alekseyp_googletagmanager_settings';

    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';
}