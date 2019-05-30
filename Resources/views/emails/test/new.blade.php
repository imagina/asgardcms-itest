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
            {{trans('itest::tests.messages.New test available')}}
        </h3>

        <div style="margin-bottom: 5px">
            <p>
                su resultado fue del {{$result->value}}%
            </p>
            {!! $result->description!!}
        </div>
    </div>


    @includeFirst(['emails.footer', 'itest::emails.base.footer'])


  </div>
</div>
</body>

</html>