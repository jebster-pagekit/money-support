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

    'routes' => [
        '@money-support' => [
            'path' => '/money-support',
            'controller' => 'Jebster\\MoneySupport\\Controller\\MoneySupportController'
        ]
    ],

    'widgets' => [
        'widgets/moneySupportWidget.php'
    ],

    'settings' => '@money-support',
];