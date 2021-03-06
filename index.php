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
            'towards' => 'Corp1,Corp2',
            'onetime' => [
                'heading' => 'You rather give a one time donation?',
                'description' => '<p>A description</p>'
            ],
            'repeating' => [
                'heading' => 'Automatic monthly payment',
                'description' => '<p>Create a automatic monthly payment through PayPal.</p>',
                'defaultAmount' => 200,
                'possibilities' => '20,50,100,200,500'
            ],
            'paypal' => [
                'email' => 'jeggy@jebster.net',
                'currency' => 'USD',
                'short' => '',
                'description' => ''
            ],
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
            // https://www.iconfinder.com/icons/299107/money_icon#size=128
            'icon' => 'money-support:assets/images/menu-item.svg',
            'url' => '@money-support/submissions',
            'active' => '@money-support/*',
            'access' => 'money-support: view submissions'
        ],
        'donations: submissions' => [
            'label' => 'Submissions',
            'parent' => 'donations',
            'url' => '@money-support/submissions',
            'active' => '@money-support/submissions',
            'access' => 'money-support: view submissions'
        ],
        'donations: settings' => [
            'label' => 'Settings',
            'parent' => 'donations',
            'url' => '@money-support/settings',
            'active' => '@money-support/settings',
            'access' => 'money-support: edit settings'
        ]
    ],

    'permissions' => [
        'money-support: edit settings' => [
            'title' => _('Edit settings')
        ],
        'money-support: view submissions' => [
            'title' => _('View submissions')
        ],
        'money-support: edit submissions' => [
            'title' => _('Edit submissions')
        ]
    ],

    'widgets' => [
        'widgets/moneySupportWidget.php'
    ],

    'settings' => '@money-support/settings',
];