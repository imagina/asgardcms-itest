@extends('layouts.master')
@section('meta')
    <meta name="description" content="{{$quiz->description }}">
    <!-- Schema.org para Google+ -->
    <meta itemprop="name" content="{{$quiz->title}}">
    <meta itemprop="description" content="{{$quiz->description}}">
    <meta itemprop="image" content=" {{url($quiz->mainimage->path) }}">
    <!-- Open Graph para Facebook-->
    <meta property="og:title" content="{{$quiz->title}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{url($quiz->slug)}}"/>
    <meta property="og:image" content="{{url($quiz->mainimage->path)}}"/>
    <meta property="og:description" content="{{$quiz->description}}"/>
    <meta property="og:site_name" content="{{Setting::get('core::site-name') }}"/>
    <meta property="og:locale" content="{{config('asgard.iblog.config.oglocal')}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
    <meta name="twitter:title" content="{{$quiz->title}}">
    <meta name="twitter:description" content="{{$quiz->description}}">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="{{url($quiz->mainimage->path)}}">

@stop

@section('title')
    {{ $quiz->title }} | @parent
@stop

@section('content')
    <div class="page blog  test-{{$quiz->slug}} test-{{$quiz->id}}">


        <section class="my-5">
            <div class="container-fluid ">

                <div class="card mb-3 border-0 test-main">
                    <div class="row no-gutters justify-content-between">
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <img src="{{url($quiz->mainimage->path)}}" class="card-img" alt="{{$quiz->title}}">
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="card-body pt-4 pb-0 py-lg-0">
                                <h1 class="mb-3">{{$quiz->title}}</h1>
                                {!! $quiz->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="iblock general-block43 " data-blocksrc="general.block43">
            <div class="container-fluid px-0  overflow-hidden ">
                {!! Form::open(['route' => ['itest.test.store',$quiz->slug], 'method' => 'post']) !!}
                @if(count($questions))
                    @foreach($questions as $question)
                        <div class="preguntas text-center">
                            <h2 class="preguntas">{{$question->title}}</h2>
                            <input type="hidden" name="{{$question->id}}[question_id]" value="{{$question->id}}">
                        </div>
                        <div class="botones d-flex align-items-center justify-content-center">
                            <div>
                                <label class='label1 my-2 d-none d-sm-inline-block' for="input1">No</label>
                            </div>
                            <div id="radio-{{$question->id}}" class="ml-3 d-flex align-items-center"
                                 style="margin-top: -10px;">
                                <div class="custom-control custom-radio red-lg custom-control-inline">
                                    <input type="radio" id="input-{{$question->id}}-1" name="{{$question->id}}[value]"
                                           value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="input-{{$question->id}}-1"></label>
                                </div>
                                <div class="custom-control custom-radio red-sm custom-control-inline">
                                    <input type="radio" id="input-{{$question->id}}-2" name="{{$question->id}}[value]"
                                           value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="input-{{$question->id}}-2"></label>
                                </div>
                                <div class="custom-control custom-radio gris custom-control-inline">
                                    <input type="radio" id="input-{{$question->id}}-3" name="{{$question->id}}[value]"
                                           value="3" class="custom-control-input">
                                    <label class="custom-control-label" for="input-{{$question->id}}-3"></label>
                                </div>
                                <div class="custom-control custom-radio green-sm custom-control-inline">
                                    <input type="radio" id="input-{{$question->id}}-4" name="{{$question->id}}[value]"
                                           value="4" class="custom-control-input">
                                    <label class="custom-control-label" for="input-{{$question->id}}-4"></label>
                                </div>
                                <div class="custom-control custom-radio green-lg custom-control-inline">
                                    <input type="radio" id="input-{{$question->id}}-5" name="{{$question->id}}[value]"
                                           value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="input-{{$question->id}}-5"></label>
                                </div>
                            </div>

                            <div>
                                <label class='label2 my-2 d-none d-sm-inline-block' for="input5">Si</label>
                            </div>

                        </div>
                    @endforeach
                @endif
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-8">
                            <div class="form-group text-center">
                                <label for="email" class="preguntas">El resultado de test se envia al Correo
                                    electronico </label>
                                <input type="email" class="form-control col-sm-6 mx-auto" id="email" name="email"
                                       placeholder="name@example.com">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-submit text-white" value="TERMINAR">
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
