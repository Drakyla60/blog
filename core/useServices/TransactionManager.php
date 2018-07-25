<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/25/2018
 * Time: 8:37 PM
 */

namespace core\useServices;

use Exception;
use Yii;
/**
 * Class TransactionManager
 * @package core\useServices
 */
class TransactionManager
{
    /**
     * @param callable $function
     * @throws \Throwable
     */
    public function wrap(callable $function): void
    {
        $tr = Yii::$app->db->beginTransaction();
        try {
            $function();
            $tr->commit();
        } catch (Exception $exception) {
            $tr->rollBack();
            throw $exception;
        }

        //Yii::$app->db->transaction($function);
    }
}