<?php
$paypal = $data['paypal'];

$js = "defaultAmount = ".$data['repeating']['defaultAmount'].";";
$js .= "amountPossibilities = '".$data['repeating']['possibilities']."';";
$js .= "towards = '".$data['towards']."';";

if($data['https'] && !isset($_SERVER['HTTPS'])){
    $js .= "location.href = 'https:' + window.location.href.substring(window.location.protocol.length);";
}
echo "<script>$js</script>";

$view->script('moneySupport', 'money-support:js/widget.js', ['vue']);





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
    @media(min-width: 768px){
    .form-group .form-control{
        width: 50%;
        margin: 0 auto;
        float: none;
    }}
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
            <h1><?= $data['repeating']['heading'] ?></h1>
            <p><?= $data['repeating']['description'] ?></p>

            <form v-on:submit.prevent>
                <div class="form-group">
                    <label class="control-label" for="form-amountDrop">
                        {{ 'Amount' | trans }}
                    </label>
                    <select id="form-amountDrop" class="form-control" v-model="selectedAmount" v-on:change="onChange">
                        <option v-for="option in moneyOptions">
                            {{ option }}
                        </option>
                    </select>
                </div>
                <div class="form-group" v-show="otherAmount">
                    <input type="number" class="form-control" v-model="form.amount">
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-towards">
                        {{ 'Give to' | trans }}
                    </label>
                    <select id="form-towards" class="form-control" v-model="form.towards">
                        <option v-for="option in towardOptions">
                             {{ option }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-name">
                        {{ 'Name' | trans }}
                    </label>
                    <input type="text" id="form-name" class="form-control"
                           v-model="form.name" required />
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-email">
                        {{ 'Email' | trans }}
                    </label>
                    <input type="email" id="form-email" class="form-control col-centered"
                           v-model="form.email" required />
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-bank">
                        {{ 'Bank account number' | trans }}
                    </label>
                    <input type="text" id="form-bank" class="form-control"
                           v-model="form.bank" placeholder="9181-1234567" required />
                </div>
                <p>
                    {{ message.text }}
                </p>
                <button class="btn btn-danger" @click="send">{{ 'Create monthly payment' | trans }}</button>

            </form>
            <?php if($data['paypal_enabled']): ?>
                <hr><p><?= $paypal['description'] ?></p>
                <form class="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" data-toggle="validator" role="form">
                    <input type="hidden" name="business" value="<?= $paypal['email'] ?>">
                    <input type="hidden" name="cmd" value="_xclick-subscriptions">
                    <input type="hidden" name="item_name" value="<?= $paypal['to'] ?>">
                    <input type="hidden" name="currency_code" value="<?= $paypal['currency'] ?>">
                    <input type="hidden" name="p3" value="1">
                    <input type="hidden" name="t3" value="M">
                    <input type="hidden" name="src" value="1">
                    <input type="hidden" name="a3" v-model="form.amount">

                    <input @prevent="send" class="btn btn-danger" type="submit" name="submit" value="<?= __('Create monthly payment via PayPal') ?>">
                    <br><br>
                </form>
            <?php else: echo '<br>'; endif; ?>
        </div>

        <div class="tab-pane fade" id="once">
            <h1><?= $data['onetime']['heading'] ?></h1>
            <div>
                <?= $data['onetime']['description'] ?>
            </div>

            <?php if($data['paypal_enabled']): ?>
                <br><p>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="business" value="<?= $paypal['email'] ?>">

                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="item_name" value="<?= $paypal['to'] ?>">
                    <input type="hidden" name="item_number" value="<?= $paypal['short'] ?>">
                    <input type="hidden" name="currency_code" value="<?= $paypal['currency'] ?>">

                    <input type="submit" class="btn btn-danger" name="submit" value="<?= __('Or donate via PayPal') ?>" alt="Donate">
                </form>
                </p>
            <?php endif; ?>
        </div>
        <br>
    </div>
    <br>
</div>

