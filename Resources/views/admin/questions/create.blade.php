@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('itest::questions.title.create question') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.itest.question.index') }}">{{ trans('itest::questions.title.questions') }}</a></li>
        <li class="active">{{ trans('itest::questions.title.create question') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.itest.question.store'], 'method' => 'question']) !!}
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="nav-tabs-custom">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('itest::admin.questions.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                            </div>
                        </div> {{-- end nav-tabs-custom --}}
                    </div>
                </div>
                @if (config('asgard.itest.config.fields.question.partials.normal.create')&&config('asgard.itest.config.fields.question.partials.normal.create') !== [])
                    <div class="col-xs-12 ">
                        <div class="box box-primary">
                            <div class="box-header">
                            </div>
                            <div class="box-body ">
                                @foreach (config('asgard.itest.config.fields.question.partials.normal.create') as $partial)
                                    @include($partial)
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <div class="box-footer">
                                <button type="submit"
                                        class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                                <a class="btn btn-danger pull-right btn-flat"
                                   href="{{ route('admin.itest.question.index')}}"><i
                                            class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('itest::questions.form.quiz')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            <select class="form-control" name="quiz_id" id="quiz_id">
                                @foreach ($quiz as $item)
                                    <option value="{{$item->id}}" {{ old('category_id', 0) == $item->id ? 'selected' : '' }}> {{$item->title}}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('itest::questions.form.Categories')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            @include('itest::admin.fields.checklist.categories.parent')
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('itest::questions.form.created at')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="form-group">
                                    <div class='input-group date' id='created'>
                                        <input type='text' name="created_at" id="created_at" class="form-control" value="{{date('Y-m-d H:i:s')}}"/>
                                        <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-calendar"></span>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <label>{{trans('itest::questions.form.status')}}</label>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body ">
                            <div class='form-group{{ $errors->has("status") ? ' has-error' : '' }}'>
                                @foreach($status as $index=>$item)
                                    <label class="radio" for="{{$item}}">
                                        <input type="radio" id="status" name="status"
                                               value="{{$index}}" {{old('status',0) == $index ? 'checked' : '' }}>
                                        {{$item}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool"
                                        data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <label>{{trans('itest::questions.form.editor')}}</label>
                        </div>
                        <div class="box-body">
                            <select name="user_id" id="user" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id }}" {{$user->id == old('user_id') ? 'selected' : ''}}>{{$user->present()->fullname()}}
                                        - ({{$user->email}})
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.itest.question.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'

            });

            $('.btn-box-tool').click(function (e) {
                e.preventDefault();
            });
        });
    </script>
    <style>

        .nav-tabs-custom > .nav-tabs > li.active {
            border-top-color: white !important;
            border-bottom-color: #3c8dbc !important;
        }

        .nav-tabs-custom > .nav-tabs > li.active > a, .nav-tabs-custom > .nav-tabs > li.active:hover > a {
            border-left: 1px solid #e6e6fd !important;
            border-right: 1px solid #e6e6fd !important;

        }


    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                var bindDatePicker = function () {
                    $(".date").datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss',
                        //defaultDate: $(this).val(),
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down"
                        }
                    }).find('input:first').on("blur", function () {
                        // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                        // update the format if it's yyyy-mm-dd
                        var date = parseDate($(this).val());

                        if (!isValidDate(date)) {
                            //create date based on momentjs (we have that)
                            date = moment().format('YYYY-MM-DD');
                        }

                        $(this).val(date);
                    }).datepicker('update', new Date());
                }

                var isValidDate = function (value, format) {
                    format = format || false;
                    // lets parse the date to the best of our knowledge
                    if (format) {
                        value = parseDate(value);
                    }

                    var timestamp = Date.parse(value);

                    return isNaN(timestamp) == false;
                }

                var parseDate = function (value) {
                    var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
                    if (m)
                        value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

                    return value;
                }

                bindDatePicker();
            });
        });
    </script>
@endpush
