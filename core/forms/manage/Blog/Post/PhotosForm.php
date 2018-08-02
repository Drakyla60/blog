<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 3:15 PM
 */

namespace core\forms\manage\Blog\Post;


use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class PhotosForm
 * @package core\forms\manage\Blog\Post
 */
class PhotosForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $files;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}
