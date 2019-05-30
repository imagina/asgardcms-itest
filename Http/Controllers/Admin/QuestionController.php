<?php

namespace Modules\Itest\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itest\Entities\Question;
use Modules\Itest\Entities\Status;
use Modules\Itest\Http\Requests\CreateQuestionRequest;
use Modules\Itest\Http\Requests\UpdateQuestionRequest;
use Modules\Itest\Repositories\CategoryRepository;
use Modules\Itest\Repositories\QuestionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;

class QuestionController extends AdminBaseController
{
    /**
     * @var QuestionRepository
     */
    private $question;

    private $category;

    private $status;

    private $user;

    public function __construct(QuestionRepository $question, CategoryRepository $category, Status $status, UserRepository $user)
    {
        parent::__construct();

        $this->question = $question;
        $this->category=$category;
        $this->status = $status;
        $this->user=$user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questions = $this->question->paginate(20);

        return view('itest::admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users= $this->user->all();
        $status = $this->status->lists();
        $categories = $this->category->all();
        return view('itest::admin.questions.create',compact('users','categories','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQuestionRequest $request
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $this->question->create($request->all());

        return redirect()->route('admin.itest.question.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itest::questions.title.questions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Question $question
     * @return Response
     */
    public function edit(Question $question)
    {
        $users= $this->user->all();
        $status = $this->status->lists();
        $categories = $this->category->all();
        return view('itest::admin.questions.edit', compact('question','users','status','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Question $question
     * @param  UpdateQuestionRequest $request
     * @return Response
     */
    public function update(Question $question, UpdateQuestionRequest $request)
    {
        $this->question->update($question, $request->all());

        return redirect()->route('admin.itest.question.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itest::questions.title.questions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Question $question
     * @return Response
     */
    public function destroy(Question $question)
    {
        $this->question->destroy($question);

        return redirect()->route('admin.itest.question.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::questions.title.questions')]));
    }
}
