<?php

namespace Modules\Itest\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Iblog\Entities\Status;

class TestPresenter extends Presenter
{
    /**
     * @var \Modules\Iblog\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Iblog\Repositories\PostRepository
     */
    //private $post;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->status = app('Modules\Iblog\Entities\Status');
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-red';
                break;
            case Status::PENDING:
                return 'bg-orange';
                break;
            case Status::PUBLISHED:
                return 'bg-green';
                break;
            case Status::UNPUBLISHED:
                return 'bg-purple';
                break;
            default:
                return 'bg-red';
                break;
        }
    }
}
