<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 6:58 PM
 */
namespace core\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class SlugValidator
 * @package shop\validators
 */
class SlugValidator extends RegularExpressionValidator
{
    /**
     * @var string
     */
    public $pattern = '#^[a-z0-9_-]*$#s';
    /**
     * @var string
     */
    public $message = 'Only [a-z0-9_-] symbols are allowed.';
}