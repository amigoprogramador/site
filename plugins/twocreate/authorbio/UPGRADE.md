## Note
U can upgrade this plugin for what u need.... You can easily add new fields. U need to edit some files:

On file **Plugin.php** u need to look at line (circa) 38, started with **$widget->addTabFields**.

    $widget->addTabFields(
        [
            'field_name_on_database' => [ // need to create a migration file on updates folder
            'tab'  => 'Tab name', // tab name - u can use language definitions
            'label'   => 'Label for field', // u can use lang definition
            'type'    => 'text', // all available form types
        ],....

As u can see, **field_name_on_database** must be created with migrations file on **updates** folder, then u must create information on **version.yaml** file and then file for migration - schema update...