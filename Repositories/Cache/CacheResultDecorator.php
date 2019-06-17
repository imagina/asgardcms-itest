<?php

namespace Modules\Itest\Repositories\Cache;

use Modules\Itest\Repositories\ResultRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

/**
 * Class CacheResultDecorator
 * @package Modules\Itest\Repositories\Cache
 */
class CacheResultDecorator extends BaseCacheDecorator implements ResultRepository
{
    /**
     * CacheResultDecorator constructor.
     * @param ResultRepository $result
     */
    public function __construct(ResultRepository $result)
    {
        parent::__construct();
        $this->entityName = 'itest.results';
        $this->repository = $result;
    }

    /**
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {
        return $this->remember(function () use ($params) {
            return $this->repository->getItemsBy($params);
        });
    }

    /**
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false)
    {
        return $this->remember(function () use ($criteria, $params) {
            return $this->repository->getItem($criteria, $params);
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function whereCategory($id)
    {
        return $this->remember(function () use ($id) {
            return $this->repository->whereCategory($id);
        });
    }

    /**
     * @param $value
     * @return mixed
     */
    public function whereValue($id,$value)
    {
        return $this->remember(function () use ($id,$value) {
            return $this->repository->whereValue($id,$value);
        });
    }
}
