<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="never">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>
        {{isset($current_menu)?data_get($current_menu, 'children.0.text', data_get($current_menu, 'text')):''}} | {{config('app.name')}}
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('layouts.css')
    @include('layouts.js')
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
    @yield('content')
</body>
@yield('script')
</html>