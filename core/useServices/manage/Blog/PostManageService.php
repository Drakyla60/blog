<?php
namespace core\useServices\manage\Blog;
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 9:26 PM
 */

use core\entities\Blog\Post\Post;
use core\entities\Meta;
use core\forms\manage\Blog\Post\PostCreateForm;
use core\ropositories\Blog\CategoryRepository;
use core\ropositories\Blog\PostRepository;
use core\ropositories\Blog\TypeRepository;


/**
 * Class PostManageService
 * @package core\useServices\manage\Blog
 */
class PostManageService
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var TypeRepository
     */
    private $typeRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * PostManageService constructor.
     * @param PostRepository $postRepository
     * @param TypeRepository $typeRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        PostRepository $postRepository,
        TypeRepository $typeRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->typeRepository = $typeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param PostCreateForm $postCreateForm
     * @return Post
     */
    public function create(PostCreateForm $postCreateForm): Post
    {
        $type = $this->typeRepository->get($postCreateForm->typeId);
        $category = $this->categoryRepository->get($postCreateForm->categories->main);

        $post = Post::create(
            $type->id,
            $category->id,
            $postCreateForm->name,
            new Meta(
                $postCreateForm->meta->title,
                $postCreateForm->meta->description,
                $postCreateForm->meta->keywords
            )
        );

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $post =  $this->postRepository->get($id);
        $this->postRepository->remove($post);
    }
}
















