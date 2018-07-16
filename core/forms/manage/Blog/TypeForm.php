<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 1:53 PM
 */

namespace core\forms\manage\Blog;


use core\entities\Blog\Type;
use core\forms\manage\MetaForm;
use yii\base\Model;

/**
 * Class TypeForm
 * @package core\forms\manage\Blog
 * @property MetaForm $meta
 */
class TypeForm extends Model
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $slug;

    /**
     * @var Type
     */
    private $_type;

    /**
     * TypeForm constructor.
     * @param Type|null $type
     * @param array $config
     */
    public function __construct(Type $type = null, $config = [])
    {
        if ($type) {
            $this->name = $type->name;
            $this->slug = $type->slug;
            $this->meta = new MetaForm($type->meta);
            $this->_type = $type;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '#^[a-z0-9_-]*$#s'],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Type::class,
                'filter' => $this->_type ? ['<>', 'id', $this->_type->id] : null]
        ];
    }

    /**
     * @return array
     */
    public function internalForms(): array
    {
        return ['meta'];
    }
}