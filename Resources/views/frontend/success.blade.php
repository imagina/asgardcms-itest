@extends('layouts.master')

@section('title')
    {{trans('itest::common.title.finished test')}} | @parent
@stop

@section('content')

    <div class="iblock general-block51 m-5 h-75 " data-blocksrc="general.block51">
        <div class="container px-0  p-5 overflow-hidden ">
            <div class="alert alert-success p-5" role="alert">
                <h4 class="alert-heading ">{{trans('itest::common.messages.congratulations')}}</h4>
                <hr>
                <p>{{trans('itest::common.messages.You completed the test successfully')}}.</p>
            </div>


        </div>
    </div>

    </div>


@stop