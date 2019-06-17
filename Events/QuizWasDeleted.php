<?php

namespace Modules\Itest\Events;

use Modules\Itest\Entities\Category;
use Modules\Media\Contracts\StoringMedia;

class QuizWasDeleted implements StoringMedia
{

    /**
     * @var Category
     */
    public $entity;

    /**
     * @var disk
     */
    public $disk;

    public function __construct(Category $quiz)
    {

        $this->entity = $quiz;
        $this->disk='publicmedia';
    }

    /**
     * Return the entity
     * @return Category
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
