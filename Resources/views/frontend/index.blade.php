@extends('layouts.master')

@section('meta')

@stop
@section('title')
    {{trans('itest::common.title.page')}} | @parent
@stop

@php
    $quiz=$quizzes[0]
@endphp

@section('content')
    <div class="page test-revista pt-5">
        <div class="container-fluid ">
            @if (count($quizzes) !=0)



                @foreach($quizzes as $quiz)


                            <div class="card mb-5 border-0 test-main">
                                <div class="row no-gutters justify-content-between">
                                    <div class="col-md-12 col-lg-6 col-xl-4">
                                        <img src="{{url($quiz->mainimage->path)}}" class="card-img" alt="{{$quiz->title}}">
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-7">
                                        <div class="card-body pt-4 pb-0 py-lg-0">
                                            <h1 class="mb-3">{{$quiz->title}}</h1>
                                            {!! $quiz->description !!}
                                            <a href="{{Request::url()}}/{{$quiz->slug}}" class="btn btn-submit mt-4">Hacer Test</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--
                    <div class="row bg-gris test my-5 d-flex justify-content-center px-md-4 mx-0 w-100">

                        @if(isset($quiz->mainimage)&&!empty($quiz->mainimage))

                            <div class="img-test col-12 text-center col-lg-4 my-2">
                                <img src="{{url($quiz->mainimage->path)}}" class="img-fluid mr-md-5 mr-0"
                                     alt="{{$quiz->title}}">
                            </div>
                            <div class=" col-12 col-lg-8 text-center text-lg-left test-descripcion">
                                <h1>{{$quiz->title}}</h1>
                                {!! $quiz->description !!}
                                <a href="{{Request::url()}}/{{$quiz->slug}}" class="btn btn-submit">Hacer Test</a>
                            </div>
                        @else
                            <div class=" col-12 my-2 test-descripcion">
                                <h1>{{$quiz->title}}</h1>
                                {!! $quiz->description !!}
                                <a href="{{Request::url()}}/{{$quiz->slug}}" class="btn btn-submit">Hacer Test</a>
                            </div>

                        @endif
                         </div>

                            --}}



                @endforeach
                <div class="clearfix"></div>
                <div class="pagination paginacion-blog row">
                    <div class="pull-right">
                        {{$quizzes->links()}}
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="white-box">
                        <h3>Ups... :(</h3>
                        <h1>404 Test no encontrado</h1>
                        <hr>
                        <p style="text-align: center;">No hemos podido encontrar el Contenido que estás buscando.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@stop