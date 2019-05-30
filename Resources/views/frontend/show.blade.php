@extends('layouts.master')
@section('meta')
    <meta name="description" content="{{$category->description }}">
    <!-- Schema.org para Google+ -->
    <meta itemprop="name" content="{{$category->title}}">
    <meta itemprop="description" content="{{$category->description}}">
    <meta itemprop="image" content=" {{url($category->mainimage->path) }}">
    <!-- Open Graph para Facebook-->
    <meta property="og:title" content="{{$category->title}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{url($category->slug)}}"/>
    <meta property="og:image" content="{{url($category->mainimage->path)}}"/>
    <meta property="og:description" content="{{$category->description}}"/>
    <meta property="og:site_name" content="{{Setting::get('core::site-name') }}"/>
    <meta property="og:locale" content="{{config('asgard.iblog.config.oglocal')}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
    <meta name="twitter:title" content="{{$category->title}}">
    <meta name="twitter:description" content="{{$category->description}}">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="{{url($category->mainimage->path)}}">

@stop

@section('title')
    {{ $category->title }} | @parent
@stop

@section('content')
    <div class="page blog test test-{{$category->slug}} test-{{$category->id}}">
        <div class="iblock general-block41 " data-blocksrc="general.block41">
            <div class="container-fluid  overflow-hidden">
                <div class="row bg-gris test d-flex  ">
                    <div class="img-test col-12 col-md-6">
                        <img src="{{url($category->mainimage->path)}}" class="img-fluid mr-md-5 mr-0"
                             alt="{{$category->title}}">
                    </div>
                    <div class=" icontenteditable col-12 col-md-6 test-descripcion">
                        <h1>{{$category->title}}</h1>
                        {!! $category->description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="iblock general-block43 " data-blocksrc="general.block43">
            <div class="container-fluid px-0  overflow-hidden ">
                {!! Form::open(['route' => ['itest.test.store',$category->slug], 'method' => 'post']) !!}
                    @if(count($questions))
                        @foreach($questions as $question)
                            <div class="preguntas text-center">
                                <h2 class="preguntas">{{$question->title}}</h2>
                                <input type="hidden" name="{{$question->id}}[question_id]" value="{{$question->id}}">
                            </div>
                            <div class="botones d-flex align-items-center justify-content-center">
                                <div>
                                    <label class='label1 d-none d-sm-inline-block' for="input1">Muy de acuerdo</label>
                                </div>
                                <div id="radios">
                                    <label for="input1" class="input1"></label>
                                    <input id="input1" name="{{$question->id}}[value]" type="radio" value="5">
                                    <label for="input2" class="input2"></label>
                                    <input id="input2" name="{{$question->id}}[value]" type="radio" value="4"/>
                                    <label for="input3" class="input3"></label>
                                    <input id="input3" name="{{$question->id}}[value]" type="radio" value="3"/>
                                    <label for="input4" class="input4"></label>
                                    <input id="input4" name="{{$question->id}}[value]" type="radio" value="2"/>
                                    <label for="input5" class="input5"></label>
                                    <input id="input5" name="{{$question->id}}[value]" type="radio" value="1"/>
                                    <span id="slider"></span>
                                </div>
                                <div>
                                    <label class='label2 d-none d-sm-inline-block' for="input5">Muy en
                                        desa-cuerdo</label>
                                </div>

                            </div>
                        @endforeach
                    @endif
                <div class="form-group">
                    <label for="exampleFormControlInput1">Correo electronico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>
                    <input type="submit" class="btn btn-submit" value="Guardar">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
