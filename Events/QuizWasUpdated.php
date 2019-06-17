<?php

namespace Modules\Itest\Events;

use Modules\Itest\Entities\Quiz;
use Modules\Media\Contracts\StoringMedia;

class QuizWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Quiz
     */
    public $quiz;

    public function __construct(Quiz $quiz, array $data)
    {
        $this->data = $data;
        $this->quiz = $quiz;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->quiz;
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
