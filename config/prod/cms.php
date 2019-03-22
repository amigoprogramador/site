<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Bleeding edge updates
    |--------------------------------------------------------------------------
    |
    | If you are developing with October, it is important to have the latest
    | code base. Set this value to 'true' to tell the platform to download
    | and use the development copies of core files and plugins.
    |
    */

    'edgeUpdates' => false,


    /*
    |--------------------------------------------------------------------------
    | Back-end login remember
    |--------------------------------------------------------------------------
    |
    | Define live duration of backend sessions :
    |
    | true  - session never expire (cookie expiration in 5 years)
    |
    | false - session have a limited time (see session.lifetime)
    |
    | null  - The form login display a checkbox that allow user to choose
    |         wanted behavior
    |
    */

    'backendForceRemember' => null,

    /*
    |--------------------------------------------------------------------------
    | Back-end timezone
    |--------------------------------------------------------------------------
    |
    | This acts as the default setting for a back-end user's timezone. This can
    | be changed by the user at any time using the backend preferences. All
    | dates displayed in the back-end will be converted to this timezone.
    |
    */

    'backendTimezone' => 'UTC-3',

    /*
    |--------------------------------------------------------------------------
    | Prevents application updates
    |--------------------------------------------------------------------------
    |
    | If using composer or git to download updates to the core files, set this
    | value to 'true' to prevent the update gateway from trying to download
    | these files again as part of the application update process. Plugins
    | and themes will still be downloaded.
    |
    */

    'disableCoreUpdates' => true,

    /*
    |--------------------------------------------------------------------------
    | Specific plugins to disable
    |--------------------------------------------------------------------------
    |
    | Specify plugin codes which will always be disabled in the application.
    |
    */

];
