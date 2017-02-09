<?php

use Pagekit\Application;



return [
    'name' => 'money-support',

    'main' => function(Application $app) {

    },

    'autoload' => [
        'Jebster\\MoneySupport\\' => 'src'
    ],

    'resources' => [
        'money-support:' => ''
    ],

    'config' => [
        'settings' => [
            'https' => false,
            'paypal_enabled' => false,
            'onetime' => [
                'heading' => 'You rather give a one time donation?',
                'description' => '<p>A description</p>'
            ],
            'repeating' => [
                'heading' => 'Automatic monthly payment',
                'description' => '<p>Create a automatic monthly payment through PayPal.</p>',
                'defaultAmount' => 200,
            ],
            'paypal' => [
                'email' => 'jeggy@jebster.net',
                'to' => 'to',
                'currency' => 'USD',
                'short' => '',
                'description' => ''
            ]
        ]
    ],

    'routes' => [
        '/money-support' => [
            'name' => '@money-support',
            'controller' => 'Jebster\\MoneySupport\\Controller\\MoneySupportController'
        ]
    ],

    'menu' => [
        'donations' => [
            'label' => 'Donations',
            'icon' => 'app/system/assets/images/placeholder-icon.svg',
            'url' => '@money-support/submissions',
            'active' => '@money-support/*'
        ],
        'donations: submissions' => [
            'label' => 'Submissions',
            'parent' => 'donations',
            'url' => '@money-support/submissions',
            'active' => '@money-support/submissions'
        ],
        'donations: settings' => [
            'label' => 'Settings',
            'parent' => 'donations',
            'url' => '@money-support/settings',
            'active' => '@money-support/settings'
        ]
    ],

    'widgets' => [
        'widgets/moneySupportWidget.php'
    ],

    'settings' => '@money-support/settings', // TODO: Fix this everywhere
];