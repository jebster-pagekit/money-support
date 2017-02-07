<?php
use Pagekit\Application as App;

return [
    'name' => 'jebster/moneySupportWidget',

    'label' => 'Money Support',

    'render' => function ($widget) use ($app) {
        // https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/html_example_donate/#basic-donate-button

        $data = App::module('money-support')->config;

        return $app->view('money-support/widget/moneySupport.php', compact('data'));
    }
];