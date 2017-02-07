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
        'onetime' => [
            'heading' => 'Ynskir tú heldur at lata eina eingangsgávu?',
            'description' => '<p>So kanst tú flyta upphæddina á konto 6460-4951478 fyri at stuðla, har tørvurin er størstur.</p>
<p>Ynskir tú at stuðla útbyggingini av Leguhúsinum, kanst tú flyta á konto:<br>
Bank Nordik: 6460-5345393<br>
Eik: 9181-4535164<br>
Norðoya Sparikassi: 9865-3021062<br>
Suðuroyar Sparikassi: 9870-9953931</p>'
        ],
        'repeating' => [
            'heading' => 'Sjálvvirkandi gjaldsavtala',
            'description' => '<p>Stovna eina sjálvvirkandi gjaldsavtalu ígjøgnum paypal.</p>',
            'defaultAmount' => 200,

        ],
        'paypal' => [
            'email' => 'jeggy@jebster.net',
            'to' => 'KFUM&K',
            'currency' => 'DKK',
            'short' => ''
        ]
    ],

    'routes' => [
        'money-support' => [
            'path' => '/money-support',
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
            'active' => '@money-support/submissions/*'
        ],
        'donations: settings' => [
            'label' => 'Settings',
            'parent' => 'donations',
            'url' => '@money-support/settings',
            'active' => '@money-support/settings/*'
        ]
    ],

    'widgets' => [
        'widgets/moneySupportWidget.php'
    ],

    'settings' => '@money-support/settings', // TODO: Fix this everywhere
];