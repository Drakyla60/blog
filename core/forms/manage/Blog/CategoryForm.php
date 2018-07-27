<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/18/2018
 * Time: 6:11 PM
 */

namespace core\forms\manage\Blog;
use core\entities\Blog\Category;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta
 */
class CategoryForm extends CompositeForm
{
    /**
     * @var
     */
    public  $name;
    /**
     * @var
     */
    public  $slug;
    /**
     * @var
     */
    public  $title;
    /**
     * @var
     */
    public  $description;
    /**
     * @var null
     */
    public  $parentId;

    /**
     * @var Category|null
     */
    private $_category;

    /**
     * CategoryForm constructor.
     * @param Category|null $category
     * @param array $config
     */
    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
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
            [['parentId'], 'integer'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['description'], 'string'],
            ['slug', SlugValidator::class],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Category::class,
                'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null
            ],
        ];
    }

    /**
     * @return array
     */
    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category){
           return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : ''). $category['name'];
        });
    }

    /**
     * @return array
     */
    public function internalForms(): array
    {
        return ['meta'];
    }
}