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

class Download extends \Backend\Classes\Controller {

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
        //return response()->download('plugins/briddle/installer/downloads/installer.zip')->deleteFileAfterSend(false); 
          
        $path = realpath('storage/installer'); //storage/installer  
        $filename = sprintf('%s.zip', 'installer_' . date('Y-m-d'));  
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
                    $relativePath = substr($filePath, strlen($path) + 1);//die(storage_path('storage/installer'));
                    $zip->addFile($filePath, $relativePath);  
                }  
            }  
            if($zip->close() === TRUE)
            {
                return response()->download('storage/' . $filename)->deleteFileAfterSend(true);    
            } 
            else
            {
                Flash::error(Lang::get('briddle.installer::lang.plugin.error'));
            }
        }
        else
        {
            Flash::error(Lang::get('briddle.installer::lang.plugin.error'));
        }        
    }
}