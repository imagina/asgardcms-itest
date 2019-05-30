<?php

namespace Modules\Itest\Repositories\Cache;

use Modules\Itest\Repositories\TestRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTestDecorator extends BaseCacheDecorator implements TestRepository
{
    public function __construct(TestRepository $test)
    {
        parent::__construct();
        $this->entityName = 'itest.tests';
        $this->repository = $test;
    }
}
