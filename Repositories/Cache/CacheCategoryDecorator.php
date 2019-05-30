<?php

namespace Modules\Itest\Repositories\Cache;

use Modules\Itest\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'itest.categories';
        $this->repository = $category;
    }
}
