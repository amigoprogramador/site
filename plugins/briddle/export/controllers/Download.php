<?php namespace Briddle\Export\Controllers;

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

class Download extends \Backend\Classes\Controller {

    public $requiredPermissions = [
        'Export' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Briddle.Export', 'settings');
        $this->pageTitle = 'Export';
    }
    
    public function index() 
    {
        
    }
}