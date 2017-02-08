<?php
$view->script('moment', 'money-support:assets/js/moment-with-locales.js');
$view->script('submission', 'money-support:js/submission.js', ['vue', 'uikit', 'moment'])
?>

<div id="submission" class="uk-form" v-cloak>
    <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>
        <div class="pk-width-content">
            <h2 class="uk-margin-top-remove">{{ 'Submission' | trans }}</h2>
            <dl class="uk-margin-top-remove uk-description-list-horizontal">
                <dt>
                    {{ 'Date' | trans }}:
                </dt>
                <dd>
                    {{ dateFormat(submission.time) }}
                </dd>
                <dt>
                    {{ 'Amount' | trans }}:
                </dt>
                <dd>
                    {{ moneyFormat(submission.amount) }}
                </dd>
                <hr>
                <dt>
                    {{ 'Name' | trans }}:
                </dt>
                <dd>
                    {{ submission.name }}
                </dd>
                <dt>
                    {{ 'Email' | trans }}:
                </dt>
                <dd>
                    {{ submission.email }}
                </dd>
                <dt>
                    {{ 'Bank Account' | trans }}:
                </dt>
                <dd>
                    {{ submission.bank_account }}
                </dd>
            </dl>

        </div>
        <div class="pk-width-sidebar">
            <div class="uk-form-row">
                <label for="form-status" class="uk-form-label">{{ 'Status' | trans }}:</label>
                <div class="uk-form-controls">
                    <select id="form-status" class="uk-width-1-1" v-model="submission.status" number>
                        <option v-for="option in statuses.length" :value="option">
                            {{ statuses[option] }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
