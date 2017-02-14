<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 2/6/17
 * Time: 7:05 PM
 */

namespace Jebster\MoneySupport\Controller;

use DateTime;
use Jebster\MoneySupport\Model\Submission;
use Pagekit\Application as App;

class MoneySupportController
{
    /**
     * @Access(admin=true)
     */
    public function indexAction(){
        // TODO: pagekit bug? I need these somewhere for them to get translated in the index.php
        echo __('Donations');
        echo __('Edit settings');
        echo __('View submissions');
        echo __('Edit submissions');
        return [];
    }

    /**
     * @Route("submissions", name="submissions")
     * @Access("money-support: view submissions", admin=true)
     */
    public function submissionsAction(){
        $submissions = array_values(Submission::getAll());
        return [
            '$view' => [
                'title' => __("Submissions"),
                'name' => 'money-support:views/admin/submissions.php'
            ],
            '$data' => [
                'statuses' => Submission::statuses(),
                'submissions' => $submissions,
                'locale' => App::translator()->getLocale()
            ]
        ];
    }

    /**
     * @Route("submissions/{id}", name="submission")
     * @Access("money-support: view submissions", admin=true)
     */
    public function submissionAction($id){
        $submission = Submission::find($id);
        if($submission == null)
            App::abort(404, __('Submission not found!'));

        return [
            '$view' => [
                'title' => __('Submission'),
                'name' => 'money-support:views/admin/submission.php'
            ],
            '$data' => [
                'submission' => $submission,
                'statuses' => Submission::statuses(),
                'locale' => App::translator()->getLocale()
            ]
        ];
    }

    /**
     * @Route("update-submission", name="jebster-update-submission")
     * @Request({"submission": "array"}, csrf=true)
     * @Access("money-support: edit submissions", admin=true)
     */
    public function updateSubmissionAction($submission = null){
        $dbsub = Submission::find($submission['id']);
        if($dbsub == null) App::abort(404, __('Submission not found!'));

        $dbsub->status = $submission['status'];
        $dbsub->save($submission);

        return ['message' => 'success'];
    }

    /**
     * @Route("settings", name="settings")
     * @Access("money-support: edit settings", admin=true)
     */
    public function settingsAction(){
        $config = App::module('money-support')->config['settings'];

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

    /**
     * @Route("update-settings", name="update-settings")
     * @Request({"config": "array"}, csrf=true)
     * @Access("money-support: edit settings", admin=true)
     */
    public function updateSettingsAction($config){
        App::config('money-support')->set('settings', $config);
        return ['message' => 'success'];
    }

    /**
     * @Route("send", name="submission-send")
     * @Request({"submission":"array"}, csrf=true)
     */
    public function sendAction($submission = null){

        if($submission== null) App::abort(400, __('Failed to send, please try again later.'));
        if($submission['amount'] <= 0) App::abort(400, __("Amount can't be less than 0."));
        if(strlen($submission['name']) < 1) App::abort(400, __("Please enter your name."));
        // TODO: Validate email
        if(strlen($submission['email']) < 2) App::abort(400, __('Please enter a valid email address.'));
        if(strlen($submission['bank']) < 5 || !(strpos($submission['bank'], '-') === false || strpos($submission['bank'], ' ') === false ))
            App::abort(400, __('Please enter a valid bank account number.'));

        Submission::create([
            'name' => $submission['name'],
            'email' => $submission['email'],
            'towards' => $submission['towards'],
            'bank_account' => $submission['bank'],
            'amount' => $submission['amount'],
            'time' => new DateTime(),
            'ip' => $_SERVER['REMOTE_ADDR']
        ])->save();

        return ['message' => 'success'];
    }
}
