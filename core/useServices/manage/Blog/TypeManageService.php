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
use core\ropositories\Blog\TypeRepository;

class TypeManageService
{
    /**
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * TypeManageService constructor.
     * @param TypeRepository $typeRepository
     */
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

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
        $brand = $this->typeRepository->get($id);
        $this->typeRepository->remove($brand);
    }

}