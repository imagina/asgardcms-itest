<?php

namespace Modules\Itest\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Itest\Entities\Result;
use Modules\Itest\Http\Requests\CreateResultRequest;
use Modules\Itest\Http\Requests\UpdateResultRequest;
use Modules\Itest\Repositories\CategoryRepository;
use Modules\Itest\Repositories\ResultRepository;

class ResultController extends AdminBaseController
{
    /**
     * @var ResultRepository
     */
    private $result;

    private $category;

    public function __construct(ResultRepository $result, CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
        $this->result = $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($category)
    {

        $results = $this->result->whereCategory($category->id);

        return view('itest::admin.results.index', compact('results', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($category)
    {

        return view('itest::admin.results.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateResultRequest $request
     * @return Response
     */
    public function store($category, CreateResultRequest $request)
    {
        \DB::beginTransaction();
        try {
            if ($category->id == (int)$request->category_id) {
                $this->result->create($request->all());
                \DB::commit();//Commit to Data Base
                return redirect()->route('admin.itest.result.index',[$category->id])
                    ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itest::results.title.results')]));
            } else {
                throw new \Exception(trans('itest::common.messages.resource error'));
            }

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('itest::common.messages.resource error', ['name' => trans('itest::results.title.results')]))->withInput($request->all());

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Result $result
     * @return Response
     */
    public function edit($category, Result $result)
    {
        return view('itest::admin.results.edit', compact('result','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Result $result
     * @param  UpdateResultRequest $request
     * @return Response
     */
    public function update($category, Result $result, UpdateResultRequest $request)
    {
        \DB::beginTransaction();
        try {
            if ($category->id == (int)$request->category_id) {
                $this->result->update($result, $request->all());
                \DB::commit();//Commit to Data Base
                return redirect()->route('admin.itest.result.index',[$category->id])
                    ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itest::results.title.results')]));
            } else {
                throw new \Exception(trans('itest::common.messages.resource error'));
            }

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('itest::common.messages.resource error', ['name' => trans('itest::results.title.results')]))->withInput($request->all());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Result $result
     * @return Response
     */
    public function destroy($category, Result $result)
    {

        try {
            $this->result->destroy($result);

            return redirect()->route('admin.itest.result.index',[$category->id])
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::results.title.results')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('itest::common.messages.resource error', ['name' => trans('iblog::categories.title.categories')]));

        }



    }
}
