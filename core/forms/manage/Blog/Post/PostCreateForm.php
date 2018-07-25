<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 4:00 PM
 */

namespace core\forms\manage\Blog\Post;


use core\forms\CompositeForm;
use core\forms\manage\MetaForm;

/**
 * @property MetaForm meta
 * @property CategoriesForm categories
 * @property PhotosForm photos
 * @property TagsForm tags
 * @property mixed|\yii\base\Model $typeId
 */
class PostCreateForm extends CompositeForm
{
    /**
     * @var
     */
    public $brandId;
    /**
     * @var
     */
    public $code;
    /**
     * @var
     */
    public $name;

    /**
     * PostCreateForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->tags = new TagsForm();
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['brandId', 'name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    protected function internalForms(): array
    {
        return ['meta', 'photos', 'categories', 'tags'];
    }
}