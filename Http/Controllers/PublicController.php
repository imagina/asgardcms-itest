<?php

namespace Modules\Itest\Http\Controllers;

use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Itest\Emails\SendTest;
use Modules\Itest\Repositories\CategoryRepository;
use Modules\Itest\Repositories\ResultRepository;
use Modules\Itest\Repositories\TestRepository;
use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Mail;

class PublicController extends BasePublicController
{


    public $category;

    public $test;

    public $result;

    public function __construct(CategoryRepository $category, TestRepository $test, ResultRepository $result)
    {
        parent::__construct();

        $this->category = $category;
        $this->test = $test;
        $this->result=$result;

    }

    public function index()
    {
        $categories=$this->category->paginate(12);

        return view('itest::frontend.index', compact('categories'));

    }

    public function show($slug)
    {
        $category = $this->category->findBySlug($slug);

        $questions=$category->questions;
        return view('itest::frontend.show', compact('category','questions'));
    }

    public function store($slug,Request $request)
    {
        $data=$request->all();
        $category = $this->category->findBySlug($slug);
        $email=$data["email"];
        $key= str_random(40);
        unset($data['_token'],$data["email"]);
        foreach ($data as $index=> $test){
            $test["category_id"]=$category->id;
            $test["email"]=$email;
            $test['key']=$key;
            $this->test->create($test);
        }
        $param=json_decode(json_encode(['filter'=>['category'=>$category->id,'email'=>$email,'key'=>$key],'include'=>[],'take'=>null]));
        $tests=$this->test->getItemsBy($param);
        $avg=$tests->avg('value');
        $value=($avg*100)/5;
        $result= $this->result->whereValue($value);
        $subject = trans("itest::test.messages.New test available");
        $view = "itest::emails.test.new";
        Mail::to($email)->send(new SendTest($result,$view,$subject));
        return redirect()->route('itest.answer',[$category->slug])
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::results.title.results')]));

    }

    public function answer(){
        return view('itest::frontend.success');
    }

}