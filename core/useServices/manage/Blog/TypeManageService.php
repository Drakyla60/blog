<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 5:17 PM
 */

namespace core\useServices\manage\Blog;


use core\entities\Blog\Type;
use core\entities\Meta;
use core\forms\manage\Blog\TypeForm;
use core\repositories\Blog\TypeRepository;
use core\repositories\Blog\PostRepository;
use DomainException;

/**
 * Class TypeManageService
 * @package core\useServices\manage\Blog
 */
class TypeManageService
{
    /**
     * @var TypeRepository
     */
    private $typeRepository;
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * TypeManageService constructor.
     * @param TypeRepository $typeRepository
     * @param PostRepository $postRepository
     */
    public function __construct(
        TypeRepository $typeRepository,
        PostRepository $postRepository
    )
    {
        $this->typeRepository = $typeRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @param TypeForm $form
     * @return Type
     */
    public function create(TypeForm $form): Type
    {
        $type = Type::create(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->typeRepository->save($type);
        return $type;
    }

    /**
     * @param $id
     * @param TypeForm $form
     */
    public function edit($id, TypeForm $form): void
    {
        $type = $this->typeRepository->get($id);
        $type->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->typeRepository->save($type);
    }

    /**
     * @param $id
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $type = $this->typeRepository->get($id);
        if ($this->postRepository->existsByType($type->id)) {
            throw new DomainException('Unable to remove type with products.');
        }
        $this->typeRepository->remove($type);
    }

}