<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 2/8/17
 * Time: 8:53 PM
 */

namespace Jebster\MoneySupport\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;

/**
 * @Entity(tableClass="@jebster_money_support")
 */
class Submission
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="datetime") */
    public $time;

    /** @Column */
    public $ip = '';

    /** @Column */
    public $towards = '';

    /** @Column(type="decimal") */
    public $amount = 0;

    /** @Column */
    public $name = '';

    /** @Column */
    public $email = '';

    /** @Column */
    public $bank_account = '';

    /** @Column(type="integer") */
    public $status = 0;

    public static function getAll(){
        return Submission::query()->where('status <> 2')->get();
    }

    public static function statuses(){
        return [
            0 => __('New'),
            1 => __('Handled'),
            2 => __('Trashed')
        ];
    }
}
