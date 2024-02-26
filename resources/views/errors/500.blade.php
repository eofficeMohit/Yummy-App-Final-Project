<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">

<head>

    @include('.front.general.favicon')
    @section('title', __('Not Found'))
    @section('code', '404')

</head>

<body>
    <div class="container">
        <div class="panel-body">
            <li id='feature-6' class='feature_thumb' onclick="window.location='{{ url('/') }}'">
                <img width="100%" class="img-circle" src="{{ asset('/general/img/500.jpeg') }}" alt="404 Page"
                    title="404 Page Not Found">
            </li>
            @include('.front.general.script')
        </div>
    </div>
</body>

</html>
