<?php
$view->script('moment', 'money-support:assets/js/moment-with-locales.js');
$view->script('settings', 'money-support:js/submissions.js', ['vue', 'uikit', 'moment'])
?>

<div id="submissions" class="uk-form" v-cloak>

    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>
            <h2 class="uk-margin-remove">{{ 'Submissions' | trans }}</h2>
        </div>
    </div>

    <table class="uk-table">
        <thead>
        <tr>
            <th class="pk-table-min-width-300">
                {{ 'Submission Date' | trans }}
            </th>
            <th>
                {{ 'Name' | trans }}
            </th>
            <th>
                {{ 'Email' | trans }}
            </th>
            <th class="pk-table-min-width-50" style="text-align: center;">
                {{ 'Status' | trans }}
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="submission in submissions">
                <td>
                    <a href="admin/money-support/submissions/{{submission.id}}">
                        {{ dateFormat(submission.time) }}
                    </a>
                </td>
                <td>
                    {{ submission.name }}
                </td>
                <td>
                    <a href="mailto:{{ submission.email }}">
                        {{ submission.email }}
                    </a>
                </td>
                <td style="text-align: center">
                    <span title="{{ statuses[submission.status] }}" data-uk-tooltip :class="{
                    'pk-icon-circle-warning': submission.status == 0,
                    'pk-icon-circle-success': submission.status == 1,
                    'pk-icon-circle-danger': submission.status == 2
                    }"></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
