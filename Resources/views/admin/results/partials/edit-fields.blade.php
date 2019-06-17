<div class="box-body">

    <?php $old = $result->hasTranslation($lang) ? $result->translate($lang)->description : '' ?>
    <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
        @editor('description', trans('itest::result.form.description'), old("$lang.description", $old), $lang)
    </div>


@if (config('asgard.itest.config.fields.result.partials.translatable.edit') && config('asgard.itest.config.fields.result.partials.translatable.edit') !== [])
    @foreach (config('asgard.itest.config.fields.result.partials.translatable.edit') as $partial)
    @include($partial)
    @endforeach
    @endif
</div>
