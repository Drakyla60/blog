<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 8/2/2018
 * Time: 5:18 PM
 */

namespace core\helpers;

use core\entities\Blog\Post\Post;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class PostHelper
 * @package core\helpers
 */
class PostHelper
{
    /**
     * @return array
     */
    public static function statusList(): array
    {
        return [
            Post::STATUS_DRAFT => 'Draft',
            Post::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case Post::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Post::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}