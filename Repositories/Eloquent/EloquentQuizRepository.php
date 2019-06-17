<?php

namespace Modules\Itest\Repositories\Eloquent;

use Modules\Itest\Events\QuizWasCreated;
use Modules\Itest\Events\QuizWasUpdated;
use Modules\Itest\Repositories\QuizRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Modules\Itest\Entities\Status;

class EloquentQuizRepository extends EloquentBaseRepository implements QuizRepository
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

    /**
     * Standard Api Method
     * @param $data
     * @return mixed
     */
    public function create($data)
    {

        $category = $this->model->create($data);

        event(new QuizWasCreated($category, $data));

        return $this->find($category->id);
    }
    /**
     * Update a resource
     * @param $category
     * @param  array $data
     * @return mixed
     */
    public function update($category, $data)
    {
        $category->update($data);

        event(new QuizWasUpdated($category, $data));

        return $category;
    }



    public function destroy($model)
    {
        // event(new QuizWasDeleted($model));

        return $model->delete();
    }
}
