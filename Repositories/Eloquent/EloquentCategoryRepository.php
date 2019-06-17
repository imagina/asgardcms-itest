<?php

namespace Modules\Itest\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Itest\Events\CategoryWasUpdated;
use Modules\Itest\Entities\Status;
use Modules\Itest\Events\CategoryWasCreated;
use Modules\Itest\Events\CategoryWasDeleted;
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

    /**
     * Standard Api Method
     * @param $data
     * @return mixed
     */
    public function create($data)
    {

        $category = $this->model->create($data);

        event(new CategoryWasCreated($category, $data));

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

        event(new CategoryWasUpdated($category, $data));

        return $category;
    }



    public function destroy($model)
    {
       // event(new CategoryWasDeleted($model));

        return $model->delete();
    }

    public function whereQuiz($id)
    {
        return $this->model->with('quiz', 'translations')->where('quiz_id',$id)
           ->orderBy('created_at', 'DESC')->paginate(20);
    }
}
