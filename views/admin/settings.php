<?php
$view->script('settings', 'money-support:js/settings.js', ['vue', 'uikit', 'editor']);
$view->style('font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
?>

<style>
    .fa{
        font-size: 26px;
        text-align: center;
        width: 25px;
        height: 25px;
    }
</style>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">
            <div class="uk-panel">
                <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                    <li class="uk-active"><a>
                        <i class="pk-icon-large-settings uk-margin-right"></i>
                        {{ 'General' | trans }}
                    </a></li>
                    <li><a>
                        <i class="fa fa-list-alt uk-margin-right" aria-hidden="true"></i>
                        {{ 'Repeating donations' | trans }}
                    </a></li>
                    <li><a>
                        <i class="fa fa-list-alt uk-margin-right" aria-hidden="true"></i>
                        {{ 'One time donation' | trans }}
                    </a></li>
                    <li v-show="config.paypal_enabled"><a>
                        <i class="fa fa-cc-paypal uk-margin-right" aria-hidden="true"></i>
                        PayPal
                    </a></li>
                </ul>
            </div>
        </div>

        <div class="pk-width-content">
            <ul id="tab-content" class="uk-switcher uk-margin">
                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'General' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Security' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <label class="uk-form-controls-condensed" for="input-https">
                                <input id="input-https" type="checkbox" v-model="config.https" class="uk-form-width-large">
                                {{ 'Force HTTPS' | trans }}
                            </label>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">PayPal</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <label class="uk-form-controls-condensed" for="input-paypal-enabled">
                                <input id="input-paypal-enabled" type="checkbox" v-model="config.paypal_enabled" class="uk-form-width-large">
                                {{ 'Enable PayPal' | trans }}
                            </label>
                        </div>
                    </div>

                </li>
                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'Repeating donation settings' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Header' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="config.repeating.heading" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Towards' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="config.towards" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Amounts' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="config.repeating.possibilities" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Default amount' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="number" v-model="config.repeating.defaultAmount" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Description' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <v-editor id="form-description" :value.sync="config.repeating.description" :options="{markdown : post.data.markdown}"></v-editor>
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">{{ 'One time donation settings' | trans }}</h2>
                        </div>

                        <div data-uk-margin>
                            <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Header' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="config.onetime.heading" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Description' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <v-editor id="form-description" :value.sync="config.onetime.description" :options="{markdown : post.data.markdown}"></v-editor>
<!--                                <input type="text" v-model="config.onetime.description" class="uk-form-width-large">-->
                            </p>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                        <div data-uk-margin>
                            <h2 class="uk-margin-remove">PayPal</h2>
                        </div>

                        <div data-uk-margin>
                            <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Email' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="email" v-model="paypal.email" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'To' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="paypal.to" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Currency' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="paypal.currency" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Short description' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <input type="text" v-model="paypal.short" placeholder="{{ 'Short text shown on PayPal site' | trans }}" class="uk-form-width-large">
                            </p>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">{{ 'Description' | trans }}</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <p class="uk-form-controls-condensed">
                                <v-editor id="form-description" :value.sync="config.paypal.description" :options="{markdown : post.data.markdown}"></v-editor>
                            </p>
                        </div>
                    </div>

                </li>
            </ul>
        </div>

    </div>
</div>