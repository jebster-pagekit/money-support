<?php
$view->script('bootstrap-validator', 'https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js');
$paypal = $data['paypal'];
?>

<style>
    .tab-content .tab-pane{
        border: 1px solid #ddd;
        /*border-top: none;*/
        border-radius: 0 0 2px 2px;
        /*padding: 5px;*/
        text-align: center;
    }
    .nav-tabs > li, .nav-pills > li {
        float:none;
        display:inline-block;
        *display:inline; /* ie7 fix */
        zoom:1; /* hasLayout ie7 trigger */
    }

    .nav-tabs, .nav-pills {
        text-align:center;
    }

    .paypal-form .form-group input{

    }
</style>

<br>
<div id="moneysupport">
    <ul class="nav nav-tabs">
        <li class="nav active"><a href="#repeating" data-toggle="tab">
                <?= __('Repeating donation') ?>
            </a></li>
        <li class="nav"><a href="#once" data-toggle="tab">
                <?= __('One time donation') ?>
            </a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="repeating">
            <h1><?= $paypal['repeating']['heading'] ?></h1>
            <p><?= $paypal['repeating']['description'] ?></p>
            <form class="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" data-toggle="validator" role="form">
                <input type="hidden" name="business" value="<?= $paypal['email'] ?>">
                <input type="hidden" name="cmd" value="_xclick-subscriptions">
                <input type="hidden" name="item_name" value="<?= $paypal['to'] ?>">
                <input type="hidden" name="currency_code" value="<?= $paypal['currency'] ?>">
                <input type="hidden" name="p3" value="1">
                <input type="hidden" name="t3" value="M">
                <input type="hidden" name="src" value="1">

                <div class="form-group">
                    <label class="control-label" for="inputName">
                        <?= __('Amount') ?>
                    </label>
                    <input type="number" id="inputName" class="form-control" name="a3" size="21"
                           value="<?= $paypal['repeating']['defaultAmount'] ?>" data-minlength="1" min="1" required
                           data-error="<?= __('Donation can\'t be less than 1.') ?>" placeholder="<?= __('Name') ?>" />
                    <div class="help-block with-errors"></div>
                </div>
                <br>
                <input class="btn btn-danger" type="submit" name="submit" value="<?= __('Create monthly payment') ?>">
                <br><br>
            </form>
        </div>

        <div class="tab-pane fade" id="once">
            <h1><?= $paypal['onetime']['heading'] ?></h1>
            <div>
                <?= $paypal['onetime']['description'] ?>
            </div>
            <br>
            <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="business" value="<?= $paypal['email'] ?>">

                <input type="hidden" name="cmd" value="_donations">
                <input type="hidden" name="item_name" value="<?= $paypal['to'] ?>">
                <input type="hidden" name="item_number" value="<?= $paypal['onetime']['short'] ?>">
                <input type="hidden" name="currency_code" value="<?= $paypal['currency'] ?>">

                <!-- Display the payment button. -->
                <input type="submit" class="btn btn-danger" name="submit" value="<?= __('Or donate via PayPal') ?>" alt="Donate">

            </form>

            </p>
        </div>
    </div>
</div>

