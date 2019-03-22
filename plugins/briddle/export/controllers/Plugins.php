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

class Plugins extends \Backend\Classes\Controller {

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
        $path = 'plugins'; //storage_path(sprintf('plugins/%s', $directory));  
        $filename = sprintf('%s.zip', 'backup_plugins_' . date('Y-m-d'));  
        $zip = new ZipArchive;  
        if ($zip->open('storage/' . $filename, ZipArchive::CREATE) === TRUE)
        {
            $files = new RecursiveIteratorIterator(  
                new RecursiveDirectoryIterator($path),  
                RecursiveIteratorIterator::LEAVES_ONLY  
            );  
            foreach ($files as $name => $file) 
            {  
                if (! $file->isDir()) 
                {  
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($path) + 1);
                    $zip->addFile($filePath, $relativePath);  
                }  
            }  
            if($zip->close() === TRUE)
            {
                return response()->download('storage/' . $filename)->deleteFileAfterSend(true);    
            } 
            else
            {
                Flash::error(Lang::get('briddle.backup::lang.plugin.error'));
            }
        }
        else
        {
            Flash::error(Lang::get('briddle.backup::lang.plugin.error'));
        }
    }
}