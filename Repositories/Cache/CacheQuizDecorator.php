<?php

namespace Modules\Itest\Repositories\Cache;

use Modules\Itest\Repositories\QuizRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheQuizDecorator extends BaseCacheDecorator implements QuizRepository
{
    public function __construct(QuizRepository $quiz)
    {
        parent::__construct();
        $this->entityName = 'itest.quizzes';
        $this->repository = $quiz;
    }
}
