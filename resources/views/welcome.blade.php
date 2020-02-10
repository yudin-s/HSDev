<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">

    <!-- Styles -->

</head>
<body>
<div id="app">
    <main-view api_index="{{route('api.list.index')}}" api_store="{{route('api.list.store')}}"></main-view>
</div>


</body>
<script src="/js/app.js"></script>

</html>
