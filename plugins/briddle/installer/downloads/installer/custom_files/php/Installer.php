<?php
$myfile = fopen('install_files/php/Installer.php', 'r');
$content = fread($myfile,filesize('install_files/php/Installer.php'));
fclose($myfile);
$content = str_replace("return $"."this->requestServerData('plugin/popular');",'$plugins = array();$custom_plugins = explode(",",constant("PLUGINS"));foreach($custom_plugins as $plugin){$plugins[] = $this->requestServerData("plugin/detail", array("name" => $plugin));}return $plugins;',$content);
$content = str_replace("return $"."this->requestServerData('theme/popular');",'$themes = array();$custom_themes = explode(",",constant("THEMES"));foreach($custom_themes as $theme){$themes[] = $this->requestServerData("theme/detail", array("name" => $theme));}return $themes;',$content);
eval('?'.'>' . $content);
