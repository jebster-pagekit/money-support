<?php
use Pagekit\Application as App;

return [
    'name' => 'jebster/moneySupportWidget',

    'label' => 'Money Support',

    'render' => function ($widget) use ($app) {
        $data = [
            'paypal' => [
                'email' => 'jeggy@jebster.net',
                'to' => 'KFUM&K',
                'currency' => 'DKK',
                'onetime' => [
                    'heading' => 'Ynskir tú heldur at lata eina eingangsgávu?',
                    'description' => '<p>So kanst tú flyta upphæddina á konto 6460-4951478 fyri at stuðla, har tørvurin er størstur.</p>
                                        <p>Ynskir tú at stuðla útbyggingini av Leguhúsinum, kanst tú flyta á konto:<br>
                                        Bank Nordik: 6460-5345393<br>
                                        Eik: 9181-4535164<br>
                                        Norðoya Sparikassi: 9865-3021062<br>
                                        Suðuroyar Sparikassi: 9870-9953931</p>',
                    'short' => 'test1',
                ],
                'repeating' => [
                    'heading' => 'Sjálvvirkandi gjaldsavtala',
                    'description' => '<p>Stovna eina sjálvvirkandi gjaldsavtalu ígjøgnum paypal.</p>',
                    'defaultAmount' => 200,
                ]
            ]
        ];

        return $app->view('money-support/widget/moneySupport.php', compact('data'));
    }
];