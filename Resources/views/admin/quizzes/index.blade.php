@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('itest::quizzes.title.quizzes') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('itest::quizzes.title.quizzes') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.itest.quiz.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('itest::quizzes.button.create quiz') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('itest::quizzes.table.id') }}</th>
                                <th>{{ trans('itest::quizzes.table.title') }}</th>
                                <th>{{ trans('itest::quizzes.table.slug') }}</th>
                                <th>{{ trans('itest::quizzes.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($quizzes)): ?>
                            <?php foreach ($quizzes as $quiz): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.itest.quiz.edit', [$quiz->id]) }}">
                                        {{ $quiz->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.itest.quiz.edit', [$quiz->id]) }}">
                                        {{ $quiz->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.itest.quiz.edit', [$quiz->id]) }}">
                                        {{ $quiz->slug }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{  route('admin.itest.quiz.edit', [$quiz->id]) }}">
                                            <span class="label {{ $quiz->present()->statusLabelClass}}">
                                            {{ $quiz->present()->status}}
                                    </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.itest.quiz.edit', [$quiz->id]) }}">
                                        {{ $quiz->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.itest.quiz.edit', [$quiz->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('admin.itest.category.index', [$quiz->id]) }}" class="btn btn-success btn-flat"><i class="fa fa-list-ol"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.itest.quiz.destroy', [$quiz->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('itest::quizzes.table.id') }}</th>
                                <th>{{ trans('itest::quizzes.table.title') }}</th>
                                <th>{{ trans('itest::quizzes.table.slug') }}</th>
                                <th>{{ trans('itest::quizzes.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('itest::quizzes.title.create quiz') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.itest.quiz.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "processing": true,
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
