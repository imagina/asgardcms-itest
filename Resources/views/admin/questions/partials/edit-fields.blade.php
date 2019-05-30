<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('itest::question.form.title')) !!}
        <?php $old = $question->hasTranslation($lang) ? $question->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itest::question.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    @if (config('asgard.itest.config.fields.question.partials.translatable.edit') && config('asgard.itest.config.fields.question.partials.translatable.edit') !== [])
    @foreach (config('asgard.itest.config.fields.question.partials.translatable.edit') as $partial)
    @include($partial)
    @endforeach
    @endif


</div>
