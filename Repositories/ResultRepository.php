<?php

namespace Modules\Itest\Repositories;

use Modules\Core\Repositories\BaseRepository;

/**
 * Interface ResultRepository
 * @package Modules\Itest\Repositories
 */
interface ResultRepository extends BaseRepository
{
    /**
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false);

    /**
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false);

    /**
     * @param $id
     * @return mixed
     */
    public function whereCategory($id);

    /**
     * @param $value
     * @return mixed
     */
    public function whereValue($value);

}
