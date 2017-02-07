<?php
$view->script('settings', 'money-support:js/settings.js', ['vue', 'uikit', 'editor'])
?>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">
            <div class="uk-panel">
                <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                    <li class="uk-active"><a>
                        <i class="pk-icon-large-settings uk-margin-right"></i>
                        {{ 'Repeating donations' | trans }}
                    </a></li>
                    <li><a>
                        <i class="pk-icon-large-settings uk-margin-right"></i>
                        {{ 'One time donation' | trans }}
                    </a></li>
                    <li><a>
                        <img class="uk-margin-right" style="height:25px; width: 25px;"
                             src="<?= $view->url()->getStatic('money-support:assets/images/paypal.png') ?>" />
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

                </li>
            </ul>
        </div>

    </div>
</div>