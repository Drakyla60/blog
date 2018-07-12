<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 3:54 PM
 */

namespace core\entities;


/**
 * Class Meta
 * @package core\entities
 */
class Meta
{
    /**
     * @var
     */
    public $title;
    /**
     * @var
     */
    public $description;
    /**
     * @var
     */
    public $keywords;

    /**
     * Meta constructor.
     * @param $title
     * @param $description
     * @param $keywords
     */
    public function __construct($title, $description, $keywords)
    {

        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}