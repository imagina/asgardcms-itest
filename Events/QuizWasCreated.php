<?php

namespace Modules\Itest\Events;

use Modules\Itest\Entities\Category;
use Modules\Media\Contracts\StoringMedia;

class QuizWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Category
     */
    public $entity;

    public function __construct($quiz, array $data)
    {
        $this->data = $data;
        $this->entity = $quiz;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
