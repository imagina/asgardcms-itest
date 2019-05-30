<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[description]", trans('itest::results.form.description')) !!}
        <?php $old = $result->hasTranslation($lang) ? $result->translate($lang)->description : '' ?>
        {!! Form::text("{$lang}[description]", old("{$lang}.description", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itest::result.form.description')]) !!}
        {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
    </div>

    @if (config('asgard.itest.config.fields.result.partials.translatable.edit') && config('asgard.itest.config.fields.result.partials.translatable.edit') !== [])
    @foreach (config('asgard.itest.config.fields.result.partials.translatable.edit') as $partial)
    @include($partial)
    @endforeach
    @endif
</div>
