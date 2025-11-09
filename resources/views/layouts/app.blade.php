<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Clinic Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @include('layouts.css')
</head>

<body class="index-page">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @include('layouts.js')

</body>

</html>
