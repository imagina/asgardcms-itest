<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/itest'], function (Router $router) {
    $router->group(['prefix' =>'/questions'],function (Router $router){

        $router->bind('question', function ($id) {
            return app('Modules\Itest\Repositories\QuestionRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.itest.question.index',
            'uses' => 'QuestionController@index',
            'middleware' => 'can:itest.questions.index'
        ]);
        $router->get('create', [
            'as' => 'admin.itest.question.create',
            'uses' => 'QuestionController@create',
            'middleware' => 'can:itest.questions.create'
        ]);
        $router->post('/', [
            'as' => 'admin.itest.question.store',
            'uses' => 'QuestionController@store',
            'middleware' => 'can:itest.questions.create'
        ]);
        $router->get('{question}/edit', [
            'as' => 'admin.itest.question.edit',
            'uses' => 'QuestionController@edit',
            'middleware' => 'can:itest.questions.edit'
        ]);
        $router->put('{question}', [
            'as' => 'admin.itest.question.update',
            'uses' => 'QuestionController@update',
            'middleware' => 'can:itest.questions.edit'
        ]);
        $router->delete('{question}', [
            'as' => 'admin.itest.question.destroy',
            'uses' => 'QuestionController@destroy',
            'middleware' => 'can:itest.questions.destroy'
        ]);

    });

    $router->group(['prefix' =>'tests'],function (Router $router) {
        $router->bind('test', function ($id) {
            return app('Modules\Itest\Repositories\TestRepository')->find($id);
        });
        $router->get('tests', [
            'as' => 'admin.itest.test.index',
            'uses' => 'TestController@index',
            'middleware' => 'can:itest.tests.index'
        ]);
        $router->get('tests/{test}/edit', [
            'as' => 'admin.itest.test.edit',
            'uses' => 'TestController@edit',
            'middleware' => 'can:itest.tests.edit'
        ]);
    });

    $router->group(['prefix' =>'/quizzes'],function (Router $router) {
        $router->bind('itestQuiz', function ($id) {
            return app('Modules\Itest\Repositories\QuizRepository')->find($id);
        });

        $router->get('/', [
            'as' => 'admin.itest.quiz.index',
            'uses' => 'QuizController@index',
            'middleware' => 'can:itest.quizzes.index'
        ]);
        $router->get('/create', [
            'as' => 'admin.itest.quiz.create',
            'uses' => 'QuizController@create',
            'middleware' => 'can:itest.quizzes.create'
        ]);
        $router->post('/', [
            'as' => 'admin.itest.quiz.store',
            'uses' => 'QuizController@store',
            'middleware' => 'can:itest.quizzes.create'
        ]);
        $router->group(['prefix' =>'{itestQuiz}'],function (Router $router) {
            $router->get('/edit', [
                'as' => 'admin.itest.quiz.edit',
                'uses' => 'QuizController@edit',
                'middleware' => 'can:itest.quizzes.edit'
            ]);
            $router->put('/', [
                'as' => 'admin.itest.quiz.update',
                'uses' => 'QuizController@update',
                'middleware' => 'can:itest.quizzes.edit'
            ]);
            $router->delete('/', [
                'as' => 'admin.itest.quiz.destroy',
                'uses' => 'QuizController@destroy',
                'middleware' => 'can:itest.quizzes.destroy'
            ]);

            $router->group(['prefix' =>'/categories'],function (Router $router) {

                $router->bind('itestCategory', function ($id) {
                    return app('Modules\Itest\Repositories\CategoryRepository')->find($id);
                });
                $router->get('/', [
                    'as' => 'admin.itest.category.index',
                    'uses' => 'CategoryController@index',
                    'middleware' => 'can:itest.categories.index'
                ]);
                $router->get('create', [
                    'as' => 'admin.itest.category.create',
                    'uses' => 'CategoryController@create',
                    'middleware' => 'can:itest.categories.create'
                ]);
                $router->post('/', [
                    'as' => 'admin.itest.category.store',
                    'uses' => 'CategoryController@store',
                    'middleware' => 'can:itest.categories.create'
                ]);
                $router->group(['prefix' =>'{itestCategory}'],function (Router $router) {
                    $router->get('edit', [
                        'as' => 'admin.itest.category.edit',
                        'uses' => 'CategoryController@edit',
                        'middleware' => 'can:itest.categories.edit'
                    ]);
                    $router->put('/', [
                        'as' => 'admin.itest.category.update',
                        'uses' => 'CategoryController@update',
                        'middleware' => 'can:itest.categories.edit'
                    ]);
                    $router->delete('/', [
                        'as' => 'admin.itest.category.destroy',
                        'uses' => 'CategoryController@destroy',
                        'middleware' => 'can:itest.categories.destroy'
                    ]);
                    $router->group(['prefix' =>'/result'],function (Router $router){
                        $router->get('/', [
                            'as' => 'admin.itest.result.index',
                            'uses' => 'ResultController@index',
                            'middleware' => 'can:itest.results.index'
                        ]);
                        $router->get('create', [
                            'as' => 'admin.itest.result.create',
                            'uses' => 'ResultController@create',
                            'middleware' => 'can:itest.results.create'
                        ]);
                        $router->post('/', [
                            'as' => 'admin.itest.result.store',
                            'uses' => 'ResultController@store',
                            'middleware' => 'can:itest.results.create'
                        ]);
                        $router->get('{result}/edit', [
                            'as' => 'admin.itest.result.edit',
                            'uses' => 'ResultController@edit',
                            'middleware' => 'can:itest.results.edit'
                        ]);
                        $router->put('{result}', [
                            'as' => 'admin.itest.result.update',
                            'uses' => 'ResultController@update',
                            'middleware' => 'can:itest.results.edit'
                        ]);
                        $router->delete('{result}', [
                            'as' => 'admin.itest.result.destroy',
                            'uses' => 'ResultController@destroy',
                            'middleware' => 'can:itest.results.destroy'
                        ]);
                    });
                });
            });
        });

    });


// append


});
