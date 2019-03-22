<?php
$myfile = fopen('install_files/php/boot.php', 'r');
$content = fread($myfile,filesize('install_files/php/boot.php'));
fclose($myfile);
$content = str_replace("require_once 'InstallerException.php';",'require_once "install_files/php/InstallerException.php";',$content);
$content = str_replace("require_once 'InstallerRewrite.php';",'require_once "install_files/php/InstallerRewrite.php";',$content);
eval('?'.'>' . $content);