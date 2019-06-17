<?php

namespace Modules\Itest\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Itest\Entities\Category;
use Modules\Itest\Entities\Status;
use Modules\Itest\Http\Requests\CreateCategoryRequest;
use Modules\Itest\Http\Requests\UpdateCategoryRequest;
use Modules\Itest\Repositories\CategoryRepository;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;
    private $status;

    public function __construct(CategoryRepository $category, Status $status)
    {
        parent::__construct();

        $this->category = $category;
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($quiz)
    {
        $categories = $this->category->whereQuiz($quiz->id);

        return view('itest::admin.categories.index', compact('categories', 'quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($quiz)
    {
        $status = $this->status->lists();
        return view('itest::admin.categories.create', compact('status', 'quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest $request
     * @return Response
     */
    public function store($quiz, CreateCategoryRequest $request)
    {

        $this->category->create($request->all());

        return redirect()->route('admin.itest.category.index', [$quiz->id])
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itest::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit($quiz, Category $category)
    {
        $status = $this->status->lists();
        return view('itest::admin.categories.edit', compact('category', 'status', 'quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update($quiz, Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.itest.category.index', [$quiz->id])
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itest::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy($quiz, Category $category)
    {
        $this->category->destroy($category);

        return redirect()->route('admin.itest.category.index'[$quiz->id])
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::categories.title.categories')]));
    }
}
