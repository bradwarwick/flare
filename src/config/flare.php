<?php

return [

    /*
    
     */
    'site_title' => 'Laravel <b>Flare</b>',

    /*
    |--------------------------------------------------------------------------
    | Admin Configuration
    |--------------------------------------------------------------------------
    |
    | 'admin_url': Admin URL Path without slashes.
    | 'admin_theme': Choose an admin theme from the following colours:
    |                'red', 'blue', 'green', 'yellow', 'black'.
    |                Flare Default is 'red'.
    |
    */
    'admin_url' => 'admin',
    'admin_theme' => 'red',

    /*
    |--------------------------------------------------------------------------
    | Administered Models
    |--------------------------------------------------------------------------
    |
    | This array of ModelAdmin class aliases allows you to define all of your
    | Flare administered Models which will be made available in the Flare
    | admin panel. Hopefully we will replace the need for these to be
    | manually defined in the future with some crazy autoloading.
    |
    */
    'modeladmins' => [
        // Base ModelAdmin: LaravelFlare\Flare\Admin\Models\ModelAdmin::class,
        // Example ModelAdmin: LaravelFlare\Flare\Admin\Models\Users\UserAdmin::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Administration Modules
    |--------------------------------------------------------------------------
    |
    | This array of Module Providers, coming soon
    |
    */
   'modules' => [

   ],

];
