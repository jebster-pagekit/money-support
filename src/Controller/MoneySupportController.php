<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 2/6/17
 * Time: 7:05 PM
 */

namespace Jebster\MoneySupport\Controller;

use Pagekit\Application as App;

class MoneySupportController
{
    /**
     * @Access(admin=true)
     */
    public function indexAction(){
        return [];
    }

    /**
     * @Route("submissions", name="submissions")
     * @Access(admin=true)
     */
    public function submissionsAction(){
        return [
            '$view' => [
                'title' => __("Submissions"),
                'name' => 'money-support:views/admin/submissions.php'
            ],
            '$data' => [
                'config' => []
            ]
        ];
    }

    /**
     * @Route("money-support/settings", name="settings")
     * @Access(admin=true)
     */
    public function settingsAction(){
        $config = App::module('money-support')->config;

        return [
            '$view' => [
                'title' => __("Money Support Settings"),
                'name' => 'money-support:views/admin/settings.php'
            ],
            '$data' => [
                'config' => $config
            ]
        ];
    }

}
