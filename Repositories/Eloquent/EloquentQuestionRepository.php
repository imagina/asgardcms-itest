<?php

namespace Modules\Itest\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Itest\Repositories\QuestionRepository;
use Modules\Itest\Entities\Status;

class EloquentQuestionRepository extends EloquentBaseRepository implements QuestionRepository
{
    public function whereCategory($id)
    {
        return $this->model->select('*', 'itest__results.id as id')
            ->leftJoin('itest__category_question', 'itest__category_question.result_id', '=', 'itest__results.id')
            ->where('itest__category_question.category_id', $id)
            ->with('categories', 'translations')
            ->where('created_at', '<', date('Y-m-d H:i:s'))->orderBy('created_at', 'DESC')->paginate(12);

    }


    public function whereQuiz($id)
    {
        return $this->model->where('quiz_id',$id)->whereStatus(Status::PUBLISHED)->orderBy('id', 'asc')->get();

    }


    /**
     * @inheritdoc
     */
    public function create($data)
    {
        $question = $this->model->create($data);
        $question->categories()->sync(array_get($data, 'categories', []));
        return $question;
    }

    /**
     * @inheritdoc
     */
    public function update($question, $data)
    {
        $question->update($data);
        $question->categories()->sync(array_get($data, 'categories', []));
        return $question;
    }
}
