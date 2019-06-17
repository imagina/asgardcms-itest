<?php

namespace Modules\Itest\Http\Controllers;

use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Itest\Emails\SendTest;
use Modules\Itest\Repositories\CategoryRepository;
use Modules\Itest\Repositories\QuestionRepository;
use Modules\Itest\Repositories\QuizRepository;
use Modules\Itest\Repositories\ResultRepository;
use Modules\Itest\Repositories\TestRepository;
use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Contracts\Setting;

class PublicController extends BasePublicController
{


    public $category;

    public $test;

    public $result;
    public $question;
    public $quiz;
    private $setting;

    public function __construct(CategoryRepository $category, TestRepository $test, ResultRepository $result, Setting $setting, QuizRepository $quiz,QuestionRepository $question)
    {
        parent::__construct();

        $this->category = $category;
        $this->test = $test;
        $this->result=$result;
        $this->setting = $setting;
        $this->quiz=$quiz;
        $this->question=$question;

    }

    public function index()
    {
        $quizzes=$this->quiz->paginate(12);

        return view('itest::frontend.index', compact('quizzes'));

    }

    public function show($slug)
    {
        $quiz = $this->quiz->findBySlug($slug);

        $questions=$this->question->whereQuiz($quiz->id);
        return view('itest::frontend.show', compact('quiz','questions'));
    }

    public function store($slug,Request $request)
    {
        $data=$request->all();
        $quiz = $this->quiz->findBySlug($slug);
        $email=$data["email"];
        $key= str_random(40);
        $result=array();
        unset($data['_token'],$data["email"]);
        foreach ($data as $index=> $test){
            $test["quiz_id"]=$quiz->id;
            $test["email"]=$email;
            $test['key']=$key;
            $this->test->create($test);
        }
        foreach ($quiz->categories as $i =>$category){
            if(count($category->questions)){
                $param=json_decode(json_encode(['filter'=>['category'=>$category->id,'email'=>$email,'key'=>$key],'include'=>[],'take'=>null]));
                $tests=$this->test->getItemsBy($param);
                $avg=$tests->avg('value');
                $value=($avg*100)/5;
                $result[$i]=(object)["category"=>$category->title,"result"=>$this->result->whereValue($category->id,$value)];
            }


        }
        $subject = trans("itest::tests.messages.New test available"). ' - '.$this->setting->get('core::site-name');
        $view = "itest::emails.test.new";
        $notify = "itest::emails.test.notify-test";
        Mail::to($email)->send(new SendTest($email,$quiz,$result,$view,$subject));
        Mail::to($this->setting->get('itest::notify-email'))->send(new SendTest($email,$quiz,$result,$notify,$subject));
        return redirect()->route('itest.answer',[$quiz->slug])
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itest::results.title.results')]));

    }

    public function answer(){
        return view('itest::frontend.success');
    }

}