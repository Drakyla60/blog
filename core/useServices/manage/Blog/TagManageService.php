<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 1:50 PM
 */

namespace core\useServices\manage\Blog;


use core\entities\Blog\Tag;
use core\forms\manage\Blog\TagForm;
use core\ropositories\Blog\TagRepository;
use yii\helpers\Inflector;

/**
 * Class TagManageService
 * @package core\useServices\manage\Blog
 */
class TagManageService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * TagManageService constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {

        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagForm $tagForm
     * @return Tag
     */
    public function create(TagForm $tagForm): Tag
    {
        $tag = Tag::create(
            $tagForm->name,
            $tagForm->slug ?: Inflector::slug($tagForm->name)
        );
        $this->tagRepository->save($tag);
        return $tag;
    }

    /**
     * @param $id
     * @param TagForm $tagForm
     */
    public function edit($id, TagForm $tagForm): void
    {
        $tag = $this->tagRepository->get($id);
        $tag->edit(
            $tagForm->name,
            $tagForm->slug ?: Inflector::slug($tagForm->name)
        );
        $this->tagRepository->save($tag);
    }
    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $tag = $this->tagRepository->get($id);
        $this->tagRepository->remove($tag);
    }
}