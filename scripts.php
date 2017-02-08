<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 2/8/17
 * Time: 9:00 PM
 */


return [
    'enable' => function($app){
        $util = $app['db']->getUtility();

        if($util->tableExists('@jebster_money_support') === false){
            $util->createTable('@jebster_money_support', function($table){
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('time', 'datetime');
                $table->addColumn('ip', 'string', ['length' => 50, 'default' => '']);
                $table->addColumn('towards', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('amount', 'decimal');
                $table->addColumn('name', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('email', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('bank_account', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('status', 'integer', ['unsigned' => true, 'length' => 10]);

                $table->setPrimaryKey(['id']);
            });
        }
    }
];