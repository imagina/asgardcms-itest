<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('itest::questions.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("{$lang}.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itest::questions.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    @if (config('asgard.itest.config.fields.question.partials.translatable.create') && config('asgard.itest.config.fields.question.partials.translatable.create') !== [])
        @foreach (config('asgard.itest.config.fields.question.partials.translatable.create') as $partial)
            @include($partial)
        @endforeach
    @endif
</div>
