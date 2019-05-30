<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[description]", trans('itest::results.form.description')) !!}
        {!! Form::text("{$lang}[description]", old("{$lang}.description"), ['class' => 'form-control', 'placeholder' => trans('itest::results.form.description')]) !!}
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>

    @if (config('asgard.itest.config.fields.question.partials.translatable.create') && config('asgard.itest.config.fields.question.partials.translatable.create') !== [])
        @foreach (config('asgard.itest.config.fields.question.partials.translatable.create') as $partial)
            @include($partial)
        @endforeach
    @endif
</div>
