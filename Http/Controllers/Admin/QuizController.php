<?php

namespace Modules\Itest\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itest\Entities\Quiz;
use Modules\Itest\Http\Requests\CreateQuizRequest;
use Modules\Itest\Http\Requests\UpdateQuizRequest;
use Modules\Itest\Repositories\QuizRepository;
use Modules\Itest\Entities\Status;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class QuizController extends AdminBaseController
{
    /**
     * @var QuizRepository
     */
    private $quiz;
    private $status;

    public function __construct(QuizRepository $quiz, Status $status)
    {
        parent::__construct();

        $this->quiz = $quiz;
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quizzes = $this->quiz->all();

        return view('itest::admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = $this->status->lists();
        return view('itest::admin.quizzes.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQuizRequest $request
     * @return Response
     */
    public function store(CreateQuizRequest $request)
    {

        $this->quiz->create($request->all());

        return redirect()->route('admin.itest.quiz.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itest::quizzes.title.quizzes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Quiz $quiz
     * @return Response
     */
    public function edit(Quiz $quiz)
    {
        $status = $this->status->lists();
        return view('itest::admin.quizzes.edit', compact('quiz', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Quiz $quiz
     * @param  UpdateQuizRequest $request
     * @return Response
     */
    public function update(Quiz $quiz, UpdateQuizRequest $request)
    {
        $this->quiz->update($quiz, $request->all());

        return redirect()->route('admin.itest.quiz.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itest::quizzes.title.quizzes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quiz $quiz
     * @return Response
     */
    public function destroy(Quiz $quiz)
    {
        $this->quiz->destroy($quiz);

        return redirect()->route('admin.itest.quiz.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::quizzes.title.quizzes')]));
    }
}
