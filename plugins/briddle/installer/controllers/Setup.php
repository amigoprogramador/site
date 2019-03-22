<?php namespace Briddle\Installer\Controllers;

use BackendMenu;
use System\Classes\SettingsManager;
use Request;
use Response;
use Input;
use File;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use October\Rain\Support\Facades\Flash;
use Lang;

use Briddle\Installer\Models\Settings;

class Setup extends \Backend\Classes\Controller {

    public $requiredPermissions = [
        'Installers' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Briddle.Installer', 'settings');
        $this->pageTitle = 'Setup';
    }
    
    public function index()    
    {

    }
    
    public function onSave()
    {
        // Get config
        $title = Request::input('title');
        $theme = Request::input('theme');
        $plugins = Request::input('plugins');
        $themes = Request::input('themes');
        
        Settings::set([
            'title' => $title,
            'theme' => $theme,
            'plugins' => $plugins,
            'themes' => $themes
        ]);
        
        // 1. create (sub)directories)
        if(!file_exists( public_path() . '/storage/installer')){File::makeDirectory('storage/installer');}
        if(!file_exists( public_path() . '/storage/installer/custom_files')){File::makeDirectory('storage/installer/custom_files');}
        if(!file_exists( public_path() . '/storage/installer/custom_files/css')){File::makeDirectory('storage/installer/custom_files/css');}
        if(!file_exists( public_path() . '/storage/installer/custom_files/php')){File::makeDirectory('storage/installer/custom_files/php');}
        if(!file_exists( public_path() . '/storage/installer/custom_files/images')){File::makeDirectory('storage/installer/custom_files/images');}
        
        // 2. write files
        File::put('storage/installer/custom_files/config.php', '<?php define("TITLE","' . $title . '");define("ICON","custom_files/images/icon.png");define("STYLESHEET","custom_files/css/layout.css");define("PLUGINS","' . $plugins . '");define("THEMES","' . $themes . '");');

        // 3. copy files
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/css/' . $theme . '.css','storage/installer/custom_files/css/layout.css');
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/php/boot.php','storage/installer/custom_files/php/boot.php');//base_path()
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/php/Installer.php','storage/installer/custom_files/php/Installer.php');
        File::copy('plugins/briddle/installer/downloads/installer/setup.php','storage/installer/setup.php');
        
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/images/moon.png','storage/installer/custom_files/images/moon.png');
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/images/rocket.png','storage/installer/custom_files/images/rocket.png');
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/images/icon.png','storage/installer/custom_files/images/icon.png');
        File::copy('plugins/briddle/installer/downloads/installer/custom_files/images/logo.png','storage/installer/custom_files/images/logo.png');
    }
}