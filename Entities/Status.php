<?php

namespace Modules\Itest\Entities;

/**
 * Class Status
 * @package Modules\Blog\Entities
 */
class Status
{
    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;
    const UNPUBLISHED = 3;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DRAFT => trans('itest::common.status.draft'),
            self::PENDING => trans('itest::common.status.pending'),
            self::PUBLISHED => trans('itest::common.status.published'),
            self::UNPUBLISHED => trans('itest::common.status.unpublished'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DRAFT];
    }
}
