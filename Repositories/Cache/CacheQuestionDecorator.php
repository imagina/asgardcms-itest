<?php

namespace Modules\Itest\Repositories\Cache;

use Modules\Itest\Repositories\QuestionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheQuestionDecorator extends BaseCacheDecorator implements QuestionRepository
{
    public function __construct(QuestionRepository $question)
    {
        parent::__construct();
        $this->entityName = 'itest.questions';
        $this->repository = $question;
    }
}
