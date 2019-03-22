<?php
require_once('custom_files/config.php');
function callback($buffer)
{
    // Change title and hide the Start from scratch and Start from a theme boxes from the starter.htm partial
    $buffer = (str_replace('<title>October Installation</title>', '<title>' . constant("TITLE") . '</title><style>.clean, .theme, .product-search, #attachProjectForm, .list-inline {display:none;}</style>', $buffer));

    // Change icon
    $buffer = (str_replace('<link type="image/png" href="install_files/images/october.png" rel="icon">', '<link type="image/png" href="' . constant("ICON") . '" rel="icon">', $buffer));

    // Replace logo
    $buffer = (str_replace('<link href="install_files/css/layout.css" rel="stylesheet">', '<link href="install_files/css/layout.css" rel="stylesheet"><link href="' . constant("STYLESHEET") . '?id='.date('YmdHis').'" rel="stylesheet">', $buffer));

    // Change the starter.htm partial to focus on installing projects
    $buffer = (str_replace('<p class="lead text-center">How do you want to set up your site?</p>', '<p class="lead text-center">How do you want to set up your project?</p>', $buffer));
    $buffer = (str_replace("col-md-4", "col-md-12", $buffer));
    $buffer = (str_replace("Use a project ID", "Custom installation", $buffer));
    $buffer = (str_replace("<p>If you've set up a project at the OctoberCMS website you can enter it here.</p>", "", $buffer));
    $buffer = (str_replace("<p>This option can be used to define plugins and themes manually.</p>", "", $buffer));

    $buffer = (str_replace('<h4 class="section-header">Recommended</h4>', '<h4 class="section-header">Available</h4>', $buffer));
    $buffer = (str_replace("If you have a Project for this installation, specify it below.", "You can define plugins and themes for your project.", $buffer));
    $buffer = (str_replace("<p>Instead of providing a project ID, you can define plugins and themes manually using the links above.</p>", "<p>Please define plugins and themes using the links above.</p>", $buffer));

    return $buffer;
}

// Overwrite PHP files
$myfile = fopen("install.php", "r");
$content = fread($myfile,filesize("install.php"));
fclose($myfile);
$content = str_replace("install_files/php/boot.php","custom_files/php/boot.php",$content);

ob_start("callback");
eval('?>' . $content);
ob_end_flush();
