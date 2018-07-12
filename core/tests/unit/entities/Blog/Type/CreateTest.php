<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 3:41 PM
 */

namespace unit\entities\Blog\Type;


use Codeception\Test\Unit;
use core\entities\Blog\Type;
use core\entities\Meta;

/**
 * Class CreateTest
 * @package unit\entities\Blog\Type
 */
class CreateTest extends Unit
{
    /**
     *
     */
    public function testSuccess()
    {
        $type = Type::create(
            $name = 'Name',
            $slug = 'slug',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $type->name);
        $this->assertEquals($slug, $type->slug);
        $this->assertEquals($meta, $type->meta);
    }
}