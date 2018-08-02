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
use core\entities\Blog\Tag;
use core\entities\Meta;
use core\forms\manage\Blog\Post\CategoriesForm;
use core\forms\manage\Blog\Post\PhotosForm;
use core\forms\manage\Blog\Post\PostCreateForm;
use core\forms\manage\Blog\Post\PostEditForm;
use core\repositories\Blog\CategoryRepository;
use core\repositories\Blog\PostRepository;
use core\repositories\Blog\TagRepository;
use core\repositories\Blog\TypeRepository;
use core\useServices\TransactionManager;


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
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var TransactionManager
     */
    private $transactionManager;

    /**
     * PostManageService constructor.
     * @param PostRepository $postRepository
     * @param TypeRepository $typeRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     * @param TransactionManager $transactionManager
     */
    public function __construct(
        PostRepository $postRepository,
        TypeRepository $typeRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        TransactionManager $transactionManager
    )
    {
        $this->postRepository = $postRepository;
        $this->typeRepository = $typeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->transactionManager = $transactionManager;
    }

    /**
     * @param PostCreateForm $postCreateForm
     * @return Post
     * @throws \Throwable
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
        foreach ($postCreateForm->categories->others as $otherId) {
            $category = $this->categoryRepository->get($otherId);
            $post->assignCategory($category->id);
        }


        foreach ($postCreateForm->photos->files as $file) {
            $post->addPhoto($file);
        }

        foreach ($postCreateForm->tags->existing as $tagId) {
            $tag = $this->tagRepository->get($tagId);
            $post->assignTag($tag->id);
        }

        $this->transactionManager->wrap(function () use ($post, $postCreateForm) {
            foreach ($postCreateForm->tags->newNames as $tagName) {
                if (!$tag = $this->tagRepository->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tagRepository->save($tag);
                }
                $post->assignTag($tag->id);
           }
           $this->postRepository->save($post);
        });

        //$this->postRepository->save($post);

        return $post;
    }

    /**
     * @param $id
     * @param PostEditForm $postEditForm
     * @throws \Throwable
     */
    public function edit($id, PostEditForm $postEditForm): void
    {
        $post = $this->postRepository->get($id);
        $type = $this->typeRepository->get($postEditForm->typeId);
        $category = $this->categoryRepository->get($postEditForm->categories->main);

        $post->edit(
            $type->id,
            $postEditForm->name,
            new Meta(
                $postEditForm->meta->title,
                $postEditForm->meta->description,
                $postEditForm->meta->keywords
            )
        );

        $post->changeMainCategory($category->id);
        $post->revokeCategories();

        foreach ($postEditForm->categories->others as $otherId) {
            $category = $this->categoryRepository->get($otherId);
            $post->assignCategory($category->id);
        }

        $post->revokeTags();

        foreach ($postEditForm->tags->existing as $tagId) {
            $tag = $this->tagRepository->get($tagId);
            $post->assignTag($tag->id);
        }

        $this->transactionManager->wrap(function () use ($post, $postEditForm) {
            //$this->postRepository->save($post);
            foreach ($postEditForm->tags->newNames as $tagName) {
                if (!$tag = $this->tagRepository->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tagRepository->save($tag);
                }
                $post->assignTag($tag->id);
            }
            $this->postRepository->save($post);
        });
    }

    /**
     * @param $id
     * @param CategoriesForm $categoriesForm
     */
    public function changeCategories($id, CategoriesForm $categoriesForm): void
    {
        $post = $this->postRepository->get($id);
        $category = $this->categoryRepository->get($categoriesForm->main);
        $post->changeMainCategory($category->id);
        $post->revokeCategories();
        foreach ($categoriesForm->others as $otherId) {
            $category = $this->categoryRepository->get($otherId);
            $post->assignCategory($category->id);
        }
        $this->postRepository->save($post);
    }
    /**
     * @param $id
     */
    public function activate($id): void
    {
        $post = $this->postRepository->get($id);
        $post->activate();
        $this->postRepository->save($post);
    }

    /**
     * @param $id
     */
    public function draft($id): void
    {
        $product = $this->postRepository->get($id);
        $product->draft();
        $this->postRepository->save($product);
    }

    /**
     * @param $id
     * @param PhotosForm $form
     */
    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->postRepository->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->postRepository->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->postRepository->get($id);
        $product->movePhotoUp($photoId);
        $this->postRepository->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->postRepository->get($id);
        $product->movePhotoDown($photoId);
        $this->postRepository->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     */
    public function removePhoto($id, $photoId): void
    {
        $product = $this->postRepository->get($id);
        $product->removePhoto($photoId);
        $this->postRepository->save($product);
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
















