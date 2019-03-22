<?php return [
    'plugin' => [
        'name' => 'Google Tag Manager',
        'description' => 'Add Google Tag Manager code to your page.',
    ],

    'components' => [
        'tagmanager' => [
            'name'                      => 'Google Tag Manager code',
            'description'               => 'Add Google Tag Manager code to your page',
            'container_id'              => 'Container ID',
            'container_id_desc'         => 'Google Tag Manager Public Container ID',
            'container_id_val_message'  => 'Not a Google Tag Manager code'
        ]
    ],

    'settings'    => [
        'container_id' => [
            'label' => 'Container ID',
            'commentAbove' => 'You can find it on the Google Tag Manager Accounts page',
            'description' => 'Google Tag Manager Container ID'
        ]
    ]
];