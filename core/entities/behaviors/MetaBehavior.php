<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 11:09 AM
 */

namespace core\entities\behaviors;


use core\entities\Blog\Type;
use core\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class MetaBehavior extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'meta_json';


    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_AFTER_INSERT =>'onBeforeSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'onBeforeSave',
        ];
    }
    /**
     * @param Event $event
     */
    public function onAfterFind(Event $event): void
    {
        /** @var Type $type */
        $type = $event->sender;
        $meta = Json::decode($type->getAttribute($this->jsonAttribute));
        $type->{$this->attribute} = new Meta($meta['title'], $meta['description'], $meta['keywords']);
    }

    /**
     * @param Event $event
     */
    public function onBeforeSave(Event $event): void
    {
        /** @var Type $type */
        $type = $event->sender;
        $type->setAttribute($this->jsonAttribute, Json::encode([
            'title' => $type->{$this->attribute}->title,
            'description' => $type->{$this->attribute}->description,
            'keywords' => $type->{$this->attribute}->keywords
        ]));
    }
}