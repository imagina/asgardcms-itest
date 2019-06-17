<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    @includeFirst(['emails.style', 'itest::emails.base.style'])

</head>

<body>
<div id="body">
    <div id="template-mail">

        @includeFirst(['emails.header', 'itest::emails.base.header'])

        {{-- ***** Order Content  ***** --}}
        <div id="contend-mail" class="p-3">
            <h3 class="text-center text-uppercase">
                {{trans('itest::tests.messages.New test available')}} - {{$quiz->title}}
            </h3>
            <p>
                Estos son los resultados de su Prueba por cada <strong>Categoría:</strong>
            </p>
            @foreach($result as $item)
                <div style="margin-bottom: 5px">
                    @if(isset($item->result)&& !empty($item->result))
                    <h3 class="text-center text-uppercase">
                        {{$item->category}}
                    </h3>
                    <p>
                        El resultado fue del <strong>{{(int)$item->result->value??0}}%</strong>
                    </p>
                    {!!$item->result->description??''!!}
                    @endif
                </div>
            @endforeach
        </div>


        @includeFirst(['emails.footer', 'itest::emails.base.footer'])


    </div>
</div>
</body>

</html>