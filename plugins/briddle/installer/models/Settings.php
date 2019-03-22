<?php namespace Briddle\Installer\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'briddle_installer_settings';
    
    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}