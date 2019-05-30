<?php

namespace Modules\Itest\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Itest\Entities\Status;
use Modules\Itest\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Builder;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    /**
     * @inheritdoc
     */
    public function findBySlug($slug)
    {
        $query = $this->model->whereHas('translations', function (Builder $q) use ($slug) {
            $q->where('slug', $slug);
        })->whereStatus(Status::PUBLISHED)->with('translations','questions')->firstOrFail();

     return $query;
    }
}
