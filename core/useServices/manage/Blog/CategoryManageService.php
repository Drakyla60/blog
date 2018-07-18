<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/18/2018
 * Time: 7:02 PM
 */

namespace core\useServices\manage\Blog;


use core\entities\Blog\Category;
use core\entities\Meta;
use core\forms\manage\Blog\CategoryForm;
use core\ropositories\Blog\CategoryRepository;

/**
 * Class CategoryManageService
 * @package core\useServices\manage\Blog
 */
class CategoryManageService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryManageService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryForm $categoryForm
     * @return Category
     */
    public function create(CategoryForm $categoryForm): Category
    {
        $parent = $this->categoryRepository->get($categoryForm->parentId);
        $category = Category::create(
            $categoryForm->name,
            $categoryForm->slug,
            $categoryForm->title,
            $categoryForm->description,
            new Meta(
                $categoryForm->meta->title,
                $categoryForm->meta->description,
                $categoryForm->meta->keywords
            )
        );
        $category->appendTo($parent);
        $this->categoryRepository->save($category);
        return $category;
    }

    /**
     * @param $id
     * @param CategoryForm $categoryForm
     */
    public function edit($id, CategoryForm $categoryForm): void
    {
        $category = $this->categoryRepository->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $categoryForm->name,
            $categoryForm->slug,
            $categoryForm->title,
            $categoryForm->description,
            new Meta(
                $categoryForm->meta->title,
                $categoryForm->meta->description,
                $categoryForm->meta->keywords
            )
        );
        if ($categoryForm->parentId !== $category->parent->id) {
            $parent = $this->categoryRepository->get($categoryForm->parentId);
            $category->appendTo($parent);
        }
        $this->categoryRepository->save($category);

    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $category = $this->categoryRepository->get($id);
        $this->assertIsNotRoot($category);
        $this->categoryRepository->remove($category);
    }

    /**
     * @param Category $category
     */
    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}


























