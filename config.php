<?php

return [
    'layout'              => 'layout::admin',
    'menu_admin'          => 'demo::menu',
    'menu_admin_position' => 5,

    // Public navbar (layout::frontend): the demo is open to everyone.
    'menu_frontend'          => 'demo::frontend_menu',
    'menu_frontend_position' => 5,

    // Show the "re-populate" link on the demo home. Turn it off on a shared
    // public demo: one visitor would wipe what another is trying.
    'repopulate' => env('DEMO_REPOPULATE', true),
];
